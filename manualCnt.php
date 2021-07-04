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
if (isset($_POST['chatId'])){
    sendMessage($_POST['chatId'],$_POST['text']);
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