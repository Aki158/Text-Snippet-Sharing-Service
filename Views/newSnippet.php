<?php 

namespace Views;

include 'layout/header.php';

?>

<div class="container ">
    <h4><i class="fa-solid fa-plus"></i> New Snippet</h4>
    <div class="d-flex">
        <div id="editor" class="editor-box col my-2 px-0"></div>
    </div>
    <form action="createNewSnippet.php" method="post">
        <h5 class="py-1"><i class="fa-regular fa-pen-to-square"></i> Optional Snippet Settings</h5>
        <div class="container mb-3">
            <div class="row">
                <div class="col-md-4 bg-light rounded custom-border">
                    <div class="my-3">
                        <p class="my-1">Syntax Highlighting :</p>
                        <select name="syntax">
                            <option value="plaintext">plaintext</option>
                            <option value="javascript">javascript</option>
                            <option value="python">python</option>
                            <option value="java">java</option>
                            <option value="csharp">csharp</option>
                            <option value="php">php</option>
                            <option value="cpp">cpp</option>
                            <option value="ruby">ruby</option>
                            <option value="go">go</option>
                            <option value="swift">swift</option>
                            <option value="kotlin">kotlin</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <p class="my-1">Snippet Expiration :</p>
                        <select name="expiration">
                            <option value="10min">10min</option>
                            <option value="1h">1h</option>
                            <option value="1day">1day</option>
                            <option value="Never">Never</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <p class="my-1">Snippet Name / Title :</p>
                        <p id="errorMessage" class="my-1"><i class="fa-solid fa-triangle-exclamation"></i> Unsupported characters < > : " . / \ | ?*</p>
                        <input id="inputName" type="text" name="name" size="20" maxlength="30">
                    </div>
                    <div class="my-4">
                        <input id="submitButton" type="submit" value="Create New Snippet">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
<script src="../Public/js/app_newSnippet.js"></script>
<?php include 'layout/footer.php'; ?>