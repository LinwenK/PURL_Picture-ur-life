<?php 
    include './config.php'; 
    $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
    if($dbcon->connect_error) {
        die("Connection failed");
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
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <input name="user_id" required/>
        <input name="post_uid" required />
        <input name="post_date" type="date" required/>
        <input name="photo_src" type="file" required/>
        <input name="tags" required/>
        <input name="addr" required/>
        <button type="submit">Add</button>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $user_id = $_POST['user_id'];
            $post_uid = $_POST['post_uid'];
            $post_date = $_POST['post_date'];
            $photo_src = $_FILES['photo_src'];
            $tags = $_POST['tags'];
            $addr = $_POST['addr'];
            $imgExtension = pathinfo($photo_src['name'])['extension'];
            print_r ($photo_src);
            $imgDest = "./img/$user_id/".str_replace(" ","_",$photo_src['name']);
            $fileName = "./img/$user_id";
            if(file_exists($fileName)){
                mkdir($fileName,0777);
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
                                header("Location: http://localhost/php/FINAL_PROJECT/userDisplay.php");
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