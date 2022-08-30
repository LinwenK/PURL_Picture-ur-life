<?php 
    

    if(isset($_GET['id']) && isset($_GET['action'])){

        $id = $_GET['id'];

        $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);
        if($dbcon->connect_error){
            echo "<h1>".$dbcon->connect_error."</h1>";
            // die("connection");//stop directly
        }else{

            switch($_GET['action']){
                case "del":
                    $delcmd = "DELETE FROM user_tb WHERE user_id='$id'";
                    if($dbcon->query($delcmd) === true){
                        echo "<h1>This user deleted</h1>";
                    }else{
                        echo "<h1>Action failure</h1>";
                    }
                    header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/user");

                break;

                case "edit":
                    // $selectUser ="SELECT `user_id`, `password` ,`email` ,`gender`, `birthday` FROM user_tb WHERE user_id='$id'";
                    $selectUser ="SELECT `user_id`, `email` ,`gender`, `birthday` FROM user_tb WHERE user_id='$id'";
                    $result = $dbcon->query($selectUser) or die($dbcon->error);
                    // $userData = $result->fetch_assoc();
                    // $_SESSION['userData'] =  $userData;
                    // print_r($result);
                    $_SESSION['userData'] = $result->fetch_assoc();

                    // print_r($_SESSION['userData']);

                    header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/userEdit");
                    break;
            }

        }
        $dbcon->close();
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
        
    <section class="top-side">
        <figure class="intro-photo">
            <img src="./img/logo.png" alt="left photo">
            <h1>Admin Dashboard</h1>
        </figure>   
        
        <div class="gotoRegister">
            <a href="/userRegister" >Add a User</a>
            <a href="/post" >Post Management</a>

        </div>
    </section>

    <!-- <table border="1" id="user_tb"> -->
    <table id="user_tb">
        <thead>
            <tr>
                <th>User ID</th>
                <!-- <th>Password</th> -->
                <th>E-mail</th>
                <th>Gender</th>
                <th>Birthday</th>
                <th>Create ID Date</th> 
                <th>Login Fuilure</th>

                <!-- <th colspan="2">Actions</th> -->
                <th>Edit</th>
                <th>Delete</th>


                
            </tr>
        </thead> 
        <tbody>
            <?php

                $dbcon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);
                if($dbcon->connect_error){
                    echo "<h1>".$dbcon->connect_error."test11</h1>";
                }else{
                    $selectCmd = "SELECT * FROM user_tb";
                    $result = $dbcon->query($selectCmd) or die($dbcon->error);;

                    // $users = [];
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>".$row['user_id']."</td>";   
                            // echo "<td>".$row['password']."</td>";    
                            echo "<td>".$row['email']."</td>";    
                            echo "<td>".$row['gender']."</td>";   
                            echo "<td>".$row['birthday']."</td>";   
                            echo "<td>".$row['create_id_date']."</td>";    
                            echo "<td>".$row['login_failure_num']."</td>";   



                            echo "<td><a class='btn' href='".$reqURL."?id=".$row['user_id']."&action=edit'>Go to Edit</a></td>";

                            echo "<td><a class='btn' href='".$reqURL."?id=".$row['user_id']."&action=del'>Delete and Save</a></td>";                            

                        echo "</tr>";
                    }
                    $dbcon->close();
                }
            ?>




        </tbody>
    </table>
    
</body>
</html>