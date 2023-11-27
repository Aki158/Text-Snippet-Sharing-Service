<?php
namespace Snippets;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json_data = file_get_contents("php://input");
    $hashmap = json_decode($json_data, true);
    $data = $hashmap["data"];
    $file_name = $hashmap["file_name"];
    $file_type = $hashmap["file_type"];
    $file_path = "../Temp/".$file_name.".".$file_type;

    // ファイルを保存する
    file_put_contents($file_path, $data);

    if(is_file($file_path)){
        print("success");
    }
    else{
        print($file_path);
    }
}
?>
