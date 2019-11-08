<?php
    session_start();
    include 'dbConnection.php';

    if (isset($_POST['addProductName']))
    {
        $prodName = $_POST["addProductName"];
    }

    if (isset($_POST['quantity']))
    {
        $neededQuantity = $_POST["quantity"];
    }

   if (isset($_POST['addProductPrice']))
   {
       $prodPrice = $_POST["addProductPrice"];
   }

    function checkProductAvailability($servername, $username,$password, $db,$prodName)
    {
        $availableQuantity = null;
        $dbConnection = mysqli_connect($servername, $username, $password, $db, $prodName);

        //query to get the stock of the product selected
        $query = "SELECT stock FROM products WHERE productName='" . $prodName . "'";

        $result = mysqli_query($dbConnection, $query);

        while ($row = $result->fetch_assoc())
        {
            $availableQuantity   = $row['stock']; //get the available quantity of this product
        }
        mysqli_free_result($result);
        mysqli_close($dbConnection);

        return $availableQuantity;
    }

    function checkIfEnoughStock($availableQuantity, $neededQuantity)
    {
        $availabilityIndicator = null;

        if (((int)$availableQuantity) > ((int)$neededQuantity))
        {
            $availabilityIndicator = True;
        }
        else{
            $availabilityIndicator = False;
        }

        return $availabilityIndicator;

    }

    function calculateProductTotal($neededQuantity, $prodPrice)
    {
        $prodTotal = (int)$neededQuantity * (double) $prodPrice;
        return $prodTotal;
    }

    function addToCart($servername, $username,$password, $db,$prodName, $neededQuantity,  $availabilityIndicator, $prodTotal)
    {
        if ( $availabilityIndicator = true)
        {
            $dbConnection = mysqli_connect($servername, $username, $password, $db, $prodName);

            //query to add the selected product to cart

            //CREATE TABLE `caffeineDB`.`customerCart` ( `username` VARCHAR(20) NOT NULL , `email` VARCHAR(50) NOT NULL , `productName` VARCHAR(50) NOT NULL , `purchaseQuantity` INT(5) NOT NULL , `productTotal` DOUBLE(3,2) NOT NULL ) ENGINE = InnoDB;
            $statement = $dbConnection->prepare("insert into customerCart (username, email, productName, purchaseQuantity, productTotal) values (?, ?, ?, ?, ?)");
            $statement->bind_param("sssid", $cName, $cEmail, $pName, $pQuantity, $pTotal);

            $cName = $_SESSION["caffeineUsername"];
            $cEmail = $_SESSION["caffeineEmail"];
            $pName = $prodName;
            $pQuantity = (int) $neededQuantity;
            $pTotal = (double)$prodTotal;

            $statement->execute();


            if ($statement != null) {
                echo "Product added to cart";
            }
            else{
                echo "Product currently not available";
            }
            $statement->close();
        }
    }

