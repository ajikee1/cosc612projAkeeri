<?php
    include 'dbConnection.php';
    session.start();

    $_SESSION["caffeineUsername"]; $_SESSION["caffeineEmail"];

    if (isset($_POST['caffeineUsername']))
    {
        $caffeineUsername = $_POST["caffeineUsername"];
        $_SESSION["caffeineUsername"] = $caffeineUsername;  //set the session variable to track the logged-in user

    }

    if (isset($_POST['caffeinePassword']))
    {
        $caffeinePassword= $_POST["caffeinePassword"];
    }

    //call the login function
    login($servername, $username,$password, $db, $caffeinePassword);

    function login($servername, $username,$password, $db, $caffeinePassword)
    {

        $dbConnection = mysqli_connect($servername, $username, $password, $db);

        //query to get the password and email from database using username
        $query = "SELECT email,password FROM credentials WHERE username='" . $_SESSION['caffeineUsername'] . "'";
        $result = mysqli_query($dbConnection, $query);

        while ($row = $result->fetch_assoc())
        {
            $emailFromDB   = $row['email'];  $_SESSION["caffeineEmail"] = $emailFromDB; //set the session variable for email
            $passwordFromDB   = $row['password']; //get the password of the user
            $activationIndicatorFromDB = (string) getActivationIndicator($servername, $username, $password, $db); //check to see if the account has been activated
            $activationIndicatorDesiredStatus = (string) 'true';

            if (($passwordFromDB == $caffeinePassword) && ($activationIndicatorFromDB == $activationIndicatorDesiredStatus))
            {
                echo 'Login Success';
                //header("Location: caffeineHome.php");
                exit;
            }
            else
            {
                echo 'Login Fail';
                unset($_SESSION['caffeineEmail']);
                unset($_SESSION['caffeineUsername']);
                echo('Login Failed');
            }
        }
        mysqli_free_result($result);
        mysqli_close($dbConnection);
    }

    function getActivationIndicator($servername, $username,$password, $db)
    {
        $activationIndicatorFromDB = null;
        $dbConnection2 = mysqli_connect($servername, $username, $password, $db);

        //query to get the activation status from database using email address
        $query2 = "SELECT activationStatus FROM customerDetails WHERE email='" . $_SESSION['caffeineEmail'] . "'";
        $result2 = mysqli_query($dbConnection2, $query2);

        if (mysqli_num_rows($result2) > 0)
        {
            while ($row = mysqli_fetch_array($result2))
            {
                $activationIndicatorFromDB = $row['activationStatus'];
            }
            mysqli_free_result($result2);
            mysqli_close($dbConnection2);
        }
        else
        {
            echo 'Customer with email not found in the database';
        }

        return $activationIndicatorFromDB;

    }

