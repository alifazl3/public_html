<?php

if (isset($_GET['tag'])){


    $servername = "localhost";
    $username = "alifazl";
    $password = "password";
    $dbname = "evig";
    $tb_name = "videoTags";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO ".$tb_name." (tag,videoId) VALUES ('".$_GET['tag']."','".$_GET['videoId']."')";
    var_dump($sql);


}


?>
<html>
<head>
    <title>
        insert
    </title>
</head>
<body>
<form method="get" target="#">
    <input type="text" name="tag" placeholder="tag">
    <input type="text" name="videoId" placeholder="videoId">
    <input type="submit">
</form>
</body>
</html>
