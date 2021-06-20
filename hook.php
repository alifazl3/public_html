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

function transfer($price, $who, $whom)
{



    $current_gc = get();
    $current_gc[$who] = $current_gc[$who] - $price;
    $current_gc[$whom] = $current_gc[$whom] + $price;
    put(json_encode($current_gc));

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




if (substr($update['message']['text'], 0, 3) == "tra") {
    $param = explode(' ', $update['message']['text']);
    $text = "tra verified   ||  ".json_encode($param);



    transfer($param[1],$param[2],$param[3]);
}


//sendMessage($update['message']['from']['id'], $update['message']['text']);
sendMessage($update['message']['from']['id'], $text);
//sendMessage($my_chatId, "salam from server");
?>