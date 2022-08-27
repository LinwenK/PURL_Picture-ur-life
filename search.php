<?php 
  include './include/config.php'; 
  $dbCon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST["keyword"]) && (strlen($_POST["keyword"]) > 2)){
      $keyword = $_POST["keyword"];
      if($dbCon->connect_error){
        die("Connect error");
      }else{
        $resultArray = [];
        $searchPostCmd = "SELECT * FROM post_tb WHERE tags LIKE '%$keyword%'";
        $result = $dbCon->query($searchPostCmd);
        while($row = $result->fetch_assoc()){
          array_push($resultArray, $row);
        }
      }
    }else{
      echo "Keyword is too short";
    }
  }else{
    if($dbCon->connect_error){
      die("Connect error");
    }else{
      $resultArray = [];
      $searchPostCmd = "SELECT * FROM post_tb";
      $result = $dbCon->query($searchPostCmd);
      while($row = $result->fetch_assoc()){
        array_push($resultArray, $row);
      }
    }
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
  <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
  <?php
    echo "<input type='text' name='keyword'/>";
    echo "<button type='submit'>Search</button>";
  ?>
  </form>
  
  <?php
    if(isset($resultArray)){
      $path = ".";
      echo "<table border='1'><thead><tr><th>User ID</th><th>Post UID</th><th>Post Date</th><th>Photo</th><th>Tags</th><th>Address</th></tr></thead>";
      echo "<tbody>";
      foreach($resultArray as $post){
        echo "<tr><td>".$post["user_id"]."</td><td>".$post["post_uid"]."</td><td>".$post["post_date"]."</td>";
        echo "<td><img style='width:100%;' src=".$path.$post["photo_src"]." alt=".$post["tags"].">"."</td>";
        echo "<td>".$post["tags"]."</td><td>".$post["addr"]."</td></tr>";
      }
      echo "</tbody></table>";
    }
  ?>
</body>
</html>