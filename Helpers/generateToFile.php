<?php

namespace Helpers;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jsonData = file_get_contents("php://input");
    $hashmap = json_decode($jsonData, true);
    $filePath = sprintf("../Temp/%s.%s", $hashmap["file_name"], $hashmap["file_type"]);

    file_put_contents($filePath, $hashmap["data"]);
}

?>
