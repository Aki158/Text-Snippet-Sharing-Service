<?php

namespace Views;

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Helpers\ValidationHelper;

$name = ValidationHelper::string($_POST["name"] !== ""?$_POST["name"]:"Untitled");
$syntax = ValidationHelper::string($_POST["syntax"]??null);
$expiration = ValidationHelper::string($_POST["expiration"]??null);
$code = ValidationHelper::string("'".file_get_contents("../Temp/edit.txt")."'");
$date = ValidationHelper::string(date("Y-m-d H:i:s"));
$path = ValidationHelper::string(hash("md5",$date));

// DBにデータを追加する
$command = sprintf("php ../console seed --name %s --syntax %s --expiration %s --path %s --code %s", $name, $syntax, $expiration, $path, $code);
exec($command, $output);

// exec実行時エラーが出たら出力する
foreach ($output as $line) {
    echo $line . PHP_EOL;
}

header("Location: snippet.php?path=".$path);
exit;

?>