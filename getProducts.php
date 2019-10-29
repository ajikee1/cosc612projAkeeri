<?php
    session_start();
    include 'dbConnection.php';
    $_SESSION['productNameField'] = null;

    $keyword = $_GET["q"];


  // $keyword = "dot";

    if(strlen($keyword) >0)
    {
        getSearchProducts($servername, $username, $password, $db, $keyword);
    }
    else{
        getAllProducts($servername, $username, $password, $db);
    }

    function getSearchProducts($servername, $username, $password, $db, $keyword)
        {
            $dbConnection = mysqli_connect($servername, $username, $password, $db);

            $query = "SELECT * FROM products WHERE productName LIKE '%$keyword%' LIMIT 5";

            $result = mysqli_query($dbConnection, $query);

            if (mysqli_num_rows($result) >= 0) {
                while ($row = mysqli_fetch_array($result)) {
                        $_SESSION['productNameField'] = $row['productName'];
                    ?>
                    <div class="productItem">
                        <div class="product-image">
                            <a href=" productDetails.php?productName=<?php echo $row['productName'] ?>"><img
                                    src="<?php echo 'images/' . $row['productImage']; ?>" width="400" height="200">
                        </div>

                        <div class="product-tile-footer">
                            <div class="product-title"><?php echo $row['productName']; ?></div>
                            <div class="product-price"><?php echo $row['productPrice']; ?></div>
                        </div>
                    </div>
                    <?php
                }
            }
        }

    function getAllProducts($servername, $username, $password, $db)
    {
        $dbConnection = mysqli_connect($servername, $username, $password, $db);

        $query = "SELECT * FROM products";

        $result = mysqli_query($dbConnection, $query);

        if (mysqli_num_rows($result) >= 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class="productItem">
                    <div class="product-image">
                        <a href=" productDetails.php?productName=<?php echo $row['productName'] ?>"><img
                                src="<?php echo 'images/' . $row['productImage']; ?>" width="400" height="200">
                    </div>

                    <div class="product-tile-footer">
                        <div class="product-title"><?php echo $row['productName']; ?></div>
                        <div class="product-price"><?php echo $row['productPrice']; ?></div>
                    </div>
                </div>
                <?php
            }
        }
    }
?>