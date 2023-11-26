<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Database\MySQLWrapper;
use Database\Seeder;

class Seed extends AbstractCommand
{
    // コマンド名を設定します
    protected static ?string $alias = 'seed';

    public static function getArguments(): array
    {
        return [];
    }

    public function execute(): int
    {
        $this->runAllSeeds();
        return 0;
    }

    function runAllSeeds(): void {
        $directoryPath = __DIR__ . '/../../Database/Seeds';

        // ディレクトリをスキャンしてすべてのファイルを取得します。
        $files = scandir($directoryPath);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                // ファイル名からクラス名を抽出します。
                $className = 'Database\Seeds\\' . pathinfo($file, PATHINFO_FILENAME);

                // シードファイルをインクルードします。
                include_once $directoryPath . '/' . $file;

                if (class_exists($className) && is_subclass_of($className, Seeder::class)) {
                    $seeder = new $className(new MySQLWrapper());
                    $seeder->seed();
                }
                else throw new \Exception('Seeder must be a class that subclasses the seeder interface');
            }
        }
    }
}