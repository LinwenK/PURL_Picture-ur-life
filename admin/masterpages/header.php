<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        if($reqURL == "/post"){
            echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx' crossorigin='anonymous'>";
        }    
    ?>
    <link rel="stylesheet" href="./css/style.css">
    <?php 
        if($reqURL == "/post"){
            echo "<link rel='stylesheet' href='./css/post.css'>";
        }    
    ?>
    <title>Purl - Picture ur Life</title>
</head>
<body>