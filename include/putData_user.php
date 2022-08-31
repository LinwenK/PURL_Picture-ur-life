<?php
  include './config.php';

  $addr = '../files/DB-user.json';
  $fileHandler = fopen($addr, 'r');
  $data = fread($fileHandler, filesize($addr));
  fclose($fileHandler);

  $userDatas = json_decode($data);

  $dbCon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);
  $selectCmd = "SELECT * FROM user_tb;";
  $result = $dbCon->query($selectCmd);

  if($result->num_rows == 0){
    foreach($userDatas as $userData){
      print_r($userData);
      echo "</br>";

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