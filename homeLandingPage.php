<?php
//Author: Ajith V Keerikkattil
//updated: 10/29/2019

include 'dbConnection.php';

?>
<html>
    <head>
        <title>
            CaffeineIOT HomePage
        </title>

        <link rel="stylesheet" type="text/css" href=" ./css/HomePageStyle.css"
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    </head>
    <body>
    <!----------------------------------Login & Registration Button ----------------------------------->
    <div id="header">
        <div id="buttonDiv">
            <button type="button" id="registerButton">Register</button> &nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" id="LoginButton">Login</button>
        </div>
    </div>
    <!----------------------------------End Login & Registration Button ------------------------------->

    <!-----------------AJAX Live Search -------------------->
    <div id="search">
        <input type="text" id="searchBox" size="35"  placeholder="Enter product name here..." onkeypress="showResults(this.value)">
    </div>

    <h1>Our top products: </h1>

    <div id="searchResults"></div>
    <script>
        function showResults(str) {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("searchResults").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "getProducts.php?q=" + str, true);
            xhttp.send();
        }
    </script>
    <!-----------------End AJAX Live Search ----------------->

    <!-------------------------------------------------------------- Registration Modal ----------------------------------------------------------------------------------->
    <div id="registrationModal" class="modal">
        <div class="modal-content">

            <span id="closeButton">&times;</span>

            <h2 id="registrationTitle">New User Registration</h2>

            <!--Registration Form -->
             <form id ="registration">

                First Name: <input type="text" name="firstName">
                Last Name: <input type="text" name="LastName">
                Street: <input type="text" name="Street">
                County: <input type="text" name="County">
                State:<br>
                <select name="State" size="1">
                    <option>AK</option>
                    <option>AL</option>
                    <option>AR</option>
                    <option>AZ</option>
                    <option selected>DE</option>
                    <option>FL</option>
                    <option>GA</option>
                    <option>HI</option>
                    <option>IA</option>
                    <option>IL</option>
                    <option>KS</option>
                    <option>KY</option>
                    <option>LA</option>
                    <option>ME</option>
                    <option>MI</option>
                    <option>MO</option>
                    <option>MS</option>
                    <option>MT</option>
                    <option>NC</option>
                    <option>ND</option>
                    <option>NE</option>
                    <option>NH</option>
                    <option>NJ</option>
                    <option>NM</option>
                    <option>NV</option>
                    <option>OH</option>
                    <option>OK</option>
                    <option>OR</option>
                    <option>PA</option>
                    <option>SC</option>
                    <option>SD</option>
                    <option>TN</option>
                    <option>TX</option>
                    <option>UT</option>
                    <option>VA</option>
                    <option>WI</option>
                    <option>WV</option>
                    <option>WY</option>
                </select><br>

                Zip: <input type="text" name="Zip">

                Email: <input type="text" size="40" class="emailBox" name="email">

                <input id="submit" type="submit" name="submit" /> &nbsp;
            </form>

            <!--Javascript to open the registration modal -->
             <script>
                var modal = document.getElementById("registrationModal");
                var registrationBtn = document.getElementById("registerButton"); //modal open button
                var registrationModalCloseBtn = document.getElementById("closeButton");

                registrationBtn.addEventListener('click', openRegistrationModal);

                function openRegistrationModal()
                    {
                     modal.style.display = 'block';
                    }

                registrationModalCloseBtn.addEventListener('click', closeRegistrationModal);

                function closeRegistrationModal()
                    {
                    modal.style.display = 'none';
                    }
            </script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script>
                //submit the registration form ang get response
                $("#registration").submit(function(event)
                {
                    event.preventDefault();
                    var post_url = "registration.php";
                    var form_data = $(this).serialize(); //Encode form elements for submission
                    $.post( post_url, form_data, function(response)
                    {
                        //if response says "Registration successful", open the activation.html
                        if(response.match("Registration successful"))
                        {
                            window.location.href = "../activate.html"
                        }
                        else
                        {
                            alert(response);  //display the error from the database
                        }
                    });
                });
            </script>
        </div>
    </div>

    <!-------------------------------------------------------------- End Registration Modal -------------------------------------------------------------------------------->

</body>
</html>
