<?php

//Author: Ajith V Keerikkattil
//updated: 10/29/2019

use PHPMailer\PHPMailer\PHPMailer;


/*$email ='ajikee1@icloud.com';
$firstName = 'John';
$lastName = 'Doe';
$actCode = 1234; */


function email($email, $firstName, $lastName, $actCode)
{
    require '../vendor/autoload.php';
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;

    $mail->Username = "mtstCloudExe@gmail.com";
    $mail->Password = "Test123#";

    //from address
    $mail->setFrom('mtstCloudExe@gmail.com');
    //to address
    $mail->addAddress($email, $firstName . $lastName);

    //Set the subject line
    $mail->Subject = ' CaffeineIOT Verification';

    $text_body = "Hello " . $firstName . ", \n\n\n\n";
    $text_body .= "Thank you for registering at CaffeineIOT.\n\n\n\n";
    $text_body .= "Before you can access everything we have to offer, we have to verify your identify.\n\n\n\n";
    $text_body .= "Please enter this code into the verification code text box at CaffeineIOT: " . $actCode . "\n\n\n\n";
    $text_body .= "Sincerely, \n\n";
    $text_body .= "CaffeineIOT Customer Service team";

    $mail->Body = $text_body;


    if (!$mail->send()) {
        echo "Unable to mail activation code!";
    } else {
    }
}

function mailTwo($email, $firstName, $lastName, $actCode)
{

    $text_body = "Hello " . $firstName . ", \n\n\n\n";
    $text_body .= "Thank you for registering at CaffeineIOT.\n\n\n\n";
    $text_body .= "Before you can access everything we have to offer, we have to verify your identify.\n\n\n\n";
    $text_body .= "Please enter this code into the verification code text box at CaffeineIOT: " . $actCode . "\n\n\n\n";
    $text_body .= "Sincerely, \n\n";
    $text_body .= "CaffeineIOT Customer Service team";

    $from = "admin@gamesForTots.us";
    $message = $text_body;
    $subject = "CaffeineIOT Verification";
    $to = $email;
    $headers = "MIME-VERSION: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers = "From : <$from> \r\n";
    if (mail($to, $subject, $message, $headers))
    {
        echo "Verification Email Sent";
    }
    else
    {
        echo "Verification Email Failed";
    }
}

?>