<?php

session_start();
include 'dbConnection.php';

if(isset($_POST['productToRemove'])) {
    $prodToRemoveName = $_POST["productToRemove"];
}

//$prodToRemoveName = "Echo Dot";

removeSelectedProduct($servername, $username, $password, $db, $prodToRemoveName);

function removeSelectedProduct($servername, $username, $password, $db, $prodToRemoveName)
{
    $dbConnection = mysqli_connect($servername, $username, $password, $db);

    $query = "DELETE FROM customerCart WHERE productName = '$prodToRemoveName'";
    mysqli_query($dbConnection, $query);

    echo "Product removed";
}

