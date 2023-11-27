<?php

namespace Helpers;

use Exceptions\ReadAndParseEnvException;

class Settings{
    private const ENV_PATH =  '.env';

    public static function env(string $pair): string{
        /*
        dirname関数は、指定されたファイルパスの親ディレクトリのパスを返す関数です。
        この関数には「levels」という整数型のパラメータを設定することができ、
        これは「いくつ親ディレクトリを遡るか」を指定するものです。
        デフォルトではこの「levels」は1に設定されており、
        つまり、ファイルの直接の親ディレクトリのパスを返します。
        */
        $config = parse_ini_file( dirname(__FILE__, 2) . '/' . self::ENV_PATH);
        
        if($config === false){
            throw new ReadAndParseEnvException();
        }

        return $config[$pair];
    }
}
