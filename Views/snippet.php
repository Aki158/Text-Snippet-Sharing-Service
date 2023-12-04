<?php

namespace Views;

?>

<script type="text/javascript">
    var snippet = <?php echo json_encode($snippet); ?>;
</script>

<div class="container mb-5">
    <h4 class="my-2"><i class="fa-regular fa-file"></i> <?= htmlspecialchars($snippet["name"])?></h4>
    <div class="d-flex justify-content-between">
        <div>
            <p><i class="fa-solid fa-code"></i> Syntax : <?= htmlspecialchars($snippet["syntax"])?></p>
            <p><i class="fa-solid fa-calendar-days"></i> Created date : <?= htmlspecialchars($snippet["created_at"])?></p>
            <p><i class="fa-solid fa-bell"></i> Expiration : <?= htmlspecialchars($snippet["expiration"])?></p>
        </div>
        <div class="d-flex justify-content-end flex-column align-items-end">
            <button id="copy_button" class=""><i class="fa-regular fa-clipboard fa-xl"></i> Copy code</button>
            <i class="bi bi-clipboard"></i>
            <p id="copy_message" class="text-danger">　</p>
        </div>
    </div>
    <div class="d-flex">
        <div id="editor" class="editor-box col my-2 px-0"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
<script src="../Public/js/app_snippet.js"></script>
