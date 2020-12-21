<?php
require_once('include/connect.php');
include_once 'include/product.php';
include_once 'include/bootstrapLinks.php';
// Session
session_start();
if (isset($_SESSION['id'])) {
    $idUser = $_SESSION['id'];
    $userName = $_SESSION['name'];
    $userDate = $_SESSION['date'];
}
// Validate
if ($idUser == null) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bg-dark">
    <div class="row">
        <div class="col-12" align="center">
            <h2 class="text-white">Welcome back <?php echo $userName; ?> 😃!</h2>
        </div>
        <!-- CREATE - DELETE - EDIT  = PRODUCT -->
        <div class="table-responsive-sm table-responsivew-md mt-3 col-12 col-sm-6" align="center">
            <p class="text-white">All Products</p>
            <table class="bg-dark text-white">
                <?php 
                    $SQL_Prod = "SELECT * FROM producto";
                    $dataProd = CoffeeData($SQL_Prod, $connection);
                    if ($dataProd == true) {
                        $numProd = count($dataProd);
                    }
                ?>
            </table>
        </div>

        <!-- CREATE - DELETE - EDIT  = USER -->
        

        <!-- CREATE ADMIN -->



        <div class="col-12" align="center">
            <a href="logout.php" class="btn btn-success">LOGOUT</a>
        </div>
    </div>

    <?php
        
    ?>

</body>
</html>