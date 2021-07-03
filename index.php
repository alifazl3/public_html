<?php

?>
<!DOCTYPE html>
<html lang="EN">
<head>
    <title>
        home
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="width=device-width, initial-scale=1" name="viewport">
<!--    <link href="style.css" rel="stylesheet">-->
    <style>
        @font-face {
            font-family: header;
            src: url("HelloPirates.otf");
        }

        @font-face {
            font-family: menu;
            src: url("Yomogi-Regular.ttf");
        }

        html {
            height: 100%;

        }

        body {
            height: 100%;
            background-color: #41729F;
            width: 100%;
            text-align: center;
            margin-top: 0;
            margin-left: 0;
        }

        a {
            text-decoration: none;
            color: indianred;
        }

        li {
            cursor: pointer;
        }

        .header {
            z-index: 10;
            position: fixed;
            color: #b59d1e;
            background-color: #274472;
            width: 100%;
            height: 30px;
            vertical-align: middle;
            padding-top: 10px;
            border-bottom: 5px solid #C3E0E5;
            font-family: header;
            font-size: 30px;

        }

        .left {
            padding-left: 10px;
            float: left;
        }

        .middle {
            font-size: 40px;
        }

        .right {
            padding-right: 10px;
            float: right;
        }

        .wrapper {
            display: block;
            color: #e3bd00;
            height: 90%;
            width: 100%;
            vertical-align: middle;
            padding-top: 50px;
        }

        .SideMenu {
            display: none;
            height: 100%;
            width: 0%;
            position: fixed;
            z-index: 5;
            background-color: #5885AF;
            text-align: left;
            border-right: 5px solid #C3E0E5;
        }

        .menuList {
            font-family: menu;
            list-style-type: none;
            font-size: 28px;
            padding: 15px;
        }

        .menuList li {
            margin: 0;
            color: #e3bd00;


        }

        .wrapper_tabs {
            height: 100%;
            float: right;
            width: 100%;
            color: white;
        }

        .main {

        }

        .card {
            display: inline-block;
            vertical-align: middle;
            width: 200px;
            height: 100px;
            background-color: #1b3866;
            color: yellow;
            border: 4px solid #e3bd00;
            outline: #1b3866 solid 5px;
            margin: 10px;
            font-family: menu;
            font-size: 30px;
            border-radius: 2px;
            box-shadow: 0px 0px 4px 5px #54acff;

        }

        .contact {
            display: none;
        }

        .big_card {
            font-size: 20px;
            font-family: menu;
            line-height: 40px;
            margin-top: 1%;
            width: 48%;
            background-color: #1c1c1c;
            display: inline-block;
            text-align: left;
            padding: 10px;
        }

        .modal {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            display: none;
        }

        .logInModal {
            margin-top: 5%;
            border-radius: 50px;
            background-color: #a0a0a0;
            width: 30%;
            height: 40%;
            display: inline-block;
        }

        .close {
            color: red;
            text-align: right;
            font-size: 30px;
            padding-top: 4%;
        }

        .closeLogo {
            margin-right: 10%;
        }

        .loginInput {
            display: block;
            width: 50%;
            margin: 20px auto;
            height: 30px;
            background-color: #3b566e;
            border: 2px solid white;
            color: white;
            text-align: center;
            border-radius: 5px;

        }

        .submit {
            width: 15%;
            height: 30px;
        }

        .usernameInput {
            margin-top: 7%;
        }

        @media only screen and (max-width: 900px) {
            .logInModal {
                width: 70%;
            }

            .big_card {
                font-size: 15px;
                width: 100%;
            }

        }

        @media only screen and (max-width: 750px) {
            li {
                font-size: 25px;
            }

            ul {
                margin: 10px 0;
            }

        }

        @media only screen and (max-width: 700px) {
            li {
                font-size: 20px;
            }


        }

        @media only screen and (max-width: 600px) {
            .SideMenu {
                margin-top: -30px;
            }

            .header {
                height: 50px;
            }


            .wrapper {
                padding-top: 75px;
            }

            .logInModal {
                width: 100%;
            }

            li {
                font-size: 17px;
            }
        }

        @media only screen and (max-width: 500px) {
            .SideMenu {
                margin-top: -30px;
            }

            .menuList {
                font-size: 15px;
                padding: 5px 10px;
            }

            .menuList li {
                margin: 10px 0;


            }

            li {
                font-size: 13px;
            }


        }

        @media only screen and (max-width: 405px) {
            li {
                font-size: 10px;
            }

        }

        @media only screen and (max-width: 200px) {
            .SideMenu {
                font-size: 15px;
            }


        }

    </style>
    <script src="functions.js"></script>

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

        <div class="card"><a href="#/calculator/index.html"><p> calculator </p></a></div>

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
