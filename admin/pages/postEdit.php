<?php
    // if(!isset($_SESSION['postData'])){
    //     header("Location: http://localhost/Project_me/postDisplay.php");
    // }

    if(!isset($_SESSION['postData'])){
        header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/post");    
    }

    if(($_SESSION['timeout'] < time()) || (!isset($_SESSION['user']))){
        session_unset();
        session_destroy();
        header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/login");
    }

    if(isset($_GET['action'])){
        switch($_GET['action']){
            case "exit":
                session_unset();
                session_destroy();
                header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/login");
            break;

            
        }
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
<body><section class="top-side">
        <figure class="intro-photo">
            <img src="./img/logo.png" alt="left photo">
            <h1>Admin Dashboard Post Data</h1>

        </figure>   
        
        <div class="gotoRegister">
            <a href='user?action=exit'>Log Out</a>
            <a href="/post" >Go back to Post</a>
            <a href="/user" id="goPost">User Management</a>

        </div>
    </section>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);

            $updateCmd = "UPDATE post_tb SET user_id='".$_POST['user_id']."', post_uid='".$_POST['post_uid']."', post_date='".$_POST['post_date']."', photo_src='".$_POST['photo_src']."', tags='".$_POST['tags']."', addr='".$_POST['addr']."' WHERE user_id='".$_POST['user_id']."'";
            if($dbcon->query($updateCmd) === true){
                $dbcon->close();
                unset($_SESSION['postData']);
                header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/post");
            }
        }
    ?>
    <form id="pedit" method="POST" action="<?php './pages/postEdit.php'; ?>">
        <?php
            echo "<h2>Post Information</h2>";

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
                $path = ".";
                $readonly = "readonly";
                switch($fieldName){
                    case "post_date":
                        echo "<label for='$fieldName'>$label</label>";
                        echo "<input type='$type' name='$fieldName' value='$value' required/></br>";
                    break;
                    case "photo_src":
                        echo "<label for='$fieldName'>$label</label>";
                        echo "<input type='$type' name='$fieldName' value='$value' $readonly required/></br>";
                        echo "<img style='width:100%;' src=".$path.$value."></br>";
                    break;
                    case "tags":
                        echo "<label for='$fieldName'>$label</label>";
                        echo "<input type='$type' name='$fieldName' value='$value' required/></br>";
                    break;
                    case "addr":
                        echo "<label for='$fieldName'>$label</label>";
                        echo "<input type='$type' name='$fieldName' value='$value' required/></br>";
                    break;
                    default:
                    echo "<label for='$fieldName'>$label</label>";
                    echo "<input type='$type' name='$fieldName' value='$value' $readonly required/></br>";
                }
            }
        ?>
        <button type="submit">Update</button>
    </form>
</body>
</html>