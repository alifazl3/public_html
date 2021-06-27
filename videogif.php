<?php

echo "hello_world";


$update = file_get_contents('php://input');
$update = json_decode($update, true);
$txt = json_encode($update);


$chatId = $update['message']['from']['id'];


if (isset($update['inline_query'])) {

    $chatId = "103987269";
    $txt = $txt . "%0A" . "it is inline req";
    $result = array("type" => "video", "id" => "", "video_file_id" => "AQADWggAAnC6QVBy", "title" => "TEST");
    $inline = inlineMode($update['inline_query']['id'], json_encode($result));
    $txt = $txt . $inline;
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

    $conn = curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$BOT_TOKEN/answerInlineQuery?inline_query_id=$inline_query_id&results=$results");
    $conn = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    return $conn;
}

?>