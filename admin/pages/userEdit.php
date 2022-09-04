
<?php
    if(!isset($_SESSION['userData'])){
        header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/user");    
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
<section class="top-side">
        <figure class="intro-photo">
            <img src="./img/logo.png" alt="left photo">
            <h1>Admin Dashboard User Data</h1>

        </figure>   
        
        <div class="gotoRegister">
            <a href='user?action=exit'>Log Out</a>
            <a href="/user" >Go back to User</a>
            <a href="/post" id="goPost">Post Management</a>

        </div>
    </section>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);



            $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                echo "<script>alert(Invalid Email","Please Check the email address);</script>";
            }else{

            $updateCmd = "UPDATE user_tb SET email ='".$email."',  gender='".$_POST['gender']."', birthday ='".$_POST['birthday']."' WHERE user_id='".$_SESSION['userData']['user_id']."' ";
 

            $result = $dbcon->query($updateCmd) or die($dbcon->error);
            if($result=== true){
                $dbcon->close();
                // session_unset();
                echo "<h1>Update Success</h1>";
                header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/user"); 


            }}
        }
        ?>

    <form id="edit" method="POST" action="<?php echo $reqURL; ?>">
    <?php

        foreach($_SESSION['userData'] as $fieldName=>$value){
            // echo "$fieldName-$value</br>";
            $label = $fieldName;
            // print_r($_SESSION['userData']);
            if($fieldName =="user_id"){
                echo "<h2>Personal Information</h2>";
                echo "<h2>user : $value</h2>";
            }else{
            switch($fieldName){
                // case "user_id":
                //     $type = "text";
                //     $label = "User ID";
                // break;

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
        }
    ?>
    <button type="submit">Update</button>

    </form>
