<?php

namespace Helpers;

use Database\MySQLWrapper;
use Exception;
use DateTime;

class DatabaseHelper
{
    // public static function getRandomComputerPart(): array{
    //     $db = new MySQLWrapper();

    //     $stmt = $db->prepare("SELECT * FROM computer_parts ORDER BY RAND() LIMIT 1");
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $part = $result->fetch_assoc();

    //     if (!$part) throw new Exception('Could not find a single part in database');

    //     return $part;
    // }

    // public static function getComputerPartById(int $id): array{
    //     $db = new MySQLWrapper();

    //     $stmt = $db->prepare("SELECT * FROM computer_parts WHERE id = ?");
    //     $stmt->bind_param('i', $id);
    //     $stmt->execute();

    //     $result = $stmt->get_result();
    //     $part = $result->fetch_assoc();

    //     if (!$part) throw new Exception('Could not find a single part in database');

    //     return $part;
    // }
    // // debug_start
    // public static function getComputerPartByTypes(string $type, int $page, int $perpage): array{
    //     $db = new MySQLWrapper();

    //     $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = ?");
    //     $stmt->bind_param('s', $type);
    //     $stmt->execute();

    //     $result = $stmt->get_result();
    //     $parts = [];

    //     for($i = 0;$i < $page;$i++){
    //         for($j = 0;$j < $perpage;$j++){
    //             $parts[$i][$j] = $result->fetch_assoc();
    //         }
    //     }

    //     if (!$parts) throw new Exception('Could not find a single part in database');

    //     return $parts;
    // }
    // public static function getRandomComputer(): array{
    //     $db = new MySQLWrapper();
    //     $types = ["RAM","SSD","CPU","GPU"];
    //     $parts = [];

    //     for($i = 0;$i < count($types);$i++){
    //         $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = ? ORDER BY RAND() LIMIT 1");
    //         $stmt->bind_param('s', $types[$i]);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         $parts[$i] = $result->fetch_assoc();
    //     }

    //     if (!$parts) throw new Exception('Could not find a single part in database');

    //     return $parts;
    // }
    // public static function getComputerPartByNewest(int $page, int $perpage): array{
    //     $db = new MySQLWrapper();

    //     $stmt = $db->prepare("SELECT * FROM computer_parts ORDER BY updated_at DESC");
    //     $stmt->execute();

    //     $result = $stmt->get_result();
    //     $parts = [];

    //     for($i = 0;$i < $page;$i++){
    //         for($j = 0;$j < $perpage;$j++){
    //             $parts[$i][$j] = $result->fetch_assoc();
    //         }
    //     }

    //     if (!$parts) throw new Exception('Could not find a single part in database');

    //     return $parts;
    // }
    // public static function getComputerPartByPerformance(string $order, string $type): array{
    //     $db = new MySQLWrapper();

    //     $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = ? ORDER BY performance_score $order");
    //     $stmt->bind_param('s', $type);
    //     $stmt->execute();

    //     $result = $stmt->get_result();
    //     $parts = [];
    //     $num = 50;

    //     for($i = 0;$i < $num;$i++){
    //             $parts[$i] = $result->fetch_assoc();
    //     }

    //     if (!$parts) throw new Exception('Could not find a single part in database');

    //     return $parts;
    // }

    public static function getSnippets(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM snippet");
        $stmt->execute();

        $result = $stmt->get_result();
        $snippets = [];
        $i = 0;

        while ($snippets[$i] = $result->fetch_assoc()) {
            $i++;
        }

        if (!$snippets) throw new Exception('Could not find a single snippet in database');

        return $snippets;
    }

    public static function getSnippetsTableInfo(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM snippet ORDER BY id DESC");
        $stmt->execute();

        $result = $stmt->get_result();
        $snippets_table = [];
        $i = 0;
        $now = date("Y-m-d H:i:s");

        while ($row = $result->fetch_assoc()) {
            $snippets_table[$i] = [
                "name" => $row["name"],
                "posted" => self::getPostTime($now, $row["created_at"]),
                "syntax" => $row["syntax"],
                "path" => $row["path"]
            ];
            $i++;
        }

        if (!$snippets_table){
            $snippets_table[0] = [
                "name" => "There are no snippets...<br>Let's create a new snippet!!!",
                "posted" => "None",
                "syntax" => "None",
                "path" => "None"
            ];
        }
        return $snippets_table;
    }

    private  static function getPostTime(string $now, string $pre): string{
        $preTime = new DateTime($pre);
        $currentTime = new DateTime($now);
        $interval = $preTime->diff($currentTime);

        $minutes = $interval->days * 24 * 60;
        $minutes += $interval->h * 60;
        $minutes += $interval->i;

        return $minutes / 60 < 1 ? (int)$minutes." min ago" : (int)($minutes / 60)." hours ago" ;
    }
}