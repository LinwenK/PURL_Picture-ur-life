<?php

    if(!isset($_SESSION['userData'])){
        header("Location: http://localhost/project_me/user.php");
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <?php
    // print_r($_SESSION['userData']);

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);

            // $updateCmd = "UPDATE user_tb SET user_id='".$_POST['user_id']."', password ='".$_POST['password']."', email ='".$_POST['email']."',  create_id_date='".$_POST['create_id_date']."',  gender='".$_POST['gender']."', birthday ='".$_POST['birthday']."', login_failure_num='".$_POST['login_failure_num']."' WHERE user_id='".$_POST['user_id']."' ";

            $updateCmd = "UPDATE user_tb SET user_id='".$_POST['user_id']."', email ='".$_POST['email']."',  gender='".$_POST['gender']."', birthday ='".$_POST['birthday']."' WHERE user_id='".$_POST['user_id']."' ";


            $result = $dbcon->query($updateCmd) or die($dbcon->error);
            if($dbcon->query($updateCmd)=== true){
                $dbcon->close();
                session_unset();
                echo "<h1>Update Success</h1>";
                header("Location: http://localhost/project_me/user.php");
            }
        }
        
    ?>


    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php

        foreach($_SESSION['userData'] as $fieldName=>$value){
            // echo "$fieldName-$value</br>";
            $label = $fieldName;
            switch($fieldName){
                case "user_id":
                    $type = "text";
                    $label = "User ID";
                break;

                case "password":
                    $type = "password";
                    $label = "Password";
                break;

                case "email":
                    $type = "email";
                    $label = "E-mail";
                break;

                case "gender":
                    $type = "text";
                    $label = "Gender";
                break;

                case "birthday":
                    $type = "date";
                    $label = "Birthday";
                break;

                case "create_id_date":
                    $type = "date";
                break;


                default:
                    $type = "text";
            }
            echo "<label for='$fieldName'>$label</label>";
            echo "<input type='$type' name='$fieldName' value = '$value' required></br>";

        }
    ?>
    <button type="submit">Update</button>

    </form>
    
</body>
</html>