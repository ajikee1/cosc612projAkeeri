<?php
//Author: Ajith V Keerikkattil
//updated: 11/07/2019

session_start();

$_SESSION["cafUserName"] = null;

function setSessionVariablesUserName($servername, $username, $password, $db)
{

    $dbConnection = mysqli_connect($servername, $username, $password, $db);

    //query to get the username and set it as a session username
    $query = "SELECT username FROM customerCredentials WHERE email='" . $_SESSION['email'] . "'";
    $result = mysqli_query($dbConnection, $query);

    while ($row = $result->fetch_assoc())
    {
        $_SESSION["cafUserName"]  = $row['username'];  //set the session variable for email
    }
    mysqli_free_result($result);
    mysqli_close($dbConnection);

}
?>