<?php
session_start();
include 'dbConnection.php';
?>

<html>
<head>

    <title>
        Payment Confirmation
    </title>

    <link rel="stylesheet" type="text/css" href=" ./css/HomePageStyle.css"
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
        button {
            font-size: large;
        }

        h2, table, h3{
            font-family: Bungee;
            font-size: x-large;
        }

    </style>

</head>
<body>

<!----------------------------------Logout Button ----------------------------------->
<div class="jumbotron">
    <h1><font color="white">Caffeine IOT MarketPlace</font></h1>
    <p class="hello" align="right">
        <font color="white">Hello <?php echo $_SESSION["cafUserName"] ?> </font> &nbsp;&nbsp;&nbsp;
        <button type="button" id="Logout" onclick="window.location.href='logout.php'">LOG OUT</button>
    </p>
</div>
<!----------------------------------End Logout Button ------------------------------->

<!---------------------------------Navigation Bar-------------------------------------->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="homeLandingPagePost.php">Home</a>
    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="aboutUs.php">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contactUs.php">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="customerCart.php">Cart</a>
        </li>
    </ul>
</nav>
<!---------------------------------End Navigation Bar-------------------------------------->

<?php
    $pp_hostname = "www.sandbox.paypal.com";

    $req = 'cmd=_notify-synch';

    $tx_token = $_GET['tx'];
    $auth_token = "1xlkQDMogFcRJgf5pCsr--tMq9c6c9mmN9Gn_Y5GbBl1t5gqwiRnUCWfs5W";
    $req .= "&tx=$tx_token&at=$auth_token";

    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));

        $res = curl_exec($ch);
        curl_close($ch);

        // parse the data
        $lines = explode("\n", $res);
         $keyarray = array();

         if (strcmp($lines[0], "SUCCESS") == 0) {

             for ($i = 1; $i < count($lines); $i++) {
                 list($key, $val) = explode("=", $lines[$i]);
                 $keyarray[urldecode($key)] = urldecode($val);
             }

             $transactionCode = $keyarray['txn_id'];
             $transactionDate = $keyarray["payment_date"];
             $firstName = $keyarray['first_name'];
             $lastName = $keyarray['last_name'];
             $custom = $keyarray['custom'];
             $split = $pieces = explode(" ", $custom);
             $caffeineUsername = $split[0];
             $caffeineEmail = $split[1];
             $amount = $keyarray['payment_gross'];
             $paymentStatus = $keyarray["payment_status"];

             ?>
             <div class="table-responsive">
            <table class= "table table-bordered table-responsive-lg table-hover table-dark" id="cartTable">
                <tbody>

                <?php
             echo "<tr>";
             echo "<td>Transaction ID</font></td>";
             echo "<td>" . $transactionCode . "</td>";
             echo "</tr>";

             echo "<tr>";
             echo "<td>Transaction Date</font></td>";
             echo "<td>" . $transactionDate . "</td>";
             echo "</tr>";

             echo "<tr>";
             echo "<td>Paypal Account Holder Name</font></td>";
             echo "<td>" . $firstName . " " . $lastName . "</td>";
             echo "</tr>";

             echo "<tr>";
             echo "<td>Caffeine Username</font></td>";
             echo "<td>" . $caffeineUsername . "</td>";
             echo "</tr>";

             echo "<tr>";
             echo "<td>Caffeine Email</font></td>";
             echo "<td>" . $caffeineEmail . "</td>";
             echo "</tr>";

             echo "<tr>";
             echo "<td>Amount Paid</font></td>";
             echo "<td>" . $amount . "</td>";
             echo "</tr>";

             echo "<tr>";
             echo "<td>Payment Status</font></td>";
             echo "<td>" . $paymentStatus . "</td>";
             echo "</tr>";

             ?>

                </tbody>
            </table>

                 <?php

             //add transaction to database
             addTransaction($servername, $username, $password, $db, $transactionCode, $firstName, $lastName, $amount, $caffeineUsername, $caffeineEmail, $paymentStatus);
         }

        function addTransaction($servername, $username, $password, $db, $transactionCode, $firstName, $lastName, $amount, $caffeineUsername, $caffeineEmail, $paymentStatus)
        {
            $dbConnection = mysqli_connect($servername, $username, $password, $db);

            $sqlStmt = "INSERT INTO transaction (transactionCode, firstName, lastName, amount, caffeineUsername, caffeineEmail, paymentStatus) VALUES ('$transactionCode', '$firstName', '$lastName', '$amount', '$caffeineUsername', '$caffeineEmail', '$paymentStatus')";

            if (mysqli_query($dbConnection, $sqlStmt))
            {
                sendTransactionEmail($transactionCode, $firstName, $lastName, $amount, $caffeineEmail, $paymentStatus);
            }
        }

         function sendTransactionEmail($transactionCode, $firstName, $lastName, $amount, $caffeineEmail, $paymentStatus)
         {
             $text_body = "Hello " . $firstName . " " . $lastName . ", \n\n\n\n";
             $text_body .= "Purchase Confirmation \n\n\n\n";
             $text_body .= "Transaction ID: " . $transactionCode . "\n\n\n\n";
             $text_body .= "Amount $" . $amount . "\n\n\n\n";
             $text_body .= "Payment status: " . $paymentStatus . "\n\n\n\n";

             $text_body .= "Sincerely, \n\n";
             $text_body .= "CaffeineIOT Customer Service team";

             $from = "admin@gamesForTots.us";
             $message = $text_body;
             $subject = "Purchase Confirmation";
             $to = $caffeineEmail;
             $headers = "MIME-VERSION: 1.0" . "\r\n";
             $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
             $headers .= "From : <$from> \r\n";

             mail($to, $subject, $message, $headers);

         }
?>

</body>
</html>