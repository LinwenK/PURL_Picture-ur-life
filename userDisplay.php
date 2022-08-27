<?php
    include './config.php';

    $addr= './files/DB-user.json';
    $fileHandler = fopen($addr, 'r');
    $data = fread($fileHandler, filesize($addr));
    fclose($fileHandler);

    $userDatas = json_decode($data);

    $dbCon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);
    $selectCmd = "SELECT * FROM user_tb;";
    $result = $dbCon->query($selectCmd);

    if($result->num_rows == 0){
        foreach($userDatas as $userData){
        $createDate = date("Y-m-d",strtotime($userData->create_id_date));
        $birthdayDate = date("Y-m-d",strtotime($userData->birthday));
        $pass = password_hash($userData->password, PASSWORD_BCRYPT, ["cost"=>9]);

        $insertCmd = "INSERT INTO user_tb (user_id, password, email, create_id_date, gender, birthday, login_failure_num) VALUES ('$userData->user_id', '$pass', '$userData->email', '$createDate', '$userData->gender', '$birthdayDate', '$userData->login_failure_num')";

        if($dbCon->query($insertCmd) === true){
            echo "done";
        }else{
            echo "false".$dbCon->error;
        }
        echo "</br>";
        }
    }
    $dbCon->close();
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
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Password</th>
                <th>Email</th>
                <th>Create Account</th>
                <th>Gender</th>
                <th>Birthday</th>
                <th>Last Login</th>
            </tr>
        </thead>
    <?php
        function loadData($userData){
            foreach($userData as $idx=>$user){
                echo "<tr><td>$user->user_id</td><td>$user->password</td><td>$user->email</td><td>$user->create_id_date</td><td>$user->gender</td><td>$user->birthday</td><td>$user->login_failure_num</td>";
                echo "<td> <form method='POST' action='";
                echo $_SERVER['PHP_SELF']."'><a href='./userEdit.php?idx=$idx'>Edit</a></td>";
                echo "<td><a href='./deleteUser.php?idx=$idx'>Delete</a></td></tr>";
            }
            echo "</table>";
        }
        $filehandler = fopen('./files/DB-user.json','r');
        $data = fread($filehandler,filesize('./files/DB-user.json'));
        fclose($filehandler);
        $userData = json_decode($data);
        if($_SERVER['REQUEST_METHOD']=="GET"){
            loadData($userData);
        }
    ?>
    </table>
</body>
</html>