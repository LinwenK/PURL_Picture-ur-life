<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id = 'login'>

        <video autoplay loop muted class='v-home'>
            <source src='./img/home.mp4' type='video/mp4'>
        </video>

        <div id = 'loginOption'>
            <div class='button1'>
                <a id='go' href='/go'>
                    Explore this world
                </a>
            </div> 
            <div class='button2'>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>User ID</label>
                <input name="userid" type="text" />
                <label>Password</label>
                <input name="pass" type="password"/>
                <button type="submit">Log in</button>
                <a href="/user">User</a>
            </form> 
            </div>   
            
        </div>
    </div>

    
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $userid = $_POST['userid'];
            $pass = $_POST['pass'];
            $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);

            if($dbcon->connect_error){
                die("Error: ".$dbcon->connect_error);
            }else{
                $selectCmd = "SELECT * FROM user_tb WHERE user_id='$userid';";
                $result = $dbcon->query($selectCmd) or die($dbcon->error);

                if($result->num_rows > 0){
                    $user = $result->fetch_assoc();
                    $hashedPass = $user['password'];

                    if(password_verify($pass,$hashedPass)){
                        $_SESSION['user'] = $user;
                        $dbcon->close();
                        $_SESSION['timeout'] = time() + 10;
                        header("Location: http://localhost/user");                    
                    }else{
                        echo "You didn't enter the correct Password";
                    }
                }else{
                    echo "The User ID entered doesn't exist. Please check that you have typed your User ID correctly";
                }
                $dbcon->close();
            }
        }
    ?>
</body>
</html>

