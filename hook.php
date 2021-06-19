<?php


$BOT_TOKEN = "1702194647:AAF1PIcfpjs4CTbqcHYRq6R32mKqpdNmRZ0";


$parameters = array(
    "chat_id" => "103987269",
    "text" => "test",
);
send("sendMessage", $parameters);


function send($method, $data)
{

    $url = "https://api.telegram.org/bot1702194647:AAF1PIcfpjs4CTbqcHYRq6R32mKqpdNmRZ0/$method";

    if (!$curld = curl_init()) {
        exit;
    }
    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curld);
    curl_close($curld);
    return $output;
}

?>