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
                <th>Post Date</th>
                <th>Photo Data</th>
                <th>Tags</th>
                <th>Address</th>
            </tr>
        </thead>
    <?php
        function loadData($postData){
            foreach($postData as $idx=>$post){
                echo "<tr><td>$post->user_id</td><td>$post->post_uid</td><td>$post->post_date</td><td>$post->photo_src</td><td>$post->tags</td><td>$post->addr</td></tr>";
            }
            echo "</table>";
        }
        $filehandler = fopen('./files/DB-post.json','r');
        $data = fread($filehandler,filesize('./files/DB-post.json'));
        fclose($filehandler);
        $postData = json_decode($data);
        if($_SERVER['REQUEST_METHOD']=="GET"){
            loadData($postData);
        }
    ?>
    </table>
</body>
</html>