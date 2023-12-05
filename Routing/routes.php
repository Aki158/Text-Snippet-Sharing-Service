<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;

return [
    ''=>function(): HTTPRenderer{
        $snippetStatus = ValidationHelper::string($_GET['snippetStatus']??'');

        return new HTMLRenderer('newSnippet', ['snippetStatus'=>$snippetStatus]);
    },
    'newSnippet'=>function(): HTTPRenderer{
        $snippetStatus = ValidationHelper::string($_GET['snippetStatus']??'');

        return new HTMLRenderer('newSnippet', ['snippetStatus'=>$snippetStatus]);
    },
    'publicSnippets'=>function(): HTTPRenderer{
        DatabaseHelper::checkSnippetsExpiration();
        $snippetsTable = DatabaseHelper::getSnippetsTableInfo();

        return new HTMLRenderer('publicSnippets', ['snippetsTable'=>$snippetsTable]);
    },
    'snippet'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/snippet/');
        $path = ValidationHelper::string($path);
        $snippet = DatabaseHelper::getSnippet($path);

        return new HTMLRenderer('snippet', ['snippet'=>$snippet]);
    },
    'expiredSnippet'=>function(): HTTPRenderer{
        return new HTMLRenderer('expiredSnippet', ['expiredSnippet'=>'Expired Snippet']);
    },
    'api'=>function(): HTTPRenderer{
        $snippetStatus = ValidationHelper::string($_GET['snippetStatus']??'');

        return new JSONRenderer(['snippetStatus'=>$snippetStatus]);
    },
    'api/newSnippet'=>function(): HTTPRenderer{
        $snippetStatus = ValidationHelper::string($_GET['snippetStatus']??'');

        return new JSONRenderer(['snippetStatus'=>$snippetStatus]);
    },
    'api/publicSnippets'=>function(){
        DatabaseHelper::checkSnippetsExpiration();
        $snippetsTable = DatabaseHelper::getSnippetsTableInfo();

        return new JSONRenderer(['snippetsTable'=>$snippetsTable]);
    },
    'api/snippet'=>function(){
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/snippet/');
        $path = ValidationHelper::string($path);        
        $snippet = DatabaseHelper::getSnippet($path);

        return new JSONRenderer(['snippet'=>$snippet]);
    },
    'api/expiredSnippet'=>function(): HTTPRenderer{
        return new JSONRenderer(['expiredSnippet'=>'Expired Snippet']);
    },
];