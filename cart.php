<?php
    include_once 'include/bootstrapLinks.php';
    // Session
    session_start();
    include_once 'sessionUser.php';
    //
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
    <title>Cart</title>
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <?php include_once "components/header.php";
    ?>
    <!-- TABLE WITH CLIENT'S COFFEE -->
    <div class="table-responsive-sm table-responsivew-md mt-3" align="center">
        <div class="bg-success col-7 col-sm-4" align="center">
            <p><?php echo $userName; ?> Coffee Cart</p>
        </div>
        <table class="bg-dark text-white">
            <?php 
                $SQL_SearchCart = "SELECT * FROM carrito 
                INNER JOIN producto ON carrito.Producto_ID = producto.Prod_ID
                WHERE Cliente_ID = $idUser";

                $cartUser = CoffeeData($SQL_SearchCart, $connection);
                if ($cartUser == true) { 
                    $numCart = count($cartUser);
                    for ($i=0; $i <$numCart; $i++) { 
            ?>
                <tr>
                    <td class="px-3"><img src="<?php echo $cartUser[$i]['Prod_Imagen1']; ?>" width="60" height="60"></td>
                    <td class="px-5"><?php echo $cartUser[$i]['Prod_Nombre']; ?></td>
                    <td class="px-5"><a href="coffeeDeleted.php?id=<?php echo $cartUser[$i]['Car_ID']; ?>&page=cart" target="_blank" type="submit" name="<?php echo 'cart'.$i; ?>" class="btn">Delete</a></td>
                </tr>
            <?php
                }  // END FOR  
        } else{
                echo "<tr><td>No Coffees Here!</td></tr>";
            }
            ?>
        </table> 
    </div><!-- END OF CLIENT CART -->
    <div align="center"> <!-- SECTION FOR BUTTONS-- STORE VARIABLE FROM SQL TEST-->
        <?php
            if ($cartUser == true) {
        ?>
        <button class="btn btn-success">Order Now</button>
        <?php
            } else{
        ?>
            <button class="btn btn-success" onclick="location.href='menu.php'">Search for Coffees</button>
        <?php     
            }
        ?>
    </div>

</body>
<?php include_once 'components/footer.php'; ?>

</html>