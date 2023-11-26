<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;

class StateMigrate extends AbstractCommand
{
    protected static ?string $alias = 'state-migrate';

    public static function getArguments(): array
    {
        return [
            (new Argument('init'))->description('Table Initialization')->required(true),
        ];
    }

    public function execute(): int
    {
        $this->log("Starting state migration...");

        // データベース全体をクリーンアップします
        $this->cleanDatabase();
        
        $desiredSchema = include('./Database/state.php');  
        foreach ($desiredSchema as $table => $columns) {
            $this->stateToSchema($table, $columns);
        }

        $this->log("State migration completed.");
        return 0;
    }

    private function cleanDatabase(): void
    {
        $mysqli = new MySQLWrapper();

        // ドロップ中のエラーを防ぐために外部キーチェックを無効にします
        $mysqli->query("SET foreign_key_checks = 0");

        $result = $mysqli->query("SHOW TABLES");
        while ($row = $result->fetch_row()) {
            $table = $row[0];
            $this->log("Dropping table $table");
            $mysqli->query("DROP TABLE `$table`");
        }

        // ドロップ後に外部キーチェックを再度有効にします
        $mysqli->query("SET foreign_key_checks = 1");
    }
    
    private function stateToSchema(string $table, array $columns): void
    {
        $mysqli = new MySQLWrapper();

        $columnDefinitions = [];
        $keys = [];
        $primaryKeysColumns = [];
        foreach ($columns as $columnName => $columnProps) {
            $definition = "`$columnName` {$columnProps['dataType']}";

            if (isset($columnProps['constraints'])) {
                $definition .= " {$columnProps['constraints']}";
            }

            if (isset($columnProps['nullable']) && !$columnProps['nullable']) {
                $definition .= " NOT NULL";
            }

            if (isset($columnProps['primaryKey']) && $columnProps['primaryKey']) {
               
	    $primaryKeysColumns[] = $columnName;
            }

            if (isset($columnProps['foreignKey'])) {
                $fk = $columnProps['foreignKey'];
                $onDelete = isset($fk['onDelete']) ? "ON DELETE {$fk['onDelete']}" : "";
                $keys[] = "FOREIGN KEY (`$columnName`) REFERENCES {$fk['referenceTable']}({$fk['referenceColumn']}) $onDelete";
            }

            $columnDefinitions[] = $definition;
        }

        if (count($primaryKeysColumns) > 0) {
            $keys[] = "PRIMARY KEY (" . implode(", ", $primaryKeysColumns) . ")";
        }


        $columnSQL = implode(', ', $columnDefinitions);
        $keysSQL = implode(', ', $keys);

        $createTableQuery = "CREATE TABLE IF NOT EXISTS `$table` ($columnSQL, $keysSQL)";

        $result = $mysqli->query($createTableQuery);
        if ($result === false) throw new \Exception("Failed to ensure table $table matches desired state.");
        else $this->log("Ensured table $table matches desired state.");
    }
}
