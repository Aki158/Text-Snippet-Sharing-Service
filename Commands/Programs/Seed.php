<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;
use Database\Seeder;

class Seed extends AbstractCommand
{
    protected static ?string $alias = 'seed';

    public static function getArguments(): array
    {
        return [
            (new Argument('name'))->description('Set name.')->required(false)->allowAsShort(true),
            (new Argument('syntax'))->description('Set syntax.')->required(false)->allowAsShort(true),
            (new Argument('expiration'))->description('Set expiration.')->required(false)->allowAsShort(true),
            (new Argument('path'))->description('Set path.')->required(false)->allowAsShort(true),
            (new Argument('code'))->description('Set code.')->required(false)->allowAsShort(true)
        ];
    }

    public function execute(): int
    {
        $name = $this->getArgumentValue('name');
        $syntax = $this->getArgumentValue('syntax');
        $expiration = $this->getArgumentValue('expiration');
        $path = $this->getArgumentValue('path');
        $code = $this->getArgumentValue('code');
        $this->runAllSeeds($name, $syntax, $expiration, $path, $code);
        return 0;
    }

    function runAllSeeds(string $name, string $syntax, string $expiration, string $path, string $code): void {
        $directoryPath = __DIR__ . '/../../Database/Seeds';

        // ディレクトリをスキャンしてすべてのファイルを取得する
        $files = scandir($directoryPath);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                // ファイル名からクラス名を抽出する
                $className = 'Database\Seeds\\' . pathinfo($file, PATHINFO_FILENAME);

                // シードファイルをインクルードする
                include_once $directoryPath . '/' . $file;

                if (class_exists($className) && is_subclass_of($className, Seeder::class)) {
                    $seeder = new $className(new MySQLWrapper());
                    $seeder->seed($name, $syntax, $expiration, $path, $code);
                }
                else throw new \Exception('Seeder must be a class that subclasses the seeder interface');
            }
        }
    }
}