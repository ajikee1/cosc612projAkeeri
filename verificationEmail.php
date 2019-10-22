<?php

use PHPMailer\PHPMailer\PHPMailer;

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
        echo "Activation code mailed!";
    }
    else
    {
         echo "Unable to mail activation code!";
    }
}

?>