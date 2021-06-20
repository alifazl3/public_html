<?php


function get()
{
    $openFile = fopen("gc.txt", "r");
    $txt = fread($openFile, filesize("gc.txt"));
    fclose($openFile);
    return json_decode($txt);
}

function put($txt)
{
    $openFile = fopen("gc.txt", "w");
    fwrite($openFile, $txt);
    fclose($openFile);
}


function add($price, $whom)
{
    $current_gc = get();
    $current_gc[$whom]+=$price;
    put(json_encode($current_gc));

}


function sub($price, $whom)
{
    $current_gc = get();
    $current_gc[$whom]=$current_gc[$whom]-$price;
    put(json_encode($current_gc));
}


function transfer($price, $who, $whom)
{

    $current_gc = get();
    $current_gc[$who]=$current_gc[$who]-$price;
    $current_gc[$whom]=$current_gc[$whom]+$price;
    put(json_encode($current_gc));

}


$current_gc = get();



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
    $text = "GetCurrentSt : get current gc \n add: add price who\n sub: sub price who \n transfer: tra price who whom";

}
if (substr($update['message']['text'],0,3) == "add") {

    $param = explode(' ',$update['message']['text']);

    add($param[1],$param[2]);
    $text = "add verify".json_encode($param);
}
if (substr($update['message']['text'],0,3) == "sub") {
    $param = explode(' ',$update['message']['text']);
    sub($param[1],$param[2]);


    $text = "sub verify".json_encode($param);
}
if (substr($update['message']['text'],0,3) == "tra") {
    $param = explode(' ',$update['message']['text']);
    transfer($param[1],$param[2],$param[3]);

    $text = "tra verify".json_encode($param);
}






put(json_encode($current_gc));

//sendMessage($update['message']['from']['id'], $update['message']['text']);
sendMessage($update['message']['from']['id'], $text);
//sendMessage($my_chatId, "salam from server");
?>