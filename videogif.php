<?php

echo "hello_world";



$update = file_get_contents('php://input');
$update = json_decode($update, true);
$txt = json_encode($update);


//$chatId = "103987269";
$chatId = $update['message']['from']['id'];


sendMessage($chatId,$txt);

function sendMessage($chatId, $text)
{
    $BOT_TOKEN ="1723855279:AAGBT_x2M2mspFmbuCg-7_ae7wpri1g0yE8";

    $ch = curl_init();

    $conn = curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$BOT_TOKEN/sendMessage?chat_id=$chatId&text=$text");
    $conn = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    return $conn;
}

?>