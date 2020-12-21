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
        <div class="table-responsive-sm table-responsivew-md mt-3 col-12 col-sm-12" align="center">
            <p class="text-white">All Products</p>
            <table class="bg-secondary text-white">
                <?php 
                    $SQL_Prod = "SELECT * FROM producto";
                    $dataProd = CoffeeData($SQL_Prod, $connection);
                    if ($dataProd == true) {
                        $numProd = count($dataProd);
                        for ($i=0; $i <$numProd; $i++) { 
                            ?>
                            <tr >
                                <td class="px-3"><img src="<?php echo $dataProd[$i]['Prod_Imagen1']; ?>" style="width: 60px; height:60px;"></td>
                                <td class="px-5"><?php echo $dataProd[$i]['Prod_Nombre']; ?></td>
                                <td class="px-5"><?php echo $dataProd[$i]['Prod_Codigo']; ?></td>
                                <form action="?<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <td class="px-5"><button type="submit" name="<?php echo 'prod'.$i; ?>" class="btn btn-danger">Delete</button></td>                   
                                </form>
                                <td class=" px-5"><button class="btn btn-primary" data-toggle="modal" data-target="<?php echo '#prodModal'.$i; ?>">Update</button></td>

                            </tr>
                            <?php
                            // DELETE COFFEE
                            if (isset($_POST['prod'.$i])) {
                                $prodID = $dataProd[$i]['Prod_ID'];
                                if ($idUser != null && $prodID != null) {
                                    $SQL_Delete = "DELETE FROM producto WHERE Prod_ID = $prodID ";
                                    $result = mysqli_query($connection, $SQL_Delete) or die(mysqli_error($connection));
                                }
                            } // END DELETE BTN
                            // UPDATE COFFEE
                            ?>
                            <div class="modal fade" id="<?php echo 'prodModal'.$i; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo $dataProd[$i]['Prod_Nombre']; ?> Coffee</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div align="center">
                                                <h5>Information</h5>
                                            </div>
                                            <p class="modal-sub">Price: <span class="text-dark">$<?php echo $dataProd[$i]['Prod_Precio']; ?>.00</span></p>
                                            <p class="modal-sub">Code: <span class="text-dark"><?php echo $dataProd[$i]['Prod_Codigo']; ?></span></p>
                                            <p class="modal-sub">Specs: <span class="text-dark"><?php echo $dataProd[$i]['Prod_Carac']; ?></span></p>
                                            <p class="modal-sub">Size: <span class="text-dark"><?php echo $dataProd[$i]['Prod_Size']; ?> ml</span></p>
                                            <p class="modal-sub">Image Two</p>
                                            <p class="modal-sub">Image Three</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Update</button>
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } // END FOR
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