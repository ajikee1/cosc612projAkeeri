<?php
//Author: Ajith V Keerikkattil
//updated: 11/07/2019

    include 'dbConnection.php';

    function getTopProducts($servername, $username, $password, $db)
        {
            $dbConnection = mysqli_connect($servername, $username, $password, $db);

            $query = "SELECT * FROM products";

            $result = mysqli_query($dbConnection, $query);

            if (mysqli_num_rows($result) >= 0)
                {
                    while ($row = mysqli_fetch_array($result))
                        { ?>

                            <div class="col-lg-4" xmlns="http://www.w3.org/1999/html">
                                <div class="thumbnail" align="center">
                                    <a href=" productDetails.php?productName=<?php echo $row['productName'] ?>"><img class="img-responsive" src="<?php echo 'images/' . $row['productImage']; ?>" style="width:100%;"> </a>&nbsp;
                                        <div class="caption">
                                            <p> <?php echo $row['productName']; ?></p>
                                            <p><?php echo "$ " . $row['productPrice']; ?></p>
                                        </div>
                                </div>
                            </div>

<?php
                        }
                }
        } ?>

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

        </head>

        <body>
                <!----------------------------------Login & Registration Button ----------------------------------->

                <div class="jumbotron">
                    <h1> <font color="white">Caffeine IOT MarketPlace</font></h1>
                        <p class="hello" align="right">
                            <button type="button" class="btn btn-light btn-lg" id="registerButton">Register</button> &nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-light btn-lg" id="LoginButton">Login</button>
                        </p>
                </div>
                <!----------------------------------End Login & Registration Button ------------------------------->

                <!---------------------------------Navigation Bar-------------------------------------->
                <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
                    <a class="navbar-brand" href="homeLandingPagePost.php">Home</a>
                    <!-- Links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="aboutUs.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contactUs.php">Contact Us</a>
                        </li>
                    </ul>
                </nav>
                <!---------------------------------End Navigation Bar-------------------------------------->

                <!-----------------AJAX Live Search -------------------->
                <h1 align="center">Our top products: </h1>
                <div id="search">
                    <div class="form-group w-50">
                        <input class="form-control input-lg" type="text"  id="searchBox"  placeholder="SEARCH" onkeypress="showResults(this.value)">
                    </div>
                </div>
                <br>

                <!--Display all products -->
                <div id="allResults">
                    <div class="row">
                        <?php  getTopProducts($servername, $username, $password, $db);?>
                    </div>
                </div>

                <!--Display all search results -->
                <div id="searchResults"></div>

                <script>
                    function showResults(str)
                        {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function ()
                                {
                                    if (this.readyState == 4 && this.status == 200)
                                        {
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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
                <div id="registrationModal" class="modalOne">
                <div class="modal-content-One">

                    <span id="closeButton">&times;</span>
                    <div id="formHeader">
                        <h3 id="registrationTitle" align="center"><font color="white">New User Registration </font></h3>
                    </div>

                    <!--Registration Form -->
                    <form id ="registration">
                            <br>
                            <div class="form-group w-50">
                                <input class="form-control" type="text" name="firstName" placeholder="First Name"> <br>
                            </div>

                            <div class="form-group w-50">
                                <input class="form-control" type="text" name="LastName" placeholder="Last Name"> <br>
                            </div>

                            <div class="form-group w-75">
                                <input class="form-control" type="text" name="Street" placeholder="STREET ADDRESS"> <br>
                            </div>

                            <div class="form-group w-50">
                                <input class="form-control" type="text" name="County" placeholder="COUNTY" > <br>
                            </div>

                        <div class="form-group w-25">
                            State <select class="form-control" name="State" id="state" size="1"> <br>
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
                            </select>
                            <br>
                        </div>

                        <div class="form-group w-25">
                            <input class="form-control" type="text" name="Zip" placeholder="ZIP CODE" > <br>
                        </div>

                        <div class="form-group w-75">
                            <input class="form-control" type="text" class="emailBox" name="email" placeholder="EMAIL ADDRESS">
                        </div>

                        <br>
                        <button id="registrationSubmit" class="btn btn-success" type="submit" name="submit" id="RegisterBtn">REGISTER</button>
                        </div>
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
                        <button id="loginSubmit" class="btn btn-light btn-lg" type="submit" name="logineButton">LOGIN</button>
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
                                                window.location.href = "homeLandingPagePost.php";  //not coded yet
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
                        <button id="activateSubmit" class="btn btn-light btn-lg" type="submit" name="activateButton">Activate</button>
                    </form>

                    <!--Displays to prompt the customer for credentials if activation successful -->
                    <form id ="chooseCredentialsForm">
                        <br><br>
                        Username: <input type="text" name="RegisterUserName"><br>
                        <br>
                        Password: <input type="password" name="RegisterPassword"> <br>
                        <br>
                        <button id="finishRegistrationSubmit" class="btn btn-light btn-lg" type="submit" name="finishRegistrationButton">COMPLETE</button>
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