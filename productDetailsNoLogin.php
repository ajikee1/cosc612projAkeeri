<?php
//Author: Ajith V Keerikkattil
//updated: 10/29/2019

    session_start();
    include 'dbConnection.php';

    $productName = $_GET["productName"]; ?>

<html>
    <head>
        <title>
            Product Details  <?php echo $productName?>
        </title>

        <link rel="stylesheet" type="text/css" href=" ./css/HomePageStyle.css"
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <style>
            img{
                width: 800px;
                height: 580px;
            }

            #prodimage{
                font-weight: lighter;
                font-size: smaller;
            }

            #prodDetails{
                font-size: 30px;
                font-family: "Bungee";
            }

            h5{
                text-align: center;
            }

        </style>
    </head>

    <body>
    <!----------------------------------Logout Button ----------------------------------->
    <div class="jumbotron">
        <h1><font color="white">Caffeine IOT MarketPlace</font></h1>
        <p class="hello" align="right">
            <font color="white">Hello, <?php echo $_SESSION["cafUserName"] ?> </font> &nbsp;&nbsp;&nbsp;
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


<?php
    //call the get product details function
    getProductDetails($servername, $username, $password, $db, $productName);

    function getProductDetails($servername, $username, $password, $db, $productName)
        {
            $dbConnection = mysqli_connect($servername, $username, $password, $db);

            $query = "SELECT * FROM products WHERE productName = '$productName'";

            $result = mysqli_query($dbConnection, $query);

            if (mysqli_num_rows($result) >= 0)
                {
                while ($row = mysqli_fetch_array($result))
                    {
                        $productImage = $row['productImage'];
                        $productPrice = $row['productPrice'];
                        $productDescription = $row['productDescription'];
                        $productStock = $row['stock'];  ?>

        <div id="prodDetails">
            <h2 align="center"> <?php echo $productName; ?> </h2>

            <span id="prodimage">
                <img class="img-responsive" src="<?php echo 'images/' . $productImage; ?>">  &nbsp;&nbsp;
                <font size="4px">Product price $ <?php echo $productPrice ?> </font>

                <form id="addToCartForm">
                    <input type="hidden" name="addProductName" value="<?php echo $productName; ?>">
                    <input type="hidden" name="addProductPrice" value="<?php echo $productPrice; ?>">

                    <label for="quantity">Choose a quantity</label>
                    <select name="quantity" class="browser-default custom-select">
                        <option selected>0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                    <button  id="AddToCartBtn" type="submit" name="AddToCartBtn">ADD TO CART</button>
                </form>

                            <!--Javascript to add product to cart-->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
                    <script>
                        $("#addToCartForm").submit(function(event)
                        {
                            event.preventDefault();
                            var post_url = "preCartAddLogic.php";
                            var form_data = $(this).serialize(); //Encode form elements for submission
                            $.post( post_url, form_data, function(response)
                            {
                                //if response says "Product added to cart"", open the cart page
                                if(response.match("Product added to cart"))
                                {
                                    //window.location.href = "listSessionVariables.php";
                                    alert("You need to be logged in to make purchases. please sign-in");  //low stock
                                   // window.location.href = "customerCart.php";
                                }
                                else
                                {
                                    alert("Product currently not available");  //low stock
                                }
                            });
                        });
                    </script>
            </span>

            <div id="prodDescription">
                <br>
                <h5><u>Product Description</u></h5>
                <p><?php echo $productDescription; ?></p>
            </div>
        </div>

<?php
                    }
                }
        }

?>
    </body>
</html>