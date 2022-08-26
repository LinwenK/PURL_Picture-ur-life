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
                echo "<tr><td>$user->user_id</td><td>$user->password</td><td>$user->email</td><td>$user->create_id_date</td><td>$user->gender</td><td>$user->birthday</td><td>$user->login_failure_num</td></tr>";
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