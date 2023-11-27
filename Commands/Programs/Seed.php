<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;
use Database\Seeder;

class Seed extends AbstractCommand
{
    // コマンド名を設定します
    protected static ?string $alias = 'seed';

    public static function getArguments(): array
    {
        return [
            (new Argument('name'))->description('Set name.')->required(false)->allowAsShort(true),
            (new Argument('syntax'))->description('Set syntax.')->required(false)->allowAsShort(true),
            (new Argument('expiration'))->description('Set expiration.')->required(false)->allowAsShort(true),
            (new Argument('url'))->description('Set url.')->required(false)->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $name = $this->getArgumentValue('name');
        $syntax = $this->getArgumentValue('syntax');
        $expiration = $this->getArgumentValue('expiration');
        $url = $this->getArgumentValue('url');
        $this->runAllSeeds($name, $syntax, $expiration, $url);
        return 0;
    }

    function runAllSeeds(string $name, string $syntax, string $expiration, string $url): void {
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
                    $seeder->seed($name, $syntax, $expiration, $url);
                }
                else throw new \Exception('Seeder must be a class that subclasses the seeder interface');
            }
        }
    }
}