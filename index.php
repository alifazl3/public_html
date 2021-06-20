<?php
//echo "hello world";

if (isset($_GET['json'])) {
    put(urldecode($_GET['json']));
    header("Location: index.php");
}

if (isset($_POST['user'])) {
    var_dump($_POST);
}


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





$persons = array(
    "shamc",
    "ehsan",
    "amir",
    "nima",
    "emad",
    "mehran",
    "hayan",
    "razaz",
    "alis",
    "tarighat",
    "hesan",
    "hamed",
    "hasan"
);
$current_gc = get();


//var_dump($current_gc);
//echo count($persons);


?>

    <html>
    <head>

        <style>
            .close {
                color: #aaaaaa;
                font-size: 28px;
                font-weight: bold;
                display: block;

            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }


            .loginInput {
                display: inline-block;
                padding: 2px;
                margin: 15px auto;
            }

            table {
                margin: 50px 0 0 50px;
            }

            table, td, th {
                padding: 5px;
                border: 1px solid black;
                text-align: center;
                vertical-align: middle;
            }

            table {
                border-collapse: collapse;
                width: 250px;
            }

            th {
                height: 70px;
            }

            .badsit {
                color: white;
                background-color: red;
            }

            .submit {
                background-color: rgba(255, 191, 16, 0.81);
                border: none;
                padding: 5px;
                border-radius: 5px;

                margin-top: 20px;
                margin-left: 45px;

            }

            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0, 0, 0); /* Fallback color */
                background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            }

            .login_btn {
                background-color: rgba(255, 191, 16, 0.81);
                border: none;


                padding: 5px;
                border-radius: 5px;

                margin-top: 20px;
                margin-left: 45px;

            }

            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                display: none;
                border: 1px solid #888;
                position: fixed;
                width: 100%;
            }

            .top {
                border: 1px solid red;
                width: 100%;
                height: 50px;
            }
        </style>
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
            foreach ($current_gc as $name => $worth) {
                echo "<tr>";
                echo "<td>" . $name . "</td>";
                echo "<td contenteditable>" . $worth . "</td>";
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
                var key = table.rows[i].childNodes[0].innerText;
                var value = table.rows[i].childNodes[1].innerText;
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

put(json_encode($current_gc));



?>