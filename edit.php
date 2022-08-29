<?php
    include './config.php';
    session_start();
    if(!isset($_SESSION['postData'])){
        header("Location: http://localhost/php/FINAL_PROJECT/postDisplay.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input{
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
            $updateCmd = "UPDATE post_tb SET user_id='".$_POST['user_id']."', post_uid='".$_POST['post_uid']."', post_date='".$_POST['post_date']."', photo_src='".$_POST['photo_src']."', tags='".$_POST['tags']."', addr='".$_POST['addr']."' WHERE user_id='".$_POST['user_id']."'";
            if($dbcon->query($updateCmd) === true){
                $dbcon->close();
                unset($_SESSION['postData']);
                header("Location: http://localhost/php/FINAL_PROJECT/postDisplay.php");
            }
        }
    ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
            foreach($_SESSION['postData'] as $fieldName=>$value){
                $label = $fieldName;
                switch($fieldName){
                    case "post_date":
                        $type = "date";
                        $label = "POST DATE";
                    break;
                    default:
                        $type = "text";
                        // $uppercase = ucfirst($fieldName);
                        $label = str_replace("_"," ",strtoupper($fieldName));
                }
                echo "<label for='$fieldName'>$label</label>";
                echo "<input type='$type' name='$fieldName' value='$value' required/></br>";
            }
        ?>
        <button type="submit">Update</button>
    </form>
</body>
</html>
