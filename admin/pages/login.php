
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
                <form id="loginInfo" method="POST" action="<?php echo $reqURL; ?>" >

                <div class="q1">
                <label>User ID</label>
                <input name="userid" type="text" />
                </div>
                <div class="q2">
                <label>Password</label>
                <input name="pass" type="password"/>
                </div>
                <button type="submit">Log in</button>
                <!-- <a href="/user">User</a> -->
                </form> 
            </div>   
            
        </div>
    </div>

    
    <?php
    // echo time();
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
                        $dbcon->close();
                        $_SESSION['user'] = $user;
                        $_SESSION['timeout'] = time()+  (60*60);
                        echo "time()";


                        header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/user");                    
                    }else{
                        echo "<script>alert('You did not enter the correct Password! Please enter again.');</script> ";
                    }
                }else{
                    echo "<script>alert('The User ID entered does not exist! Please check that you have typed your User ID correctly.');</script> ";
                }
                $dbcon->close();
            }
        }
    ?>
