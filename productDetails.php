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
                height: 600px;
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

            <div id="prodimage">
                <img class="img-responsive" src="<?php echo 'images/' . $productImage; ?>">  &nbsp;&nbsp;&nbsp;&nbsp;
                <font size="4px">Product price $ <?php echo $productPrice ?> </font>
            </div>

            <div id="prodDescription">
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