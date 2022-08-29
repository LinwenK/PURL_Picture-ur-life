<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>User ID</label>
        <input name="user_id" placeholder="user id" require/>

        <label>Password</label>
        <input type="password" name="pass" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*?]).{8,}" require/>
        <p>(At least eight characters, including at least one number & one lower letters & one uppercase letters & one special characters)</p>

        <label>E-mail</label>
        <input type="email" name="email" placeholder="email" require/>

        <label>Gender</label>
        <input name="gender" type = "radio" value="Male" require/>Male
        <input name="gender" type = "radio" value="Female" require/>Female

        <label>Birthday</label>
        <input type="date" name="dob" require/>

        <button type="submit">Register</button>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $dbUsername = "root";
            $dbServername = "localhost";
            $dbPass = "";
            $dbname = "purl_db";
            $dbCon = new mysqli($dbServername,$dbUsername,$dbPass,$dbname);
            if($dbCon->connect_error){
                die("Connection error ".$dbCon->connect_error);
            }else{
                $pass= password_hash($_POST['pass'], PASSWORD_BCRYPT, ["cost"=>9]);
                $createDate = date("Y-m-d");

                $insertCmd = "INSERT INTO user_tb (user_id,password,email,gender,birthday,login_failure_num,create_id_date) VALUES ('".$_POST['user_id']."','".$pass."','".$_POST['email']."','".$_POST['gender']."','".$_POST['dob']."','0','$createDate')";
                
                $result = $dbCon->query($insertCmd);
                if($result === true){
                    echo "<h1 style='color: green;'>Welcome to Purl ! Your account has been created successfully.</h1>";
                }else{
                    echo "<h1 style='color: red;'>".$dbCon->error."</h1>";
                }
                $dbCon->close();
            }
        }
    ?>
</body>
</html>