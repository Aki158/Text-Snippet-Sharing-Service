<?php
spl_autoload_extensions(".php");
spl_autoload_register();

$DEBUG = true;

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

// ルーティングを読み込みます。
$routes = include('Routing/routes.php');

// リクエストURIを解析してパスだけを取得します。
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = ltrim($path, '/');

// ルーティングにパスが存在するかチェックする
if (isset($routes[$path])) {
    // コールバックを呼び出してrendererを作成します。
    $renderer = $routes[$path]();

    try{
        // ヘッダーを設定します。
        foreach ($renderer->getFields() as $name => $value) {
            // ヘッダーに対する単純な検証を実行します。
            $sanitized_value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

            if ($sanitized_value && $sanitized_value === $value) {
                header("{$name}: {$sanitized_value}");
            } else {
                // ヘッダー設定に失敗した場合、ログに記録するか処理します。
                // エラー処理によっては、例外をスローするか、デフォルトのまま続行することもできます。
                http_response_code(500);
                if($DEBUG) print("Failed setting header - original: '$value', sanitized: '$sanitized_value'");
                exit;
            }

            print($renderer->getContent());
        }
    }
    catch (Exception $e){
        http_response_code(500);
        print("Internal error, please contact the admin.<br>");
        if($DEBUG) print($e->getMessage());
    }
} else {
    // マッチするルートがない場合、404エラーを表示します。
    http_response_code(404);
    echo "404 Not Found: The requested route was not found on this server.";
}