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
<!----------------------------------Logout Button ----------------------------------->
<div id="header">
    <div id="buttonDiv">
        <font color="white"> Hello <?php echo $_SESSION["cafUserName"]?> </font>   &nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" id="Logout" onclick="window.location.href='logout.php'">LOG OUT</button>
    </div>
</div>
<!----------------------------------End Logout Button ------------------------------->

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
</body>
</html>
