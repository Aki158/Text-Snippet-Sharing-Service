<?php
spl_autoload_extensions(".php");
spl_autoload_register();

$DEBUG = true;

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

use Helpers\ValidationHelper;
// $name = ValidationHelper::string("test"??"Untitled");
// print("name : ".$name."\n");

?>

<script type="text/javascript">
    window.location.href = "Snippets/newSnippet.php";
</script>