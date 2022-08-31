<?php
    include './include/config.php'; 
    include './websettings/routing.php';
    //put the content pages
    include './masterpages/header.php';
    include $pageCompo;
    include './masterpages/footer.php';
?>