<?php
//Author: Ajith V Keerikkattil
//updated: 10/29/2019

session_start();
include 'dbConnection.php';
$_SESSION['productNameField'] = null;

$keyword = $_GET["q"];

if (strlen($keyword) > 0) {
    getSearchProducts($servername, $username, $password, $db, $keyword);
} else {
    getAllProducts($servername, $username, $password, $db);
}

?>
    <html>
    <head>
        <title>
            CaffeineIOT HomePage
        </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>
    </head>

<?php
function getSearchProducts($servername, $username, $password, $db, $keyword)
{
    $dbConnection = mysqli_connect($servername, $username, $password, $db);

    $query = "SELECT * FROM products WHERE productName LIKE '%$keyword%' LIMIT 5";

    $result = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($result) >= 0) {
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['productNameField'] = $row['productName'];
            ?>
            <div class="productItem">
                <div class="productDesc" style="background-color: #aaaaaa">
                    <table>
                        <tr>
                            <td><a href=" productDetails.php?productName=<?php echo $row['productName'] ?>"><img
                                            src="<?php echo 'images/' . $row['productImage']; ?>" width="200px" height="100px"></td>
                            <td> &nbsp;&nbsp;<?php echo $row['productName']; ?> &nbsp;&nbsp;</td>
                            <td><?php echo "$ " .$row['productPrice']; ?> </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
        }
    }
}

function getAllProducts($servername, $username, $password, $db)
{
    $dbConnection = mysqli_connect($servername, $username, $password, $db);

    $query = "SELECT * FROM products";

    $result = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($result) >= 0) {
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="productItem">
                <div class="productDesc" style="background-color: #aaaaaa">
                    <table>
                        <tr>
                            <td><a href=" productDetails.php?productName=<?php echo $row['productName'] ?>"><img
                                            src="<?php echo 'images/' . $row['productImage']; ?>" width="200px" height="100px"></td>
                            <td>&nbsp;&nbsp; <?php echo $row['productName']; ?> &nbsp;&nbsp;</td>
                            <td><?php echo "$ " .$row['productPrice']; ?> </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
        }
    }
}

?>