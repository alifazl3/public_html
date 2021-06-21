<?php


$servername = "localhost";
$username = "alifazl";
$password = "password";
$dbname = "evig";

if (isset($_GET['json'])) {
    put(json_decode($_GET['json']));
    var_dump(json_decode($_GET['json']));
    exit;
//    header("Location: index.php");
}

//if (isset($_POST['user'])) {
//    var_dump($_POST);
//}


function get()
{

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

    return $export;

}


function put($inputData)
{

    $servername = "localhost";
    $username = "alifazl";
    $password = "password";
    $dbname = "evig";

    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    foreach ($inputData as $user) {
        $sql = "UPDATE gc SET coin=" . $user['coin'] . " WHERE name=" . $user['name'];
//        UPDATE gc SET coin="."$user['coin']." WHERE id=

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
    }


//
}


//function add($price, $whom)
//{
//    $current_gc = get();
//    $current_gc[$whom]+=$price;
//    put(json_encode($current_gc));
//
//}
//
//
//function sub($price, $whom)
//{
//    $current_gc = get();
//    $current_gc[$whom]=$current_gc[$whom]-$price;
//    put(json_encode($current_gc));
//}
//
//
//function transfer($price, $who, $whom)
//{
//
//    $current_gc = get();
//    $current_gc[$who]=$current_gc[$who]-$price;
//    $current_gc[$whom]=$current_gc[$whom]+$price;
//    put(json_encode($current_gc));
//
//}
//
//

//
//
//$persons = array(
//    "shamc",
//    "ehsan",
//    "amir",
//    "nima",
//    "emad",
//    "mehran",
//    "hayan",
//    "razaz",
//    "alis",
//    "tarighat",
//    "hesan",
//    "hamed",
//    "hasan"
//);
$current_gc = get();


//var_dump($current_gc);
//echo count($persons);


?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="top">
    <div class="change_btn">
        <form target="#" method="get">
            <input type="text" value="" name="json" id="forminput" style="display: none;width: 0px;height: 0px">
            <input type="submit" value="confirm change" onclick="change()" class="submit">
        </form>
    </div>

    <div>

        <button class="login_btn" id="myBtn">log in</button>

        <div class="form modal-content" id="myModal">
            <span class="close">&times;</span>
            <form target="index" method="post">
                <input class="loginInput" name='user' type="text" placeholder="username">
                <input class="loginInput" name="pass" type="password" placeholder="pass">
                <input class="loginInput" type="submit" value="verify">
            </form>
        </div>
    </div>


</div>
<div>
    <table id="myTable">
        <th onclick="sortTable(0)">Name</th>
        <th onclick="sortTable(1)">gc</th>

        <?php
        foreach ($current_gc as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['name'] . "</td>";
            echo "<td contenteditable>" . $user['coin'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>


<script>
    sortTable();

    function sortTable() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("myTable");
        switching = true;
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;

            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[1];
                y = rows[i + 1].getElementsByTagName("TD")[1];

                if (x.innerText < 0) {
                    rows[i].getElementsByTagName("TD")[1].className = 'badsit';
                    rows[i].getElementsByTagName("TD")[0].className = 'badsit';
                }
                if (y.innerText < 0) {
                    rows[i + 1].getElementsByTagName("TD")[1].className = 'badsit';
                    rows[i + 1].getElementsByTagName("TD")[0].className = 'badsit';
                }

                //check if the two rows should switch place:
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    function change() {


        var data = {};
        var table = document.getElementById("myTable");
        for (var i = table.rows.length - 1; i > 0; i--) {
            var key = table.rows[i].childNodes[1].innerText;
            var value = table.rows[i].childNodes[2].innerText;
            data[key] = value;
        }
        console.log(data);
        console.log(JSON.stringify(data));
        document.getElementById("forminput").value = JSON.stringify(data);
        return JSON.stringify(data);
    }

    var modal = document.getElementById("myModal");

    var btn = document.getElementById("myBtn");

    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function () {
        modal.style.display = "block";
    }
    span.onclick = function () {
        modal.style.display = "none";
    }
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>

</body>
</html>


<?php

//put($current_gc);


?>
