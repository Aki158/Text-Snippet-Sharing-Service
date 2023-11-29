<?php

namespace Views;

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Helpers\DatabaseHelper;

DatabaseHelper::checkSnippetsExpiration();
$snippetsTable = DatabaseHelper::getSnippetsTableInfo();

include 'layout/header.php';

?>

<script type="text/javascript">
    var snippetsTable = <?php echo json_encode($snippetsTable); ?>;
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
        <tbody id="tableBody"></tbody>
    </table>
    <div class="col d-flex justify-content-center">
        <nav>
            <ul id="page_button_group" class="pagination"></ul>
        </nav>
    </div>
</div>

<script src="../Public/js/app_publicSnippets.js"></script>
<?php include 'layout/footer.php'; ?>