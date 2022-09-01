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

    $reqURL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
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
    // echo $pageCompo;

    if(!isset($pageCompo)){
        $pageCompo = './pages/404.php';
    }
?>