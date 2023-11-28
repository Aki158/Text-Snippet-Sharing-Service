<?php

namespace Helpers;

use Database\MySQLWrapper;
use DateTime;

class DatabaseHelper
{
    public static function checkSnippetsExpiration(): void{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM snippet");
        $stmt->execute();

        $result = $stmt->get_result();

        while ($snippet = $result->fetch_assoc()) {
            if(self::isExpired($snippet["expiration"], $snippet["created_at"])){
                self::deleteSnippet($snippet["path"]);
            }
        }
    }

    public static function isExpired(string $expiration, string $pre): bool{
        $now = date("Y-m-d H:i:s");
        $expirationValue = PHP_INT_MAX;

        if($expiration === "10min"){
            $expirationValue = 10;
        }
        else if($expiration === "1h"){
            $expirationValue = 60;
        }
        else if($expiration === "1day"){
            $expirationValue = 1440;
        }

        $preTime = new DateTime($pre);
        $currentTime = new DateTime($now);
        $interval = $preTime->diff($currentTime);

        $minutes = $interval->days * 24 * 60;
        $minutes += $interval->h * 60;
        $minutes += $interval->i;

        return $expirationValue - $minutes < 0;
    }

    private static function deleteSnippet(string $path): void{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("DELETE FROM snippet Where path = ?");
        $stmt->bind_param('s', $path);
        $stmt->execute();
    }

    public static function getSnippetsTableInfo(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM snippet ORDER BY id DESC");
        $stmt->execute();

        $result = $stmt->get_result();
        $snippetsTable = [];
        $i = 0;

        while ($row = $result->fetch_assoc()) {
            $snippetsTable[$i] = [
                "name" => $row["name"],
                "posted" => self::getPostTime($row["created_at"]),
                "syntax" => $row["syntax"],
                "path" => $row["path"]
            ];
            $i++;
        }

        if (!$snippetsTable){
            $snippetsTable[0] = [
                "name" => "There are no snippets...<br>Let's create a new snippet!!!",
                "posted" => "None",
                "syntax" => "None",
                "path" => "None"
            ];
        }
        return $snippetsTable;
    }

    private static function getPostTime(string $pre): string{
        $now = date("Y-m-d H:i:s");
        $preTime = new DateTime($pre);
        $currentTime = new DateTime($now);
        $interval = $preTime->diff($currentTime);

        $minutes = $interval->days * 24 * 60;
        $minutes += $interval->h * 60;
        $minutes += $interval->i;

        return $minutes / 60 < 1 ? (int)$minutes." min ago" : (int)($minutes / 60)." hours ago" ;
    }
}