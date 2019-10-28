<?php
include 'dbConnection.php';

?>
<html>

<head>
    <title>
        CaffeineIOT HomePage
    </title>
</head>
<body>
<!-- Login & Registration Button -->
<button type="button" id="registerButton">Register</button>
<button type="button" id="LoginButton">Login</button>

<h1>Our top products: </h1>


<div id="product-grid">
    <?php

    $dbConnection = mysqli_connect($servername, $username, $password, $db);

    //query to get the top ten products from the database
    $query = "SELECT * FROM products";

    $result = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($result) >= 0)
    {
        while ($row = mysqli_fetch_array($result))
            {
                ?>
                <div class="productItem">
                    <div class="product-image">
                        <a href=" <?php echo $row['productName'] ?>"><img src="<?php echo 'images/'. $row['productImage']; ?>" width="400" height="200">
                    </div>

                    <div class="product-tile-footer">
                        <div class="product-title"><?php echo $row['productName']; ?></div>
                        <div class="product-price"><?php echo $row['productPrice']; ?></div>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>

</body>

</html>
