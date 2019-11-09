<?php
    //Author: Ajith V Keerikkattil
    //updated: 11/07/2019

    session_start();

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
                                            <a href=" productDetails.php?productName=<?php echo $row['productName'] ?>"><img class="img-responsive" src="<?php echo 'images/' . $row['productImage']; ?>" style="width:100%;">&nbsp;
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

            <!----------------------------------Logout Button ----------------------------------->
            <div class="jumbotron">
                <h1><font color="white">Caffeine IOT MarketPlace</font></h1>
                <p class="hello" align="right">
                    <font color="white">Hello <?php echo $_SESSION["cafUserName"] ?> </font> &nbsp;&nbsp;&nbsp;
                    <button type="button" id="Logout" onclick="window.location.href='logout.php'">LOG OUT</button>
                </p>
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
                        <a class="nav-link" href="contactUs.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customerCart.php">Cart</a>
                    </li>
                </ul>
            </nav>
            <!---------------------------------End Navigation Bar-------------------------------------->

            <!-----------------AJAX Live Search -------------------->
            <h1 align="center">Search Results: </h1>

            <div id="search">
                <div class="form-group w-50">
                    <input class="form-control input-lg" type="text"  id="searchBox"  placeholder="SEARCH" onkeypress="showResults(this.value)">
                </div>
            </div>
            <br>

            <div id="allResults">
                <div class="row">
                    <?php getTopProducts($servername, $username, $password, $db); ?>
                </div>
            </div>

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
        </body>
    </html>
