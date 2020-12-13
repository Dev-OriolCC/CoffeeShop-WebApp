<?php
    include_once 'include/bootstrapLinks.php';
    // Session
    session_start();
    include_once 'sessionUser.php';
    // Use function fetch data
    include_once 'include/product.php';
    require_once('include/connect.php');

    if ($idUser == null) {
        header('location: login_register.php');
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite</title>
    <link rel="stylesheet" href="css/favorite.css">
</head>
<body>
    
<?php include_once "components/header.php";
    ?>
        <!-- TABLE WITH CLIENT'S COFFEE -->
        <div class="table-responsive-sm table-responsivew-md mt-3" align="center">
        <div class="bg-success col-7 col-sm-4" align="center">
            <p><?php echo $userName; ?> Favorite List</p>
        </div>
        <table class="bg-dark text-white">
            <?php

                $SQL_Search = "SELECT * FROM favorito 
                INNER JOIN producto ON favorito.Producto_ID = producto.Prod_ID 
                WHERE Cliente_ID = $idUser";
                $favUser = CoffeeData($SQL_Search, $connection);

                // PRINT ARRRAY FOR HELP
                //print_r($favUser);
                // Get the total Fav Number
                
                if ($favUser == true) {
                    $userFavorite = count($favUser);
                    for ($i=0; $i <$userFavorite; $i++) { 
            ?>
                <tr>
                    <td class=" px-3"><img src="<?php echo $favUser[$i]['Prod_Imagen1']; ?>" width="60" height="60"></td>
                    <td class=" px-5"><?php echo $favUser[$i]['Prod_Nombre']; ?></td>
                    <!-- CREATE DELETE PAGE AND CONDITION FOR PAGE VARIABLE FROM LINK -->
                    <td class=" px-5"><a href="coffeeDeleted.php?id=<?php echo $favUser[$i]['Fav_ID']; ?>&page=fav" target="_blank" type="submit" name="<?php echo 'fav'.$i; ?>" class="btn">Delete</a></td>
                    <td class=" px-5"><a href="cartAdded.php?id=<?php echo $favUser[$i]['Prod_ID']; ?>" target="_blank" type="submit" name="<?php echo 'prodCart'.$i;?>" class="btn">Add to Cart</a></td>
                    <td class=" px-5"><button class="btn" data-toggle="modal" data-target="<?php echo '#prodModal'.$i; ?>">View</button></td>
                </tr>
                <!-- Modal Window -->
                <div class="modal fade" id="<?php echo 'prodModal'.$i; ?>" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $favUser[$i]['Prod_Nombre']; ?> Coffee 🙂☕</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div align="center">
                                    <h5>Information</h5>
                                </div>
                                <p class="modal-sub">Price: <span class="text-dark">$<?php echo $favUser[$i]['Prod_Precio']; ?>.00</span></p>
                                <p class="modal-sub">Code: <span class="text-dark"><?php echo $favUser[$i]['Prod_Codigo']; ?></span></p>
                                <p class="modal-sub">Specs: <span class="text-dark"><?php echo $favUser[$i]['Prod_Carac']; ?></span></p>
                                <p class="modal-sub">Size: <span class="text-dark"><?php echo $favUser[$i]['Prod_Size']; ?> ml</span></p>
                                <p class="modal-sub">Image Two</p>
                                <p class="modal-sub">Image Three</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                    } //END FOR 
                } else{
                    echo "<tr><td>No Coffees found 😓😔!</td></tr>";
                }
            ?>
        </table> 
    </div><!-- END OF CLIENT CART -->
    <div align="center" class="mt-2 mb-2"> <!-- SECTION FOR BUTTONS-- STORE VARIABLE FROM SQL TEST-->
        <?php
            if ($favUser == false) {
        ?>
            <button class="btn btn-success" onclick="location.href='menu.php'">Search for Coffees</button>
        <?php
            } 
        ?>
    </div>
</body>
<?php include_once 'components/footer.php'; ?>
</html>