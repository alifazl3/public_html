<?php
if (isset($_POST['user'])){
    var_dump($_POST);
    exit;
}
?>
<!DOCTYPE html>
<html lang="EN">
<head>
    <title>
        home
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="styles/style.css" rel="stylesheet">

    <script src="js/functions.js"></script>

</head>
<body>

<div class="header">
    <span class="left" id="mySidenavToggleBtn" onclick="toggleSideMenu()"> menu</span>
    <span class="middle"><strong>welcome</strong></span>
    <span class="right" onclick="openModal('logIN')">Log in</span>
</div>
<div class="wrapper">
    <div class="SideMenu" id="mySidenav">
        <ul class="menuList">
            <li onclick="changeTab('main')">&#9776; home</li>
            <li>&#9776; tools</li>
            <li>&#9776; games</li>
            <li>&#9776; diary</li>
            <li>&#9776; idk</li>
            <li onclick="changeTab('contactMe')">&#9776; contact me</li>
        </ul>
    </div>
    <div class="main wrapper_tabs" id="main">

        <div class="card"><a href="calculator.html"><p> calculator </p></a></div>

    </div>
    <div class="contact wrapper_tabs" id="contactMe">
        <div class="big_card">
            <p>
                Hi, I'm Ali and welcome to this personal site
                <br>
                I'll be happy if you share your opinion with me
                <br>
                <b>email:</b>
                <br>
                <strong>fazlolahiali@gmail.com</strong>
                <br>
                <strong>telegram?</strong>
                <br>
                @alifazl3 or <a href="https://t.me/alifazl3">Click on me</a>
                <br>
                donation?
                <br>
                sure, why not? ( coming soon )
                <br>
                <br>
                <br>
            <center>
                thank you :)
            </center>
            </p>
        </div>
    </div>

</div>

<div class="modal" id="modals">
    <div class="logInModal" id="logIN">
        <div class="close">
            <span class="closeLogo" onclick="closeModal('logIN')">
                &times;
            </span>
        </div>
        <div class="form">
            <form method="post" type="#">
                <input class="loginInput usernameInput" name="user" placeholder="user name" type="text">
                <input class="loginInput" name="password" placeholder="password" type="password">
                <input class="loginInput submit" name="submit" type="submit" value="login">
            </form>
        </div>

    </div>

</div>
</body>
</html>
