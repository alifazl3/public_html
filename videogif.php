<?php

if (isset($_GET['insert'])) {


    if (isset($_GET['tag'])) {


        $servername = "localhost";
        $username = "alifazl";
        $password = "password";
        $dbname = "evig";
        $tb_name = "videoTags";


        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO " . $tb_name . " (tag,videoId) VALUES ('" . $_GET['tag'] . "','" . $_GET['videoId'] . "')";
        var_dump($sql);


        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

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
    <?php


}
if (isset($_GET['manualCtn'])) {
    function sendMessage($chatId, $text)
    {
        $BOT_TOKEN = "1702194647:AAF1PIcfpjs4CTbqcHYRq6R32mKqpdNmRZ0";

        $ch = curl_init();

        $conn = curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$BOT_TOKEN/sendMessage?chat_id=$chatId&text=$text");
        $conn = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        return $conn;
    }

    if (isset($_POST['chatId'])) {
        sendMessage($_POST['chatId'], $_POST['text']);
    }

    ?>
    <html>

    <head>


    </head>
    <body>

    <form method="post" target="#">
        <input type="text" value="" placeholder="token" name="token">
        <br>
        <br>
        <input type="text" placeholder="chatId" name="chatId">
        <input type="text" placeholder="text" name="text">
        <input type="submit" value="send">
    </form>
    </body>

    </html>
    <?php
}

echo "hello_world";


$update = file_get_contents('php://input');
$update = json_decode($update, true);
$txt = json_encode($update);


$chatId = $update['message']['from']['id'];


if (isset($update['inline_query'])) {

    $chatId = "103987269";
    $txt = $txt . "%0A";
//    $result = array("type" => "video", "id" => "-1001165348767", "video_file_id" => "AAMCBAADGQEAAxdg2EeOPd-vpak_GwKjuKugBy1geQACWggAAnC6QVBewCw0brMbLAEAB20AAyAE", "title" => "Videogifs");
//    $result = array('type'=> 'article', 'message_text'=> "salam", 'id'=> '1', 'title'=> 'count');

    $result = array('type' => 'article', "id" => "1", "input_message_content" => array("message_text" => "Hello"));

    $BOT_TOKEN = "1723855279:AAGBT_x2M2mspFmbuCg-7_ae7wpri1g0yE8";

    $url = "https://api.telegram.org/bot$BOT_TOKEN/InlineQuery";


//    $inlineAnswer = inlineMode($update['inline_query']['id'], json_encode($result));


    $inlineAnswer = do_post($url, $result);
    $txt = $txt . "%0A%0A%0A" . "resalt:" . $inlineAnswer . "%0A%0A%0A" . json_encode($result);
}

sendMessage($chatId, $txt);

function sendMessage($chatId, $text)
{
    $BOT_TOKEN = "1723855279:AAGBT_x2M2mspFmbuCg-7_ae7wpri1g0yE8";

    $ch = curl_init();

    $conn = curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$BOT_TOKEN/sendMessage?chat_id=$chatId&text=$text");
    $conn = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    return $conn;
}

function inlineMode($inline_query_id, $results)
{
    $BOT_TOKEN = "1723855279:AAGBT_x2M2mspFmbuCg-7_ae7wpri1g0yE8";

    $ch = curl_init();

    $conn = curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$BOT_TOKEN/InlineQuery?inline_query_id=$inline_query_id&results=$results");
    $conn = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    return $conn . $output;
}


function do_post($url, $params)
{
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => $params
        )
    );
    $result = file_get_contents($url, false, stream_context_create($options));
    return $result;
}


?>