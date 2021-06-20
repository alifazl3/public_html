<?php


function get()
{
    $openFile = fopen("gc.txt", "r");
    $txt = fread($openFile, filesize("gc.txt"));
    fclose($openFile);
    return json_decode($txt);
}

function add($price, $whom)
{
    $openFile = fopen("gc.txt", "r");
    $current_gc = fread($openFile, filesize("gc.txt"));
    fclose($openFile);
    $current_gc[$whom] += $price;
    $openFile = fopen("gc.txt", "w");
    fwrite($openFile, json_encode($current_gc));
    fclose($openFile);


}


function sub($price, $whom)
{

    $openFile = fopen("gc.txt", "r");
    $current_gc = fread($openFile, filesize("gc.txt"));
    fclose($openFile);
    $current_gc[$whom] = $current_gc[$whom] - $price;
    $openFile = fopen("gc.txt", "w");
    fwrite($openFile, json_encode($current_gc));
    fclose($openFile);

}


function transfer($price, $who, $whom)
{
    $openFile = fopen("gc.txt", "r");
    $current_gc = fread($openFile, filesize("gc.txt"));
    fclose($openFile);
    $current_gc[$who] = $current_gc[$who] - $price;
    $current_gc[$whom] = $current_gc[$whom] + $price;
    $openFile = fopen("gc.txt", "w");
    fwrite($openFile, json_encode($current_gc));
    fclose($openFile);


}


function sendMessage($chatId, $text)
{
    $BOT_TOKEN = "1702194647:AAF1PIcfpjs4CTbqcHYRq6R32mKqpdNmRZ0";

    $ch = curl_init();

    $conn = curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$BOT_TOKEN/sendMessage?chat_id=$chatId&text=$text");
    $conn = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    return $conn;
}


$BOT_TOKEN = "1702194647:AAF1PIcfpjs4CTbqcHYRq6R32mKqpdNmRZ0";
$my_chatId = "103987269";


$update = file_get_contents('php://input');
$update = json_decode($update, true);


$text = json_encode($update);


if ($update['message']['text'] == "GetCurrentSt") {
    $text = get();

}
if ($update['message']['text'] == "help") {
    $text = "GetCurrentSt : get current gc   add: add price who  sub: sub price who transfer: tra price who whom";
}
if (substr($update['message']['text'], 0, 3) == "add") {
    $param = explode(' ', $update['message']['text']);
    add($param[1], $param[2]);
    $text = "add verify" . json_encode($param);
}
if (substr($update['message']['text'], 0, 3) == "sub") {
    $param = explode(' ', $update['message']['text']);
    sub($param[1], $param[2]);
    $text = "sub verify" . json_encode($param);
}
if (substr($update['message']['text'], 0, 3) == "tra") {
    $param = explode(' ', $update['message']['text']);
    transfer($param[1], $param[2], $param[3]);
    $text = "tra verify" . json_encode($param);

}


//sendMessage($update['message']['from']['id'], $update['message']['text']);
sendMessage($update['message']['from']['id'], $text);
//sendMessage($my_chatId, "salam from server");
?>