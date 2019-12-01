<?php
session_start() ;
session_destroy() ?>

<html>
<head>
    <title>
        CaffeineIOT HomePage
    </title>

    <link rel="stylesheet" type="text/css" href=" ./css/HomePageStyle.css"
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
        button {
            font-size: large;
        }

        #logOutMessage{
            padding-top: 20%;
            padding-left: 10%;
        }
    </style>

</head>

<body>
<!----------------------------------Logout Button ----------------------------------->
<div class="jumbotron">
    <h1><font color="white">Caffeine IOT MarketPlace</font></h1>
</div>
<!----------------------------------End Logout Button ------------------------------->
<!---------------------------------Navigation Bar-------------------------------------->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="homeLandingPage.php">Home</a>
    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="aboutUs.php">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contactUs.php">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="customerCart.php">Cart</a>
        </li>
    </ul>
</nav>
<!---------------------------------End Navigation Bar-------------------------------------->

<div id="logOutMessage">
    <h1 align="center">Page coming Soon! </h1>
</div>
</body>
</html>