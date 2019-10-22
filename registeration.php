<?php

include 'dbConnection.php';


    if (isset($_POST['firstName']))
    {
        $firstName = $_POST["firstName"];

    }

    if (isset($_POST['LastName']))
    {
        $lastName = $_POST["LastName"];
    }

    if (isset($_POST['Street']))
    {
        $street = $_POST["Street"];
    }

    if (isset($_POST['County']))
    {
        $county = $_POST["County"];
    }

    if (isset($_POST['State']))
    {
        $state = $_POST["State"];
    }

    if (isset($_POST['Zip']))
    {
        $zip = $_POST["Zip"];
    }

    if (isset($_POST['email']))
    {
        $email = $_POST["email"];
    }

    // calling the registration function
    registration($servername, $username,$password, $db, $firstName, $lastName, $street, $county, $state, $zip, $email);

    function registration($servername, $username,$password, $db, $firstName, $lastName, $street, $county, $state, $zip, $email)
    {

        //CREATE TABLE `caffeineDB`.`customerDetails` ( `customerID` INT NOT NULL AUTO_INCREMENT , `firstName` VARCHAR(20) NOT NULL , `lastName` VARCHAR(20) NOT NULL , `street` VARCHAR(50) NOT NULL , `county` VARCHAR(20) NOT NULL , `state` VARCHAR(2) NOT NULL , `zip` INT(5) NOT NULL , `email` VARCHAR(20) NOT NULL , PRIMARY KEY (`customerID`)) ENGINE = InnoDB;

        $dbConnection = mysqli_connect($servername, $username, $password, $db);
        $statement = $dbConnection->prepare("insert into customerDetails (firstName, lastName, street, county, state, zip, email) values (?, ?, ?, ?, ?, ?, ?)");
        $statement -> bind_param("sssssis" , $fName, $lName, $st, $count, $statecd, $postCode, $emailAddress);

        $fName = $firstName;
        $lName = $lastName;
        $st = $street;
        $count = $county;
        $statecd = $state;
        $postCode = $zip;
        $emailAddress = $email;

        $statement -> execute();

        $statement ->close();
        echo "Customer registration successful";

    }


