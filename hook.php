<?php


function get()
{

    $servername = "localhost";
    $username = "alifazl";
    $password = "password";
    $dbname = "evig";
    $export = array();

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM gc";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($export, $row);
        }
    } else {
        echo "0 results";
    }


    $conn->close();

    return $export;

}


function put($inputData)
{

    $servername = "localhost";
    $username = "alifazl";
    $password = "password";
    $dbname = "evig";
    $exit = "start: ";
    $num = 0;
    foreach ($inputData as $user => $coins) {

        $exit = $exit . "%0A%0A" . $num ."-". $user . " => " .$coins . "%0A";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $sql = "UPDATE gc SET coin=" . $coins . " WHERE name= '" . $user . "'";


//        $exit = $exit . $conn ."%0A".$sql;

        if ($conn->query($sql) === TRUE) {
        } else {
//            $exit = $exit . "Error updating record: " . $conn->error;
        }

        $conn->close();

//        $exit = $exit . "%0A%0A%0A" . "----------" . "%0A%0A%0A";
//        $num +=1;
    }

    return json_encode($inputData).$inputData . "%0A%0A" . $exit;
//    return json_encode($inputData) . "%0A%0A" ;

}


function transfer($price, $who, $whom)
{
    $current_gc = get();
//    $test = json_encode($current_gc);


    for ($i = 0; $i < count($current_gc); $i++) {

        if ($current_gc[$i]['name'] == $who) {
            $test = 'who: ' . json_encode($current_gc[$i]);
            $current_gc[$i]['coin'] = $current_gc[$i]['coin'] - $price;
            break;
        }

    }
    for ($i = 0; $i < count($current_gc); $i++) {
        if ($current_gc[$i]['name'] == $whom) {
//            $test = 'whom: ' . json_encode($current_gc[$i]);
            $current_gc[$i]['coin'] = $current_gc[$i]['coin'] + $price;
            break;
        }
    }


    put($current_gc);
    return json_encode($current_gc);
}


function sendMessage($chatId, $text)
{
    $BOT_TOKEN = "1702194647:AAEAkt7LFD-9OCikmb1kNtgL67gIm7c-FnE";

    $ch = curl_init();

    $conn = curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$BOT_TOKEN/sendMessage?chat_id=$chatId&text=$text");
    $conn = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    return $conn;
}


$update = file_get_contents('php://input');
$update = json_decode($update, true);
$text = json_encode($update);


if ($update['message']['text'] == "GetCurrentSt") {

    $text = json_encode(get());

}


if (substr($update['message']['text'], 0, 6) == "update") {
    $param = explode(' ', $update['message']['text']);



    $text = json_encode($param).put(json_decode($param[1]));


}


//if ($update['message']['text'] == "help") {
//    $text = "GetCurrentSt : get current gc   add: add price who  sub: sub price who transfer: tra price who whom";
//}
//if (substr($update['message']['text'], 0, 3) == "add") {
//    $param = explode(' ', $update['message']['text']);
//
//    $openFile = fopen("gc.txt", "r");
//    $current_gc = fread($openFile, filesize("gc.txt"));
//    fclose($openFile);
//    $current_gc[$param[2]] += $param[1];
//    $openFile = fopen("gc.txt", "w");
//    fwrite($openFile, json_encode($current_gc));
//    fclose($openFile);
//
//    $text = "add verify" . json_encode($param);
//}
//if (substr($update['message']['text'], 0, 3) == "sub") {
//    $param = explode(' ', $update['message']['text']);
//    sub($param[1], $param[2]);
//    $text = "sub verify" . json_encode($param);
//}
//if (substr($update['message']['text'], 0, 3) == "tra") {
//    $param = explode(' ', $update['message']['text']);
//    $current_gc = get();
//
//
//    $text = "json: current_gc ".json_encode($current_gc)."\n\n"."param: ".json_encode($param);
//
//
//
////    $text = $param[1] . $param[2] . $param[3] . transfer($param[1], $param[2], $param[3]);
////    transfer($param[1],$param[2],$param[3]);
//}


sendMessage($update['message']['from']['id'], $text);
?>