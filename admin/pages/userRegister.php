<?php
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

    <form id="reg" method="POST" action="<?php "./pages".$reqURL.".php";?>">
        <div class="left">
            <p>test</p>
        </div> 
        <div class="right">   
        <h2> Add a User</h2>

        <div class="q1">
        <label>User ID</label>
        <input type="text" name="user_id" placeholder="user id" require/>
        </div>

        <div class="q2">
        <label>Password</label>
        <input type="password" name="pass" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*?]).{8,}" require/>
        <p>(At least eight characters, including at least one number & one lower letters & one uppercase letters & one special characters)</p>
        </div>

        <div class="q3">
        <label>E-mail</label>
        <input type="email" name="email" placeholder="email" require/>
        </div>

        <div class="q4">
        <label>Gender</label>
        <input name="gender" type = "radio" value="Male" require/>Male
        <input name="gender" type = "radio" value="Female" require/>Female
        </div>

        <div class="q5">
        <label>Birthday</label>
        <input type="date" name="dob" require/>
        </div>

        <button type="submit">Register</button>
        </div>
    </form>

    <?php 

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $dbUsername = "root";
            $dbServername = "localhost";
            $dbPass = "";
            $dbname = "purl_db";
            $dbCon = new mysqli($dbServername,$dbUsername,$dbPass,$dbname);
            $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $user_id = $_POST['user_id'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                echo "<script>alert(Invalid Email","Please Check the email address);</script>";
            }else{
                
                if($dbCon->connect_error){
                    die("Connection error ".$dbCon->connect_error);

                }else{

                    $select = "SELECT * FROM user_tb WHERE user_id='$user_id'";
                    $result_user = $dbCon->query($select);
                    if($result_user->num_rows==0){
                    
                        $pass= password_hash($_POST['pass'], PASSWORD_BCRYPT, ["cost"=>9]);
                        $createDate = date("Y-m-d");

                        
                        $insertCmd = "INSERT INTO user_tb (user_id,password,email,gender,birthday,login_failure_num,create_id_date) VALUES ('".$_POST['user_id']."','".$pass."','".$email."','".$_POST['gender']."','".$_POST['dob']."','0','$createDate')";
                        
                        $result = $dbCon->query($insertCmd);
                        if($result === true){
                            echo "<script>alert('Welcome to Purl ! Your account has been created successfully ! ');</script>";
                            header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/user");


                        }else{
                            // echo "<script>alert('".$dbCon->error."');</script>";
                            echo "<h1 style='color: red;'>".$dbCon->error."</h1>";
                        }
                    }else{


                        echo "<script>alert('This User_ID is already taken, please create another one User_ID');</script>";
                    }
                $dbCon->close();
                }
            }
        }
    ?>
