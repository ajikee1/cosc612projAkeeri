<?php

include 'dbConnection.php';


if (isset($_POST['registeredEmail'])) {
    $registeredEmail = $_POST["registeredEmail"];
}

if (isset($_POST['activationCode'])) {
    $activationCode = $_POST["activationCode"];
}

/*
$registeredEmail ='ajikee1@umbc.edu';
$activationCode = '89788'; */

//call the activate function
activate($servername, $username, $password, $db, $registeredEmail, $activationCode);

function activate($servername, $username, $password, $db, $registeredEmail, $activationCode)
{

    $dbConnection = mysqli_connect($servername, $username, $password, $db);

    //query to get the activation code from the DB
    $query = "SELECT activationCode FROM customerDetails WHERE email='" . $registeredEmail . "'";

    $result = mysqli_query($dbConnection, $query);

    while ($row = $result->fetch_assoc()) {
        $activationCodeFromDB = $row['activationCode'];
        echo $activationCodeFromDB;

        if ($activationCodeFromDB == (string)$activationCode) {
            $query2 = "UPDATE customerDetails SET activationStatus = 'true' WHERE email='" . $registeredEmail . "'";

            if ($dbConnection->query($query2) === TRUE) {
                echo 'Activation Success';
                //header("Location: caffeineHome.php");
                exit;
            }
        } else {
            echo 'Activation Failed';
        }
    }
    mysqli_free_result($result);
    mysqli_close($dbConnection);
}



