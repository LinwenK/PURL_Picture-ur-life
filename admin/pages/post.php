<?php 

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
    if(isset($_GET['id']) && isset($_GET['action'])) {
        $id = $_GET['id'];
        $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
        if($dbcon->connect_error){
            die("connection error");
        }else{
            switch($_GET['action']){
                case "delete":
                    $delcmd = "DELETE FROM post_tb WHERE user_id='$id'";
                    if($dbcon->query($delcmd) === TRUE){
                        echo "<h1>Data deleted</h1>";
                    }else{
                        echo "<h1>Action failed</h1>";
                    }
                break;
                case "edit":
                    $selectuser = "SELECT * FROM post_tb WHERE user_id='$id'";
                    $result = $dbcon->query($selectuser);
                    $_SESSION['postData'] = $result->fetch_assoc();
                    $dbcon->close();
                    header("Location:http://localhost/Project_me/edit.php");
                break;
            }
            $dbcon->close();
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/search.css">
</head>
<body>

<section class="top-side">
        <figure class="intro-photo">
            <img src="./img/logo.png" alt="left photo">
            <h1>Admin Dashboard</h1>
        </figure>   
        
        <div class="gotoRegister">
            <a href="/postAdd" >Add Post</a>
            <a href="/user" >User Management</a>

        </div>
    </section>
  <h1>PURL DASHBOARD</h1>
  <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
  <?php
    echo "<input type='text' name='keyword'/>";
    echo "<button type='submit'>Search</button>";
  ?>
  </form>
  <?php
    $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
    if ($dbcon->connect_error){
        die("Connection error");
    }else{
        if(isset($resultArray)){
        $path = ".";
        echo "<table><thead><tr><th>User ID</th><th>Post UID</th><th>Post Date</th><th>Photo</th><th>Tags</th><th>Address</th><th colspan='3'>Actions</th></tr></thead>";
        echo "<tbody>";
        foreach($resultArray as $key=>$post){
            $index = "post".$key;
            echo "<tr><td>".$post["user_id"]."</td>";
            echo "<td>".$post["post_uid"]."</td>";
            echo "<td>".$post["post_date"]."</td>";
            echo "<td><img style='width:100%;' src=".$path.$post["photo_src"]." alt=".$post["tags"]."><a href='".$path.$post["photo_src"]."' download>Download</a>"."</td>";
            echo "<td>".$post["tags"]."</td><td><span>".$post["addr"]."</span></br><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#".$index."'>Open the map</button>"."</td>";
            echo "<td><a href='./add.php'>Add</a></td>";
            echo "<td><a href='".$_SERVER['PHP_SELF']."?id=".$post['user_id']."&action=edit'>Edit</a></td>";
            echo "<td><a href='".$_SERVER['PHP_SELF']."?id=".$post['user_id']."&action=delete'>Delete</a></td></tr>";
        }
        echo "</tbody></table>";

        }
        $dbcon->close();
    }
  ?>
  <?php
    if(isset($resultArray)){
      foreach($resultArray as $key=>$post){
        $index = "post".$key;
        $addr = str_replace(" ", "+", $post["addr"]);
  ?>
  <div class="modal fade" id="<?php echo $index;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Post date : <?php echo $post["post_date"];?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <iframe
          width="450"
          height="250"
          frameborder="0" style="border:0"
          referrerpolicy="no-referrer-when-downgrade"
          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBunR-4sODBjn5hcvBJmzf9L7_pKF905R4&q=<?php echo $addr;?>"
          allowfullscreen>
        </iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <?php
      }
    }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>