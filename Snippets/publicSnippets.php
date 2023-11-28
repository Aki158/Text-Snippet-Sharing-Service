<?php

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Helpers\DatabaseHelper;

$snippets_table = DatabaseHelper::getSnippetsTableInfo();


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
    <main>
        <script type="text/javascript">
            var snippets_table = <?php echo json_encode($snippets_table); ?>;
        </script>

        <div class="container">
            <h4><i class="fa-solid fa-table"></i> Snippets Archive</h4>
            <p>&#x2757; This page contains the most recently created 'public' Snippets.</p>
            <table class="table table-hover rem0p9">
                <thead>
                    <tr>
                        <th scope="col">NAME / TITLE</th>
                        <th scope="col">POSTED</th>
                        <th scope="col">SYNTAX</th>
                    </tr>
                </thead>
                <tbody id="table_body"></tbody>
            </table>
            <div class="col d-flex justify-content-center">
                <nav>
                    <ul id="page_button_group" class="pagination"></ul>
                </nav>
            </div>
        </div>

        <script src="../public/js/app_publicSnippets.js"></script>
    </main> <!-- end of content -->

<footer class="bg-light text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        ©:
        <a class="text-dark" href="/">Text Snippet Sharing Service</a>
    </div>
</footer>

</body>
</html>