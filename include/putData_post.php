<?php
  include './config.php';

  $addr = '../files/DB-post.json';
  $fileHandler = fopen($addr, 'r');
  $data = fread($fileHandler, filesize($addr));
  fclose($fileHandler);

  $postDatas = json_decode($data);

  $dbCon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);
  $selectCmd = "SELECT * FROM post_tb;";
  $result = $dbCon->query($selectCmd);

  if($result->num_rows == 0){
    foreach($postDatas as $postData){
      print_r($postData);
      echo "</br>";
      $postDate = date("Y-m-d",strtotime($postData->post_date));
      $insertCmd = "INSERT INTO post_tb (user_id, post_uid, post_date, photo_src, tags, addr) VALUES ('$postData->user_id', '$postData->post_uid', '$postDate', '$postData->photo_src', '$postData->tags', '$postData->addr')";

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