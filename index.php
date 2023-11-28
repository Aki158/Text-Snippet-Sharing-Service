<?php

spl_autoload_extensions(".php");
spl_autoload_register();

$DEBUG = true;

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

header("Location: Snippets/newSnippet.php");
exit;
?>
