<?php

session_start();
include 'dbConnection.php';

    getAllProductsInCart($servername, $username, $password, $db);

    function getAllProductsInCart($servername, $username, $password, $db)
        {

            $dbConnection = mysqli_connect($servername, $username, $password, $db);

            $customerUserName = $_SESSION["cafUserName"];
            //$customerUserName = "ajithmatrik";


            $query = "SELECT * FROM customerCart WHERE username = '$customerUserName'";

            $result = mysqli_query($dbConnection, $query); ?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href=" ./css/HomePageStyle.css"
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <style>
            body, h2, table{
                font-family: Bungee;
                font-size: x-large;
            }

            #total{
                text-align: right;
                font-size: x-large;
            }

            button {
                font-size: x-large;
            }
        </style>

    </head>
    <body>

        <!----------------------------------Logout Button ----------------------------------->
        <div class="jumbotron">
            <h1><font color="white">Caffeine IOT MarketPlace</font></h1>
            <p class="hello" align="right">
                <font color="white">Hello, <?php echo $_SESSION["cafUserName"] ?> </font> &nbsp;&nbsp;&nbsp;
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

        <h2 align="center">YOUR CART</h2>

        <div class="container">
        <div class="table-responsive">
            <table class= "table table-bordered table-responsive-lg table-hover table-dark" id="cartTable">
             <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Product Total</th>
                    <th> </th>
                </tr>
             </thead>
            <tbody>

    <?php
        if (mysqli_num_rows($result) >= 0)
            {
                while ($row = mysqli_fetch_array($result))
                    {
                        $prodName = $row['productName'];
                        $prodQuantity = $row['purchaseQuantity'];
                        $prodTotal = $row['productTotal']; ?>

                <tr>
                    <td><?php echo $prodName;?></td>
                    <td><?php echo $prodQuantity;?></td>
                    <td><?php echo $prodTotal;?></td>
                    <td>
                        <form id="removeForm">
                            <input type="hidden" name="productToRemove" value="<?php echo $prodName;?>">
                            <button name="removeForm" type="submit">Remove</button>
                        </form>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                        <script>
                            //submit the registration form ang get response
                            $("#removeForm").submit(function(event)
                            {
                                event.preventDefault();
                                var post_url = "removeFromCart.php";
                                var form_data = $(this).serialize(); //Encode form elements for submission
                                $.post( post_url, form_data, function(response)
                                {
                                    //if response says "Registration successful", open the activation.html
                                    if(response.match("Product removed"))
                                    {
                                        window.location.reload();
                                    }
                                    else
                                    {
                                        alert(response);  //display the error from the database
                                    }
                                });
                            });
                        </script>

                    </td>
                </tr>
<?php
        }
    }

    mysqli_free_result($result);
    mysqli_close($dbConnection);
}
?>
            </tbody>
         </table>
    </div>

            <!--------------------------Get the total due ---------------------------------------------------------------------->
            <button type="button" id="getTotalButton" onclick="totalDue();">GET TOTAL</button>
            <div id="total"></div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script>
                function totalDue() {
                    var total = 0;
                    var tableElem = window.document.getElementById("cartTable");

                    for (var i = 1; i < tableElem.rows.length; i++)
                    {
                        total = total + parseFloat(tableElem.rows[i].cells[2].innerHTML);
                    }

                    document.getElementById("total").innerHTML = "TOTAL AMOUNT DUE: $ " + total.toString();
                }

            </script>

            <!--------------------------End Get the total due ---------------------------------------------------------------------->
</div>


    </body>
</html>

