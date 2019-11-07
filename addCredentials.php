<?php
//Author: Ajith V Keerikkattil
//updated: 11/07/2019

session_start();

include 'dbConnection.php';
include "setSessionVariables.php";


if (isset($_POST['RegisterUserName'])) {
    $customerUserName = $_POST["RegisterUserName"];
}

if (isset($_POST['RegisterPassword'])) {
    $customerPass = $_POST["RegisterPassword"];
}


// calling the complete registration function
completeRegistration($servername, $username, $password, $db, $customerUserName, $customerPass);
setSessionVariablesUserName($servername, $username, $password, $db);

function completeRegistration($servername, $username, $password, $db, $customerUserName, $customerPass)
{

    $dbConnection = mysqli_connect($servername, $username, $password, $db);
    $statement = $dbConnection->prepare("insert into customerCredentials (username, password, email) values (?, ?, ?)");
    $statement->bind_param("sss", $uName, $uPass, $uEmail);

    $uName = $customerUserName;
    $uPass = $customerPass;
    $uEmail = $_SESSION["email"];

    $statement->execute();


    if ($statement != null) {
        echo "Registration Complete";

    }
    $statement->close();

}