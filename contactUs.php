<?php

?>

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
        button, #message {
            font-size: large;
            font-family: Bungee;
        }

        .contactForm {
            padding-left: 20%;
            padding-top: 10%;
        }

        label {
            border-color: black;
            border-radius: 5px;
            font-size: large;
            font-family: 'Bungee';
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
    <a class="navbar-brand" href="homeLandingPagePost.php">Home</a>
    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="aboutUs.php">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="customerCart.php">Cart</a>
        </li>
    </ul>
</nav>
<!---------------------------------End Navigation Bar-------------------------------------->

<!-- Display the message send status based on the server response -->
<div class="return" id="messageStatus"></div>

<div class="contactForm">
    <form id="contact">
        <label for="receiverEmail">Your email address: </label>
        <input type="text" size="60" class="emailBox" name="receiverEmail" style="border:3px solid #000000;">

        <br/><br/>
        <textarea id="message" maxlength="300" rows="5" cols="80" style="border:3px solid #000000;">Enter your message for us here!</textarea>
        <br/>
        <br/>
        <button type="submit" name="submit" class="sendButton" value="contact">SEND MESSAGE</button>
    </form>

    <!-- JavaScript to display the server response without having to reload the page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
    <script>
        $("#contact").submit(function (event) {
            event.preventDefault(); //prevent default action
            var post_url = "sendMessage.php"; //get form action url
            var form_data = $(this).serialize(); //Encode form elements for submission

            $.post(post_url, form_data, function (response, status) {
                $("#messageStatus").html(response);
            }).fail(function (err, status) {
                $("#messageStatus").html(err);
            });
        });
    </script>
</div>
</body>
</html>

