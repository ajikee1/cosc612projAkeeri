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
    if (mysqli_num_rows($result) >= 0) {
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="row">
            <div class="col-lg-4" xmlns="http://www.w3.org/1999/html">
                    <div class="thumbnail" align="center">
                        <a href=" productDetails.php?productName=<?php echo $row['productName'] ?>"><img class="img-responsive"
                                src="<?php echo 'images/' . $row['productImage']; ?>" style="width:100%">&nbsp;
                            <div class="caption">
                                <p> <?php echo $row['productName']; ?></p>
                                <p><?php echo "$ " .$row['productPrice']; ?></p>
                            </div>
                    </div>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body>
<!----------------------------------Logout Button ----------------------------------->
<div class="jumbotron">
    <h1> <font color="white">Caffeine IOT MarketPlace</font></h1>
    <p class="hello" align="right"><font color="white">Hello <?php echo $_SESSION["cafUserName"]?> </font> &nbsp;&nbsp;&nbsp;
    <button type="button" id="Logout" onclick="window.location.href='logout.php'">LOG OUT</button></p>
</div>
<!----------------------------------End Logout Button ------------------------------->

<!-----------------AJAX Live Search -------------------->
<h1 align="center">Our top products: </h1>

<div id="search">
    <input class="form-control input-lg" type="text"  id="searchBox"  placeholder="SEARCH" onkeypress="showResults(this.value)">
</div>
<br>

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
</body>
</html>
