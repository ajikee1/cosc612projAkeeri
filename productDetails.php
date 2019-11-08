<?php
//Author: Ajith V Keerikkattil
//updated: 10/29/2019

session_start();
include 'dbConnection.php';

$productName = $_GET["productName"];

?>
<head>
    <head>
        <title>
            Product Details  <?php echo $productName?>
        </title>

        <link rel="stylesheet" type="text/css" href=" ./css/HomePageStyle.css">
        <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <style>
            img{
                width: 400px;
                height: 250px;
            }

            #prodimage{
                padding-left: 25%;
                padding-right: 25%;
                font-weight: lighter;
                font-size: smaller;
            }

            p{
                text-align: center;
                font-size: 15px;
            }

            h5{
                text-align: center;
            }

        </style>
    </head>
    <body>
<div id="header">
    &nbsp;&nbsp;&nbsp;&nbsp; <button type="button" id="back" onclick="window.location.href='homeLandingPage.php'">BACK</button>
    <div id="buttonDiv">
        <font color="white"> Hello username </font>   &nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" id="Logout" onclick="window.location.href='logout.php'">LOG OUT</button>
    </div>
</div>
    </body>


<?php
getProductDetails($servername, $username, $password, $db, $productName);

function getProductDetails($servername, $username, $password, $db, $productName)
{
    $dbConnection = mysqli_connect($servername, $username, $password, $db);

    $query = "SELECT * FROM products WHERE productName = '$productName'";

    $result = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($result) >= 0) {
        while ($row = mysqli_fetch_array($result)) {

            $productImage = $row['productImage'];
            $productPrice = $row['productPrice'];
            $productDescription = $row['productDescription'];
            $productStock = $row['stock'];

            ?>
            <div id="prodDetails">
                <h2 align="center"> <?php echo $productName; ?> </h2>
                <div id="prodimage">
                    <img class="img-responsive" src="<?php echo 'images/' . $productImage; ?>" border="5px">  &nbsp;&nbsp;&nbsp;&nbsp;
                    Product price $ <?php echo $productPrice ?>
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