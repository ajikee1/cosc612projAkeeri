<?php
include 'dbConnection.php';

?>
<html>

    <head>
        <title>
            CaffeineIOT HomePage
        </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    </head>
    <body>
        <!-- Login & Registration Button -->
        <button type="button" id="registerButton">Register</button>
        <button type="button" id="LoginButton">Login</button>

        <!-- Search box -->
        <input type="text" id="searchBox" placeholder="Enter product name here..." onkeypress="showResults(this.value)">

        <h1>Our top products: </h1>

        <div id="searchResults"> </div>

        <script>
            function showResults(str)
            {
                var xhttp = new XMLHttpRequest();

                xhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                        document.getElementById("searchResults").innerHTML = xhttp.responseText;
                    }
                }
                xhttp.open("GET", "getProducts.php?q="+ str , true)
                xhttp.send();
            }
        </script>

</body>

</html>
