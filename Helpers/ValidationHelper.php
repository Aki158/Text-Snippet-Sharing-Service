<?php

namespace Helpers;

class ValidationHelper
{
    public static function integer($value, float $min = -INF, float $max = INF): int
    {
        $value = filter_var($value, FILTER_VALIDATE_INT, ["min_range" => (int) $min, "max_range"=>(int) $max]);

        // 結果がfalseの場合、フィルターは失敗
        if ($value === false) throw new \InvalidArgumentException("The provided value is not a valid integer.");

        // 値がすべてのチェックをパスしたら、そのまま返す
        return $value;
    }

    public static function string($value): string
    {
        if (!is_string($value)) throw new \InvalidArgumentException("The provided value is not a valid string.");
        return $value;
    }

    public static function code($value): string
    {
        $snippetStatus = '';

        if(strlen($value) >= 65535){
            $snippetStatus = "ExceedsBytes";
        }
        else if(strlen($value) == 0){
            $snippetStatus = "EmptySnippet";
        }
        else if(!(mb_check_encoding($value, 'UTF-8'))){
            $snippetStatus = "non-UTF-8";
        }

        if($snippetStatus !== ''){
            header("Location: /newSnippet?snippetStatus=".$snippetStatus);
            exit;
        }
        return $value;
    }

    public static function path($path,$prefix): string
    {
        if (substr($path, 0, strlen($prefix)) === $prefix) {
            $path = $prefix;
        }
        return $path;
    }
}