<?php



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
$userChatId = $update["message"]["from"]["id"]?$update["message"]["from"]["id"]:null;

$userMessage = $update["message"]["text"]?$update["message"]["text"]:"Nothing";
$firstName = $update["message"]["from"]["first_name"]?$update["message"]["from"]["first_name"]:"N/A";
$lastName = $update["message"]["from"]["last_name"]?$update["message"]["from"]["last_name"]:"N/A";
$fullName = $firstName." ".$lastName;
$replyMsg = "Hello ".$fullName."\nYou said: ".$userMessage;




$text = json_encode($update);




sendMessage($my_chatId, $update[]);
sendMessage($my_chatId, $text);
//sendMessage($my_chatId, "salam from server");
?>