<?php

    $pageArray = [];
    $pageDir = scandir('./pages/');
    // print_r($pageDir);
    foreach($pageDir as $page){
        if($page!='.' && $page!=".."){
            // array_push($pageArray, $page);
            array_push($pageArray, basename($page, '.php'));

        }
    }
    // print_r($pageArray);

    $reqURL = $_SERVER['REQUEST_URI'];
    // echo $reqURL;

    if($reqURL == "/" || $reqURL == ""){
        $page = "home";
    }else{
        $page = basename($reqURL);
    }
    // echo $page;
    foreach($pageArray as $pageName){
        if($pageName == $page){
            $pageCompo = "./pages/$page.php";
            break;
        }
    } 
    if(!isset($pageCompo)){
        $pageCompo = './pages/404.php';
    }
?>