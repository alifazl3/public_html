<?php


$servername = "localhost";
$username = "alifazl";
$password = "password";
$dbname = "evig";
$export = array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM gc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
//	var_dump($row);
//	echo "<br>";

        array_push($export, $row);
    }
} else {
    echo "0 results";
}


$conn->close();



echo "<br>";
echo "<br>";
echo "<br>";

echo "<pre>";
var_dump($export);
echo "</pre>";


?>