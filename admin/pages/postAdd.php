<?php 
    $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
    if($dbcon->connect_error) {
        die("Connection failed");
    }


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
            <h1>Admin Dashboard Post Data</h1>
        </figure>   
        
        <div class="gotoRegister">
            <a href='user?action=exit'>Log Out</a>
            <a href="/post" >Go back to Post</a>    
            <a href="/user" id="goPost">User Management</a>

        </div>
    </section>
    
    <form id="padd"method="POST" action="<?php "./pages".$reqURL.".php"; ?>" enctype="multipart/form-data">
        <h2> Add a Post</h2>
        <div class="q1">
    <label for="user_id">User ID</label>
        <input name="user_id" required/>
        </div>
        <!-- <label for="post_uid">Post UID</label>
        <input name="post_uid" required /> -->
        <div class="q2">
        <label for="post_date">Post Date</label>
        <input name="post_date" type="date" required/>
        </div>
        <div class="q3">

        <label for="photo_src">Upload Picture</label>
        <input name="photo_src" type="file" required/>
        </div>
        <div class="q4">
        <label for="tags">Tags</label>
        <input name="tags" required/>
        </div>
        <div class="q5">
        <label for="addr">Address</label>
        <input name="addr" required/>
        </div>

        <button type="submit">Add</button>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $user_id = $_POST['user_id'];
            // $post_uid = $_POST['post_uid'];
            $post_uid = uniqid('');
            $post_date = $_POST['post_date'];
            $photo_src = $_FILES['photo_src'];
            $tags = $_POST['tags'];
            $addr = $_POST['addr'];
            $imgExtension = pathinfo($photo_src['name'])['extension'];
            // print_r ($photo_src);
            $imgDest = "./img/$user_id/".str_replace(" ","_",$photo_src['name']);
            $fileName = "./img/$user_id";
            if(!file_exists($fileName)){
                mkdir($fileName, 755, true);
            }
            if($imgExtension == "jpg" && getimagesize($photo_src['tmp_name'])){

                if($photo_src['size']<10000000){
                    if(move_uploaded_file($photo_src['tmp_name'],$imgDest)){
                        $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
                        if($dbcon->connect_error){
                            echo "<h1>".$dbcon->connect_error."</h1>";
                        }else{
                            $insertCmd = "INSERT INTO post_tb (user_id,post_uid,post_date,photo_src,tags,addr) VALUES ('$user_id','$post_uid','$post_date','$imgDest','$tags','$addr')";
                            if($dbcon->query($insertCmd)===TRUE){
                                // header("Location: http://localhost/Project_me/postDisplay.php");
                                $_SESSION['flag'] = "Post was added";
                                header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/post");
                            }else{
                                echo "<h1>Post not registered</h1>".$dbcon->error;
                            }
                        }
                    }else{
                        echo "<h1>Can't upload the image</h1>";
                    }
                }
            }
            
            
        }
    ?>
</body>
</html>