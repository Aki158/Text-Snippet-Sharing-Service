<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;

class Migrate extends AbstractCommand
{
    protected static ?string $alias = 'migrate';

    public static function getArguments(): array
    {
        return [
            (new Argument('rollback'))->description('Roll backwards. An integer n may also be provided to rollback n times.')->required(false)->allowAsShort(true),
            (new Argument('init'))->description("Create the migrations table if it doesn't exist.")->required(false)->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $rollback = $this->getArgumentValue('rollback');

        if ($this->getArgumentValue('init')) $this->createMigrationsTable();

        if ($rollback === false) {
            $this->log("Starting migration......");
            $this->migrate();
        } else {
            $rollbackN = $rollback === true ? 1 : (int)$rollback;
            $this->log("Running rollback....");
            $this->rollback($rollbackN);
        }

        return 0;
    }

    private function createMigrationsTable(): void
    {
        $this->log("Creating migrations table if necessary...");

        $mysqli = new MySQLWrapper();

        $result = $mysqli->query("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                filename VARCHAR(255) NOT NULL
            );
        ");

        if ($result === false) throw new \Exception("Failed to create migration table.");

        $this->log("Done setting up migration tables.");
    }

    private function migrate(): void
    {
        $this->log("Running migrations...");

        $lastMigration = $this->getLastMigration();
        // ファイル名を日付順（ASC）に並べた配列を返す
        $allMigrations = $this->getAllMigrationFiles();
        $startIndex = ($lastMigration) ? array_search($lastMigration, $allMigrations) + 1 : 0;
        
        for ($i = $startIndex; $i < count($allMigrations); $i++) {
            $filename = $allMigrations[$i];

            // まだインクルードされていない場合、ファイルをインクルードする
            include_once($filename);

            $migrationClass = $this->getClassnameFromMigrationFilename($filename);
            $migration = new $migrationClass();
            $this->log(sprintf("Processing up migration for %s", $migrationClass));
            $queries = $migration->up();
            if (empty($queries)) throw new \Exception("Must have queries to run for . " . $migrationClass);

            $this->processQueries($queries);
            $this->insertMigration($filename);
        }

        $this->log("Migration ended...\n");
    }

    private function getClassnameFromMigrationFilename(string $filename): string
    {
        // マイグレーションのクラス名を正規表現で取得する
        if (preg_match('/([^_]+)\.php$/', $filename, $matches)) return sprintf("%s\%s", 'Database\Migrations', $matches[1]);
        else throw new \Exception("Unexpected migration filename format: " . $filename);
    }

    private function getLastMigration(): ?string
    {
        $mysqli = new MySQLWrapper();

        $query = "SELECT filename FROM migrations ORDER BY id DESC LIMIT 1";

        $result = $mysqli->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['filename'];
        }

        return null;
    }

    private function getAllMigrationFiles(string $order = 'asc'): array
    {
        $directory = sprintf("%s/../../Database/Migrations", __DIR__);
        $this->log($directory);

        // globはワイルドカード文字列を引数として渡すと、一致する"globbing pathnames"をすべて返すLinuxのシステムコール
        // これはワイルドカードに一致するすべてのファイルを意味する
        $allFiles = glob($directory . "/*.php");

        usort($allFiles, function ($a, $b) use ($order) {
            $compareResult = strcmp($a, $b);
            return ($order === 'desc') ? -$compareResult : $compareResult;
        });

        return $allFiles;
    }

    private function processQueries(array $queries): void
    {
        $mysqli = new MySQLWrapper();
        
        foreach ($queries as $query) {
            $result = $mysqli->query($query);
            if ($result === false) throw new \Exception(sprintf("Query {%s} failed.", $query));
            else $this->log('Ran query: ' . $query);
        }
    }

    private function insertMigration(string $filename): void
    {
        $mysqli = new MySQLWrapper();
        // オリジナルのクエリ文字列に実際の値を挿入して、クエリを実行することができる
        $statement = $mysqli->prepare("INSERT INTO migrations (filename) VALUES (?)");
        if (!$statement) {
            throw new \Exception("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
        }

        // クエリが準備されたので、準備されたクエリに文字列値を挿入する
        $statement->bind_param("s", $filename);

        // ステートメントを実行する
        if (!$statement->execute()) {
            throw new \Exception("Execute failed: (" . $statement->errno . ") " . $statement->error);
        }

        // ステートメントを閉じる
        $statement->close();
    }

    private function rollback(int $n = 1): void {
        $this->log("Rolling back {$n} migration(s)...");

        $lastMigration = $this->getLastMigration();
        $allMigrations = $this->getAllMigrationFiles();

        // ソートされたリストで最後のマイグレーションのインデックスを探す
        $lastMigrationIndex = array_search($lastMigration, $allMigrations);

        // 最後のマイグレーションが見つかったことを確認する
        if ($lastMigrationIndex === false) {
            $this->log("Could not find the last migration ran: " . $lastMigration);
            return;
        }

        $count = 0;
        // 毎回、マイグレーションのダウン関数を実行する
        for ($i = $lastMigrationIndex; $count < $n && $i >= 0; $i--) {
            $filename = $allMigrations[$i];

            $this->log("Rolling back: {$filename}");

            include_once($filename);

            $migrationClass =  $this->getClassnameFromMigrationFilename($filename);
            $migration = new $migrationClass();

            $queries = $migration->down();
            if (empty($queries)) throw new \Exception("Must have queries to run for . " . $migrationClass);

            $this->processQueries($queries);
            $this->removeMigration($filename);
            $count++;
        }

        $this->log("Rollback completed.\n");
    }

    private function removeMigration(string $filename): void {
        $mysqli = new MySQLWrapper();
        $statement = $mysqli->prepare("DELETE FROM migrations WHERE filename = ?");

        if (!$statement) throw new \Exception("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);

        $statement->bind_param("s", $filename);
        if (!$statement->execute()) throw new \Exception("Execute failed: (" . $statement->errno . ") " . $statement->error);

        $statement->close();
    }
}