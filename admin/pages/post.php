<?php 
    $dbCon = new mysqli($dbServername, $dbUsername, $dbPass, $dbName);


    if(($_SESSION['timeout'] < time()) || (!isset($_SESSION['user']))){
      session_unset();
      session_destroy();
      header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/login");
  }

  if(isset($_GET['action'])){
      switch($_GET['action']){
          case "exit":
              session_unset();
              session_destroy();
              header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/login");
          break;

          
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
                  $selCmd = "SELECT * FROM post_tb WHERE post_uid='$id'";
                  $result = $dbcon->query($selCmd);
                  $row = $result->fetch_assoc();

                  $delcmd = "DELETE FROM post_tb WHERE post_uid='$id'";
                  if($dbcon->query($delcmd) === TRUE){
                      unlink($row['photo_src']);
                      $_SESSION['flag'] = "This post deleted";
                  }else{
                    $_SESSION['flag'] = "Action failed";
                  }
                  header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/post");
              break;
              case "edit":
                  $selectuser = "SELECT * FROM post_tb WHERE user_id='$id'";
                  $result = $dbcon->query($selectuser);
                  $_SESSION['postData'] = $result->fetch_assoc();
                  $dbcon->close();
                  header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/postEdit");
              break;
          }
          $dbcon->close();
      }
  }

  if($_SERVER['REQUEST_METHOD'] == "POST"){
      if(isset($_POST["keyword"]) && (strlen($_POST["keyword"]) > 2)){
          $keyword = $_POST["keyword"];
          if($dbCon->connect_error){
              die("Connect error");
          }else{
              $resultArray = [];
              $searchPostCmd = "SELECT * FROM post_tb WHERE tags LIKE '%$keyword%';";
              // $searchPostCmd = "SELECT * FROM post_tb WHERE LOCATE('$keyword', tags) > 0;"; 
              $result = $dbCon->query($searchPostCmd);
              while($row = $result->fetch_assoc()){
              array_push($resultArray, $row);
              }
          }
      }else{
        if(strlen($_POST["keyword"]) <= 2 && strlen($_POST["keyword"]) > 0){
          $_SESSION['flag'] = "Keyword is too short. Please enter more than 3 characters.";
        }else if(strlen($_POST["keyword"]) == 0){
          $_SESSION['flag'] = "Please enter the keyword.";
        }
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
<section class="top-side">
        <figure class="intro-photo">
            <img src="./img/logo.png" alt="left photo">
            <h1>Admin Dashboard Post Data</h1>
        </figure>   
        
        <div class="gotoRegister">
            <a href='user?action=exit'>Log Out</a>  
            <a href="/postAdd" >Add a Post</a>
            <a href="/user" id="goPost">User Management</a>

        </div>
    </section>
  <!-- <h1>PURL DASHBOARD</h1> -->
  <form id="srbtn"method="POST" action="<?php './pages/post.php';?>">
  <?php
    echo "<input type='text' name='keyword' placeholder='Enter the keywords'/>";
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
        if(isset($_SESSION['flag'])){
          echo "<h2>".$_SESSION['flag']."</h2>";
          unset($_SESSION['flag']);
        }
        echo "<table id='post_tb'><thead><tr><th>User ID</th><th>Post UID</th><th>Post Date</th><th>Photo</th><th>Tags</th><th>Address</th><th>Edit</th><th>Delete</th></tr></thead>";
        echo "<tbody>";
        foreach($resultArray as $key=>$post){
            $index = "post".$key;
            echo "<tr><td>".$post["user_id"]."</td>";
            echo "<td>".$post["post_uid"]."</td>";
            echo "<td>".$post["post_date"]."</td>";
            echo "<td><img class='item_img' style='width:100%;' src=".$path.$post["photo_src"]." alt=".$post["tags"]."><a class='dbtn' href='".$path.$post["photo_src"]."' download>Download</a>"."</td>";
            echo "<td>".$post["tags"]."</td><td><span>".$post["addr"]."</span></br><button type='button' class='btn btn-primary map-btn' data-bs-toggle='modal' data-bs-target='#".$index."'>Open the map</button>"."</td>";
            echo "<td><a class='pbtn' href='".$reqURL."?id=".$post['user_id']."&action=edit'>Go to Edit</a></td>";
            echo "<td><a class='pbtn' href='".$reqURL."?id=".$post['post_uid']."&action=delete'>Delete and Save</a></td></tr>";
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
          <h5 class="modal-title" id="exampleModalLabel">Address : <?php echo $post["addr"];?></h5>
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