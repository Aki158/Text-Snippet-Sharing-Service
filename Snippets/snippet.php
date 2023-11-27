<?php

namespace Snippets;

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;

// 保存機能

// newSnippet.php の入力フォームから値を受け取る
// 受け取った値をチェックする
// $name = ValidationHelper::string($_POST["name"]??"Untitled");
// $syntax = ValidationHelper::string($_POST["syntax"]??null);
// $expiration = ValidationHelper::string($_POST["expiration"]??null);

$name = $_POST["name"] !== ""?$_POST["name"]:"Untitled";
$syntax = $_POST["syntax"]??null;
$expiration = $_POST["expiration"]??null;

// 一意のURLを生成する
// hash関数は文字列からハッシュ値を生成するので入力の文字列が必要。
// strには、monaco-editorの情報を入れる
$data = file_get_contents("../Temp/edit.txt");
$date = date("Y-m-d H:i:s");
$url = hash("md5",$date);

// outputフォルダの直下にurlフォルダを作成しnameファイルを保存する
$folderPath = "../Outputs/".$url;
$file = $folderPath."/".$name.".txt";

mkdir($folderPath);
file_put_contents($file,$data);

print("name : ".$name."\n");
print("syntax : ".$syntax."\n");
print("expiration : ".$expiration."\n");
print("data : ".$data."\n");
print("url : ".$url."\n");

// DBにデータを追加する
$command = sprintf("php ../console seed --name %s --syntax %s --expiration %s --url %s", $name, $syntax, $expiration, $url);
print($command);
exec($command, $output);

foreach ($output as $line) {
    echo $line . PHP_EOL;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style.css">

    <title>Text Snippet Sharing Service</title>
    <div class="bg-info">
        <div class="container d-flex justify-content-between">
            <h3 class="py-3">Text Snippet Sharing Service</h3>
            <div>
                <a href="newSnippet.php" class="btn btn-primary m-3">New Snippet</a>
                <a href="publicSnippets.php" class="btn btn-primary m-3">Public Snippets</a>            
            </div>
        </div>
    </div>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
    <script src="../public/js/app_snippet.js"></script>
    <main>
        <div class="container">
            <h4 class="my-2"><?php print($name)?></h4>
            <div class="d-flex">
                <div id="editor" class="editor-box col my-2 px-0"></div>
            </div>
        </div>
    </main> <!-- end of content -->

<footer class="bg-light text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        ©:
        <a class="text-dark" href="/">Text Snippet Sharing Service</a>
    </div>
</footer>

</body>
</html>