<?php

$name = $_POST["name"] !== ""?$_POST["name"]:"Untitled";
$syntax = $_POST["syntax"]??null;
$expiration = $_POST["expiration"]??null;
$code = "'".file_get_contents("../Temp/edit.txt")."'";
$date = date("Y-m-d H:i:s");
$path = hash("md5",$date);

// print("name : ".$name."<br>");
// print("syntax : ".$syntax."<br>");
// print("expiration : ".$expiration."<br>");
// print("path : ".$path."<br>");
// print("code : ".$code."<br>");

// DBにデータを追加する
$command = sprintf("php ../console seed --name %s --syntax %s --expiration %s --path %s --code %s", $name, $syntax, $expiration, $path, $code);
exec($command, $output);

foreach ($output as $line) {
    echo $line . PHP_EOL;
}

header("Location: snippet.php?path=".$path);
exit;
?>