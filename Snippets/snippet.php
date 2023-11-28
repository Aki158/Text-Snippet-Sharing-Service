<?php

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Exception;
use Database\MySQLWrapper;

$path = $_GET['path']??null;

if(!$path) {
    die("No path specified.");
}

// データベース接続の初期化
$db = new MySQLWrapper();

try {
    // pathでスニペットを取得するステートメントを準備します。
    $stmt = $db->prepare("SELECT * FROM snippet WHERE path = ?");
    $stmt->bind_param('s', $path);
    $stmt->execute();

    $result = $stmt->get_result();
    $snippet = $result->fetch_assoc();
} catch (Exception $e) {
    die("Error fetching snippet by path: " . $e->getMessage());
}

if (!$snippet) {
    print("No snippet found with path: $path");
    exit;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b5fd11547c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../public/css/style.css">

    <title>Text Snippet Sharing Service</title>
    <div class="fixed-header bg-info">
        <div class="container d-flex justify-content-between">
            <h3 class="py-3">Text Snippet Sharing Service</h3>
            <div>
                <a href="newSnippet.php" class="btn btn-primary m-3"><i class="fa-solid fa-plus"></i> New Snippet</a>
                <a href="publicSnippets.php" class="btn btn-primary m-3"><i class="fa-solid fa-table"></i> Public Snippets</a>
            </div>
        </div>
    </div>
</head>
<body>
    <script type="text/javascript">
        var snippet = <?php echo json_encode($snippet); ?>;
    </script>
    
    <main>
        <div class="container mb-5">
            <h4 class="my-2"><i class="fa-regular fa-file"></i> <?= htmlspecialchars($snippet["name"])?></h4>
            <div class="d-flex justify-content-between">
                <div>
                    <p><i class="fa-solid fa-code"></i> Syntax : <?= htmlspecialchars($snippet["syntax"])?></p>
                    <p><i class="fa-solid fa-calendar-days"></i> Created date : <?= htmlspecialchars($snippet["created_at"])?></p>
                    <p><i class="fa-solid fa-bell"></i> Expiration : <?= htmlspecialchars($snippet["expiration"])?></p>
                </div>
                <div class="d-flex justify-content-end flex-column align-items-end">
                    <button id="copy_button" class=""><i class="fa-regular fa-clipboard fa-xl"></i> copy</button>
                    <i class="bi bi-clipboard"></i>
                    <p id="copy_message" class=" text-danger">　</p>
                </div>
            </div>
            <div class="d-flex">
                <div id="editor" class="editor-box col my-2 px-0"></div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
        <script src="../public/js/app_snippet.js"></script>

    </main> <!-- end of content -->


<footer class="bg-light text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        ©:
        <a class="text-dark" href="/">Text Snippet Sharing Service</a>
    </div>
</footer>

</body>
</html>