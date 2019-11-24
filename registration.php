<?php
//Author: Ajith V Keerikkattil
//updated: 10/29/2019
include 'dbConnection.php';
include 'verificationEmail.php';

if (isset($_POST['firstName'])) {
    $firstName = $_POST["firstName"];
}
if (isset($_POST['LastName'])) {
    $lastName = $_POST["LastName"];
}
if (isset($_POST['Street'])) {
    $street = $_POST["Street"];
}
if (isset($_POST['County'])) {
    $county = $_POST["County"];
}
if (isset($_POST['State'])) {
    $state = $_POST["State"];
}
if (isset($_POST['Zip'])) {
    $zip = $_POST["Zip"];
}
if (isset($_POST['email'])) {
    $email = $_POST["email"];
}
// calling the registration function
registration($servername, $username, $password, $db, $firstName, $lastName, $street, $county, $state, $zip, $email);

function registration($servername, $username, $password, $db, $firstName, $lastName, $street, $county, $state, $zip, $email)
{
    //generate the random activation code
    $activationCode = (String)generateActivationCode();

    $dbConnection = mysqli_connect($servername, $username, $password, $db);
    $statement = $dbConnection->prepare("insert into customerDetails (firstName, lastName, street, county, state, zip, email, activationCode, activationStatus) values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param("sssssisss", $fName, $lName, $streetName, $countyName, $stateCode, $postalCode, $emailAddress, $actCode, $actStat);
    $fName = $firstName;
    $lName = $lastName;
    $streetName = $street;
    $countyName = $county;
    $stateCode = $state;
    $postalCode = (integer)$zip;
    $emailAddress = $email;
    $actCode = $activationCode;
    $actStat = 'false';

    $statement->execute();
    if ($statement != null) {
        echo "Registration successful";
        //call the email function to email the activation code
        mailTwo($email, $firstName, $lastName, $actCode);
    }
    $statement->close();
}
function generateActivationCode()
{
    $hashCode = rand(10000, 99999);
    return $hashCode;
}