<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;

return [
    'random/part'=>function(): HTTPRenderer{
        $part = DatabaseHelper::getRandomComputerPart();

        // return new HTMLRenderer('component/computer-part-card', ['part'=>$part]);
        return new HTMLRenderer('random-part', ['part'=>$part]);
    },
    'parts'=>function(): HTTPRenderer{
        // IDの検証
        $id = ValidationHelper::integer($_GET['id']??null);

        $part = DatabaseHelper::getComputerPartById($id);
        
        // return new HTMLRenderer('component/computer-part-card', ['part'=>$part]);
        return new HTMLRenderer('parts', ['part'=>$part]);
    },
    // debug_start
    'types'=>function(): HTTPRenderer{
        $type = ValidationHelper::string($_GET['type']??null);
        $page = ValidationHelper::integer($_GET['page']??null);
        $perpage = ValidationHelper::integer($_GET['perpage']??null);

        $part = DatabaseHelper::getComputerPartByTypes($type,$page,$perpage);
        
        return new HTMLRenderer('types', ['part'=>$part]);
    },
    'random/computer'=>function(): HTTPRenderer{
        $part = DatabaseHelper::getRandomComputer();
        
        return new HTMLRenderer('random-computer', ['part'=>$part]);
    },
    'parts/newest'=>function(): HTTPRenderer{
        $page = ValidationHelper::integer($_GET['page']??null);
        $perpage = ValidationHelper::integer($_GET['perpage']??null);

        $part = DatabaseHelper::getComputerPartByNewest($page,$perpage);
        
        return new HTMLRenderer('newest-parts', ['part'=>$part]);
    },
    'parts/performance'=>function(): HTTPRenderer{
        $order = ValidationHelper::string($_GET['order']??null);
        $type = ValidationHelper::string($_GET['type']??null);

        $part = DatabaseHelper::getComputerPartByPerformance($order,$type);
        
        return new HTMLRenderer('performance-parts', ['part'=>$part]);
    },
    // debug_end
    'api/random/part'=>function(): HTTPRenderer{
        $part = DatabaseHelper::getRandomComputerPart();
        return new JSONRenderer(['part'=>$part]);
    },
    'api/parts'=>function(){
        $id = ValidationHelper::integer($_GET['id']??null);
        $part = DatabaseHelper::getComputerPartById($id);
        return new JSONRenderer(['part'=>$part]);
    },
    // debug_start
    'api/types'=>function(){
        $type = ValidationHelper::string($_GET['type']??null);
        $page = ValidationHelper::integer($_GET['page']??null);
        $perpage = ValidationHelper::integer($_GET['perpage']??null);

        $part = DatabaseHelper::getComputerPartByTypes($type,$page,$perpage);

        return new JSONRenderer(['part'=>$part]);
    },
    'api/random/computer'=>function(){
        $part = DatabaseHelper::getRandomComputer();

        return new JSONRenderer(['part'=>$part]);
    },
    'api/parts/newest'=>function(){
        $page = ValidationHelper::integer($_GET['page']??null);
        $perpage = ValidationHelper::integer($_GET['perpage']??null);

        $part = DatabaseHelper::getComputerPartByNewest($page,$perpage);

        return new JSONRenderer(['part'=>$part]);
    },
    'api/parts/performance'=>function(){
        $order = ValidationHelper::string($_GET['order']??null);
        $type = ValidationHelper::string($_GET['type']??null);

        $part = DatabaseHelper::getComputerPartByPerformance($order,$type);
        
        return new JSONRenderer(['part'=>$part]);
    }
    // debug_end
];