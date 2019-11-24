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
            h2, table, h3{
                font-family: Bungee;
                font-size: x-large;
            }

            #total{
                text-align: right;
                font-size: x-large;
            }

            button {
                font-size: large;
                font-family: Bungee;
            }

            #displayShippingAddress{
                padding-left: 25%;
                font-size: large;
            }

            #purchaseButtonDIV{
                padding-left: 65%;
            }

            #addShippingAddress{
                font-size: xx-large;
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
           <a href="homeLandingPagePost.php">Not done shopping? Click here to add more items....</a><br> <br>
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

                    document.getElementById("payPalButton").elements[4].value = total;
                }

            </script>

            <!--------------------------End Get the total due ---------------------------------------------------------------------->
</div>

        <?php

        function getShippingAddress($servername, $username, $password, $db)
        {

            $shippingStreet = null; $shippingCounty= null; $shippingState= null; $shippingZip= null;
            $dbConnection = mysqli_connect($servername, $username, $password, $db);

            $customerEmail = $_SESSION["email"];

            $query = "SELECT * FROM customerDetails WHERE email = '$customerEmail'";

            $result = mysqli_query($dbConnection, $query);

            if (mysqli_num_rows($result) >= 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $shippingStreet = $row['street'];
                    $shippingCounty = $row['county'];
                    $shippingState = $row['state'];
                    $shippingZip = $row['zip'];
                }
            }
        ?>
        <div>
            <div id="ShippingAddress">
                    <h3 align="center">Shipping Address</h3>
                    <form id="displayShippingAddress">
                        <div class="form-group w-50">
                            <label for="Street">Street Name:</label>
                            <input class="form-control" type="text" name="Street" value="<?php echo $shippingStreet; ?>"> <br>
                        </div>

                        <div class="form-group w-25">
                            <label for="County">County:</label>
                            <input class="form-control" type="text" name="County" value="<?php echo $shippingCounty; ?>" > <br>
                        </div>

                        <div class="form-group w-25">
                            <label for="State">State:</label>
                            <input class="form-control" type="text" name="State" value="<?php echo $shippingState; ?>" > <br>
                        </div>

                        <div class="form-group w-25">
                            <label for="Zip">Zip Code:</label>
                            <input class="form-control" type="text" name="Zip" value="<?php echo $shippingZip; ?>" > <br>
                        </div>
                </form>
            </div>
        </div>

        <!-----------------------------------------------------PayPal Button------------------------------------------------------------->
        <div id ="purchaseButtonDIV">
            <div class = "paypal" id ="paypal">
                <!--Paypal Button -->
                <form target="_self" id="payPalButton" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="ajikee1@yopmail.com">
                    <input type="hidden" name="lc" value="US">
                    <input type="hidden" name="item_name" value="smartDevicePurchase">
                    <input type="hidden" name="amount" value="">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="button_subtype" value="services">
                    <input type="hidden" name="no_note" value="0">
                    <input type="hidden" name="cn" value="Add special instructions to the seller:">
                    <input type="hidden" name="no_shipping" value="2">
                    <input type="hidden" name="custom" id="custom" value="<?php echo $_SESSION["cafUserName"]; echo " "; echo $_SESSION["email"];?> ">
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                    <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="Check out with PayPal" />
                    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>

                <script>
                  //  var amnt = document.getElementById("payPalButton").elements[4].value;

                  //  document.getElementById("test").innerHTML = amnt;
                </script>
                <p> Note: You will be redirected to the PayPal © website for payment processing. <br/>Once complete, you will be redirected back to Caffeine </p>
            </div>
        </div>

            <!-----------------------------------------------------End PayPal Button------------------------------------------------------------->

            <?php
        mysqli_free_result($result);
        mysqli_close($dbConnection);
        }

        getShippingAddress($servername, $username, $password, $db);

        ?>

    </body>
</html>

