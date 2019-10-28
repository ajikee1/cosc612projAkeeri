<?php

include 'dbConnection.php';

$status = uploadProduct($servername, $username,$password, $db);
echo $status;

/*CREATE TABLE `products` (
`productId` int(3) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productPrice` double(5,2) NOT NULL,
  `stock` int(5) NOT NULL,
  `productDescription` varchar(100) NOT NULL,
  `productImage` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1; */


function uploadProduct($servername, $username,$password, $db)
{
    $dbConnection = mysqli_connect($servername, $username, $password, $db);

    // If the upload button is clicked
    if (isset($_POST['uploadProducttoDB'])) {
         $productImage = $_FILES['productImage']['name'];
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productStock = $_POST['stock'];
        $productDescription = $_POST['productDescription'];

        // target directory where the product image will be stored into
        $target = "images/".basename($productImage);

        $query = "INSERT INTO products (productName, productPrice, stock, productDescription, productImage) VALUES ('$productName', '$productPrice', '$productStock','$productDescription', '$productImage')";


        mysqli_query($dbConnection, $query);

        if (move_uploaded_file($_FILES['productImage']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }
        return $msg;
    }
}
?>

<html>
    <head>
        <title>
            Supplier app product portal
        </title>
    </head>
    <body>

        <h1>Supplier Product Restock portal</h1>
        <h3>Suppliers can use this portal to add products to CaffeineIOT</h3>
        <form method="post" action="productUpload.php" enctype="multipart/form-data">
            Product image: <input type="file" name="productImage">
            Product name: <input type="text" name="productName">
            Product price: <input type="number" name="productPrice">
            Product stock: <input type="number" name="stock">
            Product description: <textarea name="productDescription" rows="10" cols="10" placeholder="Enter product details here..."></textarea>
            <button type="submit" name="uploadProducttoDB">Add product</button>

        </form>
    </body>
</html>
