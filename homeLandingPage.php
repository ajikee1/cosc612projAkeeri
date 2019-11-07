<?php
//Author: Ajith V Keerikkattil
//updated: 11/07/2019

include 'dbConnection.php';

function getTopProducts($servername, $username, $password, $db)
{
    $dbConnection = mysqli_connect($servername, $username, $password, $db);

    $query = "SELECT * FROM products";

    $result = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($result) >= 0) {
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="productItem">
                <div class="productDesc" style="background-color: #aaaaaa">
                    <table>
                        <tr>
                            <td><a href=" productDetails.php?productName=<?php echo $row['productName'] ?>"><img
                                            src="<?php echo 'images/' . $row['productImage']; ?>" width="200px" height="100px"></td>
                            <td>&nbsp;&nbsp; <?php echo $row['productName']; ?> &nbsp;&nbsp;</td>
                            <td><?php echo "$ " .$row['productPrice']; ?> </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
        }
    }
}

?>
<html>
    <head>
            <title>
                CaffeineIOT HomePage
            </title>

            <link rel="stylesheet" type="text/css" href=" ./css/HomePageStyle.css"
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>

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
    <h1 align="center">Our top products: </h1>
    <div id="search">
        <input type="text" id="searchBox" size="50"  placeholder="Enter product name here..." onkeypress="showResults(this.value)">
    </div>

    <div id="allResults">
        <?php  getTopProducts($servername, $username, $password, $db);?>
    </div>


    <div id="searchResults"></div>
    <script>
        function showResults(str) {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var hideAllResults = document.getElementById("allResults");
                    hideAllResults.style.display = "none";
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

            <h3 id="registrationTitle" align="center">New User Registration</h3>

            <!--Registration Form -->
             <form id ="registration">
                 First Name:  <input type="text" name="firstName" size="20"> <br>
                 <br>
                Last Name:  <input type="text" name="LastName" size="20"> <br>
                 <br>
                Street:  <input type="text" name="Street" size="30"> <br>
                 <br>
                County:  <input type="text" name="County" size="30"> <br>
                 <br>
                State:
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
                </select> <br> <br>

                Zip: <input type="text" name="Zip"> <br>
                <br>
                Email: <input type="text" size="40" class="emailBox" name="email"> <br>
                <br>
                <input id="registrationSubmit" type="submit" name="submit" value="REGISTER"/> &nbsp;
            </form>

            <!--Javascript to open the registration modal -->
             <script>
                var registrationModal = document.getElementById("registrationModal");
                var registrationBtn = document.getElementById("registerButton"); //modal open button
                var registrationModalCloseBtn = document.getElementById("closeButton");

                registrationBtn.addEventListener('click', openRegistrationModal);

                function openRegistrationModal()
                    {
                        registrationModal.style.display = 'block';
                    }

                registrationModalCloseBtn.addEventListener('click', closeRegistrationModal);

                function closeRegistrationModal()
                    {
                        registrationModal.style.display = 'none';
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
                            //document.getElementById('registrationModal').innerHTML = document.getElementById('activateFrom').innerHTML;
                            let registrationModal = document.getElementById("registrationModal");
                            registrationModal.style.display = 'none';

                            let activationModal = document.getElementById("activationModal");
                            activationModal.style.display = 'block';
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
    <!-------------------------------------------------------------- Login Modal ----------------------------------------------------------------------------------->
    <div id="loginModal" class="modalTwo">
        <div class="modal-content-two">
            <span id="closeButtonTwo">&times;</span>

            <h3 id="loginTitle" align="center" >LOGIN</h3>

            <!--Login Form -->
            <form id ="login">
                Username: <input type="text" name="caffeineUsername"> <br>
                <br>
                Password: <input type="password" name="caffeinePassword"> <br>
                <br>
                <button id="loginSubmit" type="submit" name="logineButton" id="activateBtn">LOGIN</button>
            </form>

            <!--Javascript to open the login modal -->
            <script>
                var loginModal = document.getElementById("loginModal");
                var loginBtn = document.getElementById("LoginButton"); //modal open button
                var loginModalCloseBtn = document.getElementById("closeButtonTwo"); //modal close button

                loginBtn.addEventListener('click', openLoginModal);

                function openLoginModal()
                {
                    loginModal.style.display = 'block';
                }

                loginModalCloseBtn.addEventListener('click', closeLoginModal);

                function closeLoginModal()
                {
                    loginModal.style.display = 'none';
                }
            </script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
            <!--submit the login form and get response -->
            <script>
                $("#login").submit(function(event)
                {
                    event.preventDefault();
                    var post_url = "login.php";
                    var form_data = $(this).serialize(); //Encode form elements for submission
                    $.post( post_url, form_data, function(response)
                    {
                        //if response says "Registration successful", open the activation.html
                        if(response.match("Login Success"))
                        {
                            window.location.href = "caffeineHome.php";  //not coded yet
                        }
                        else
                        {
                            alert("Login failed. Please check credentials and try again!");  //display the error from the database
                            window.location.reload();
                        }
                    });
                });
            </script>
        </div>
    </div>
    <!-------------------------------------------------------------- End Login Modal -------------------------------------------------------------------------------->
    <!---------------------------------------------------------------Activation Modal ------------------------------------------------------------------------------->

    <div id="activationModal" class="modalThree">
        <div class="modal-content-three">
            <span id="closeButtonThree">&times;</span>

            <h3 id="activationTitle" align="center">Activate Account</h3>

            <form id ="activateFrom">
                Email: <input type="email" name="registeredEmail"><br>
                <br>
                ActivationCode: <input type="text" name="activationCode"><br>
                <br>
                <button id="activateSubmit" type="submit" name="activateButton" id="activateBtn">Activate</button>
            </form>

        <!--Displays to prompt the customer for credentials if activation successful -->
            <form id ="chooseCredentialsForm">
                <br><br>
                Username: <input type="text" name="RegisterUserName"><br>
                <br>
                Password: <input type="password" name="RegisterPassword"> <br>
                <br>
                <button id="finishRegistrationSubmit" type="submit" name="finishRegistrationButton" id="activateBtn">COMPLETE</button>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
    <script>
        $("#activateFrom").submit(function(event)
        {
            event.preventDefault();
            var post_url = "activate.php";
            var form_data = $(this).serialize(); //Encode form elements for submission
            $.post( post_url, form_data, function(response)
            {
                //if response says "activation success", display the div to choose credentials and hide the activation div
                if(response.match("Activation Success"))
                {
                    var x = document.getElementById("chooseCredentialsForm");
                    var y = document.getElementById("activateFrom");
                    var heading = document.getElementById("activationTitle")

                    heading.replaceWith( "Choose Credentials" ); //change the heading of the page
                    x.style.display = "block"; //show the choose credentials form
                    y.style.display = "none"; //hide the activation form

                    var activationModalCloseBtn = document.getElementById("closeButtonThree"); //modal close button
                    activationModalCloseBtn.addEventListener('click', closeActivationModal);

                    function closeActivationModal()
                    {
                        activationModalCloseBtn.style.display = 'none';
                    }
                }
                else
                {
                    alert("Activation failed,try again");
                }
            });
        });

        $("#chooseCredentialsForm").submit(function(event)
        {
            event.preventDefault();
            var post_url = "addCredentials.php";
            var form_data = $(this).serialize(); //Encode form elements for submission
            $.post( post_url, form_data, function(response)
            {
                //if response says "activation success", display the div to choose credentials and hide the activation div
                if(response.match("Registration Complete"))
                {
                    window.location.href='homeLandingPagePost.php'
                }
                else
                {
                    alert("Registration failed! Please try again");
                }
            });
        });

    </script>
    <!---------------------------------------------------------------End Activation Modal ------------------------------------------------------------------------------->
    </body>
</html>
