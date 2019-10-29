<?php
    session_start();
    include 'dbConnection.php';

    $productName = $_GET["productName"];

    getProductDetails($servername, $username, $password, $db, $productName);

    function getProductDetails ($servername, $username, $password, $db, $productName)
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
                        <h2> <?php echo $productName; ?> </h2>
                        <div id="prodimage">
                            <img src="<?php echo 'images/' . $productImage; ?>" width="400" height="200">
                        </div>
                        <div id="prodDescription">
                            <p> <?php echo $productDescription; ?></p>
                        </div>
                    </div>
                <?php
            }
        }
    }
?>