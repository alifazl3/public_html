<?php

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

    $inlineAnswer = curlPost(array($update['inline_query']['id'], json_encode($result)));

//    $inlineAnswer = inlineMode($update['inline_query']['id'], json_encode($result));
    $txt = $txt . $inlineAnswer . "%0A%0A%0A" . json_encode($result);
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


function curlPost($data = NULL, $headers = []) {

    $BOT_TOKEN = "1723855279:AAGBT_x2M2mspFmbuCg-7_ae7wpri1g0yE8";
    $url = "https://api.telegram.org/bot$BOT_TOKEN/InlineQuery";


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); //timeout in seconds
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_ENCODING, 'identity');


    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    $response = curl_exec($ch);
    if (curl_error($ch)) {
        trigger_error('Curl Error:' . curl_error($ch));
    }

    curl_close($ch);
    return $response;
}


?>