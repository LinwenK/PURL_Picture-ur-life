<?php 
    include './include/config.php'; 
    

    if(isset($_GET['id']) && isset($_GET['action'])){
        session_start();

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
                        echo "<h1>Data deleted</h1>";
                    }else{
                        echo "<h1>Action failure</h1>";
                    }
                break;

                case "edit":
                    echo "<h1>dddtttt edit</h1>";

                    // $selectUser ="SELECT `user_id`, `password` ,`email` ,`gender`, `birthday` FROM user_tb WHERE user_id='$id'";
                    $selectUser ="SELECT `user_id`, `email` ,`gender`, `birthday` FROM user_tb WHERE user_id='$id'";
                    $result = $dbcon->query($selectUser) or die($dbcon->error);
                    // $userData = $result->fetch_assoc();
                    // $_SESSION['userData'] =  $userData;
                    // print_r($result);
                    $_SESSION['userData'] = $result->fetch_assoc();

                    // print_r($_SESSION['userData']);

                    header("Location: http://localhost/project_me/userEdit.php");
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

    <style>
        .btn{
            text-decoration:none;
            color:black;
            padding:12px 16px;
            border:1px solid black;
            border-radius: 5px;
            background-color: blanchedalmond;
        }
        .btn:hover{
            background-color: gainsboro;
            cursor: pointer;
        }
        td, th{
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>User ID</th>
                <!-- <th>Password</th> -->
                <th>E-mail</th>
                <!-- <th>Create Date</th> -->
                <th>Gender</th>
                <th>Birthday</th>
                <!-- <th>Fuilure</th> -->

                <th colspan="2">Actions</th>
                
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
                            // echo "<td>".$row['create_id_date']."</td>";    
                            echo "<td>".$row['gender']."</td>";   
                            echo "<td>".$row['birthday']."</td>";   
                            // echo "<td>".$row['login_failure_num']."</td>";   

                            echo "<td><a class='btn' href='".$_SERVER['PHP_SELF']."?id=".$row['user_id']."&action=del'>Delete</a></td>";

                            echo "<td><a class='btn' href='".$_SERVER['PHP_SELF']."?id=".$row['user_id']."&action=edit'>Edit</a></td>";

                        echo "</tr>";
                    }
                    $dbcon->close();
                }
            ?>




        </tbody>
    </table>
    
</body>
</html>