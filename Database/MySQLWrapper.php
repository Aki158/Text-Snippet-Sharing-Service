<?php

namespace Database;

use mysqli;
use Helpers\Settings;

class MySQLWrapper extends mysqli{
    protected $username;
    public function __construct(?string $hostname = 'localhost', ?string $username = null, ?string $password = null, ?string $database = null, ?int $port = null, ?string $socket = null)
    {
        /*
            接続の失敗時にエラーを報告し、例外をスローする
            データベース接続を初期化する前にこの設定を行うこと
            テストするには、.env設定で誤った情報を入力する
        */
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $username = $username??Settings::env('DATABASE_USER');
        $password = $password??Settings::env('DATABASE_USER_PASSWORD');
        $database = $database??Settings::env('DATABASE_NAME');

        $this->username = $username;

        parent::__construct($hostname, $username, $password, $database, $port, $socket);
    }

    // クエリが問い合わせられるデフォルトのデータベースを取得する
    // エラーは失敗時にスローされます（つまり、クエリがfalseを返す、または取得された行がない）
    // これらに対処するためにifブロックやcatch文を使用することもできる
    public function getDatabaseName(): string{
        return $this->query("SELECT database() AS the_db")->fetch_row()[0];
    }

    public function getUsername(): string{
        return $this->username;
    }
}