<?php

namespace Snippets;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style.css">

    <title>Text Snippet Sharing Service</title>
    <div class="bg-info">
        <div class="container d-flex justify-content-between">
            <h3 class="py-3">Text Snippet Sharing Service</h3>
            <div>
                <a href="newSnippet.php" class="btn btn-primary m-3">New Snippet</a>
                <a href="publicSnippets.php" class="btn btn-primary m-3">Public Snippets</a>            
            </div>
        </div>
    </div>
</head>
<body>
    <main>
        <div class="container">
            <h4 class="my-2">New Snippet</h4>
            <div class="d-flex">
                <div id="editor" class="editor-box col my-2 px-0"></div>
            </div>
            <form action="snippet.php" method="post">
                <h5 class="py-1">Optional Snippet Settings</h5>
                <div class="my-3">
                    <p class="my-1">Syntax Highlighting :</p>
                    <select name="syntax">
                        <option value="plaintext">plaintext</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="Python">Python</option>
                        <option value="Java">Java</option>
                        <option value="C#">C#</option>
                        <option value="PHP">PHP</option>
                        <option value="C++">C++</option>
                        <option value="Ruby">Ruby</option>
                        <option value="Go">Go</option>
                        <option value="Swift">Swift</option>
                        <option value="Kotlin">Kotlin</option>
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
                    <input id="inputName" type="text" name="name" size="30" maxlength="30">
                    <p id="errorMessage" class="my-1 text-danger" style="display: none;">Contains unsupported characters!<br>Unsupported characters : <br>. < > : " \ / | ? *</p>
                </div>
                <div class="my-4">
                    <input id="submitButton" type="submit" value="Create New Snippet">
                </div>
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
        <script src="../public/js/app_newSnippet.js"></script>
    </main> <!-- end of content -->
    

<footer class="bg-light text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        ©:
        <a class="text-dark" href="/">Text Snippet Sharing Service</a>
    </div>
</footer>

</body>
</html>