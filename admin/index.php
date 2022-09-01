<?php
    include './websettings/config.php'; 
    include './websettings/routing.php';
    //put the content pages
    include './masterpages/header.php';

    // echo $reqURL.", page name: ".$page;
    include $pageCompo;
    include './masterpages/footer.php';
?>