<?php

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

    //CREATE TABLE `caffeineDB`.`customerDetails` ( `customerID` INT NOT NULL AUTO_INCREMENT , `firstName` VARCHAR(20) NOT NULL , `lastName` VARCHAR(20) NOT NULL , `street` VARCHAR(50) NOT NULL , `county` VARCHAR(20) NOT NULL , `state` VARCHAR(2) NOT NULL , `zip` INT(5) NOT NULL , `email` VARCHAR(20) NOT NULL , PRIMARY KEY (`customerID`)) ENGINE = InnoDB;
    //ALTER TABLE `customerDetails` ADD `activationCode` VARCHAR(15) NOT NULL AFTER `email`, ADD `activationStatus` VARCHAR(10) NOT NULL AFTER `activationCode`;
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


    if ($statement != null)
    {
        echo "Registration successful";
        //call the email function to email the activation code
        email($email, $firstName, $lastName, $actCode);
    }
    $statement->close();


}

function generateActivationCode()
{
    $hashCode = rand(10000, 99999);
    return $hashCode;
}

