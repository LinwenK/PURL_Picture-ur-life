<?php
    include './include/config.php'; 
    include './masterpages/header.php';

    //put the content pages
    include './websettings/routing.php';
    include $pageCompo;
    echo $reqURL;

    include './masterpages/footer.php';
?>