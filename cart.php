<?php
    include_once 'include/bootstrapLinks.php';
    // Session
    session_start();
    include_once 'sessionUser.php';
    //
    include_once 'include/product.php';
    include_once 'include/user.php';
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
    <link rel="stylesheet" href="css/favorite.css">
</head>
<body>
    <?php include_once "components/header.php";
    ?>
    <div class="row" id="content">
    <!-- TABLE WITH CLIENT'S COFFEE -->
        <div class="table-responsive-sm table-responsivew-md mt-3 col-12 col-sm-6" align="center">
            <div class="text-dark col-7 col-sm-12" align="center">
                <h4><?php echo $userName; ?>'s Coffee Cart</h4>
            </div>
            <table class="bg-dark text-white" id="tabField">
                <?php 
                    $SQL_SearchCart = "SELECT * FROM carrito 
                    INNER JOIN producto ON carrito.Producto_ID = producto.Prod_ID
                    WHERE Cliente_ID = $idUser";

                    $cartUser = CoffeeData($SQL_SearchCart, $connection);
                    if ($cartUser == true) {
                        $totalPrice = 0; 
                        $numCart = count($cartUser);
                        for ($i=0; $i <$numCart; $i++) {
                        $totalPrice += $cartUser[$i]['Prod_Precio'];
                ?>
                    <tr>
                        <td class="px-3"><img src="<?php echo $cartUser[$i]['Prod_Imagen1']; ?>" style="width: 60px; height:60px;"></td>
                        <td class="px-5"><?php echo $cartUser[$i]['Prod_Nombre']; ?></td>
                        <td class="px-5">$<?php echo $cartUser[$i]['Prod_Precio']; ?>.00</td>
                        <form action="?<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <td class="px-5"><button href="coffeeDeleted.php?id=<?php echo $cartUser[$i]['Car_ID']; ?>&page=cart" type="submit" name="<?php echo 'cart'.$i; ?>" class="btn">Delete</button></td>                    
                        </form>
                    </tr>
                <?php
                    // DELETE COFFEE
                    if (isset($_POST['cart'.$i])) {
                        $tabID = $cartUser[$i]['Car_ID'];
                        if ($idUser != null && $tabID != null) {
                            $SQL_Delete = "DELETE FROM carrito WHERE Car_ID = $tabID AND Cliente_ID = $idUser";
                            $result = mysqli_query($connection, $SQL_Delete) or die(mysqli_error($connection));
                ?>
                        <script>
                            document.getElementById("tabField").style.display = "none";
                            document.getElementById("checkField").style.display = "none";
                        </script>
                <?php
                            DeleteMSG();
                        }else{
                            echo 'ERROR ON DELETE';
                        }
                    } //end if delete


                    }  // END FOR  
            } else{
                    echo "<tr><td>No Coffees Here!</td></tr>";
                }
                ?>
            </table><br> 
        </div><!-- END OF CLIENT CART -->
        <div align="left" class="col-12 col-sm-4 bg-light" id="checkField"> <!-- SECTION FOR BUTTONS-- STORE VARIABLE FROM SQL TEST-->
            <?php
                if ($cartUser == true) {
            ?><br>
            <h5 class="ml-3"><strong>Coffees in Cart: <?php echo $numCart; ?> </strong></h5>
            <h5 class="ml-3"><strong>Total Price Coffee: $<?php echo $totalPrice; ?>.00</strong></h5>
            <h5 class="ml-3"><strong>Shipping: <span class="text-success">Free!</span></strong></h5>
            <div align="center">
                <h5><strong>Final Price: <span class="text-success">$<?php echo $totalPrice; ?>.00</span></strong></h5>
                <form action="cart.php" method="POST">
                  <button class="btn btn-success" name="Order" id="Order" type="submit">Order Now</button>  
                </form>
                
            </div>
            <?php
                } else{
            ?>  <br>
                <button class="btn btn-success" onclick="location.href='menu.php'">Search for Coffees</button>
            <?php     
                }
            ?>
        </div>
    </div><br>
    <?php        
        if (isset($_POST['Order'])) {
            $UserArray = UserInfo($idUser, $connection);
            $name = $UserArray[0]['C_Nombre'];
            $lastName = $UserArray[0]['C_ApellidoP'];
            $finalName = $UserArray[0]['C_ApellidoM'];
            $address =  $UserArray[0]['C_Direccion'];
            $phone = $UserArray[0]['C_Numero'];
            
            if ($name !== '' && $lastName !== '' && $finalName !== '' && $address !== '' &&  $phone !== '' ) {
                $SQL_Order = "INSERT INTO orden (Orden_ID, Orden_Total, Orden_Cliente)
                VALUES ('', $totalPrice, $idUser)";
                $Result = mysqli_query($connection, $SQL_Order) or die(mysqli_error($connection));
                // Get the Order ID
                $SQL = "SELECT * FROM orden WHERE Orden_Cliente = $idUser ORDER BY Orden_ID DESC LIMIT 1";
                $orderData = CoffeeData($SQL, $connection);
                $orderID = $orderData[0]['Orden_ID']; // Store ID in Variable
                // Insert into new Table with the product's ID
                for ($i=0; $i <$numCart; $i++) { 
                    $prodID = $cartUser[$i]['Prod_ID']; // get the ID of Product
                    // SQL and INSERT DYNAMIC
                    $SQL_CartProd = "INSERT INTO ordentable (Orden_ID, Orden, Producto_ID, Cliente_ID)
                    VALUES ('', $orderID, $prodID , $idUser) ";
                    mysqli_query($connection, $SQL_CartProd) or die(mysqli_error($connection));
                }
                // AFTER THE SUCCESSFULL INSERT WE CLEAN THE CART
                if ($Result == true) {
                    $SQL_CleanCart = "DELETE FROM carrito WHERE Cliente_ID = $idUser";
                    mysqli_query($connection, $SQL_CleanCart) or die(mysqli_error($connection));
                }
            ?>
            <script>
                document.getElementById("content").style.display = "none";
            </script>
                <div align="center">
                    <h5>Coffee order has been placed Successfully!</h5>
                    <img src="img/coffeeHap.png" alt="coffeeHappy" width="150px" height="150px"><br>
                    <button class="btn" onclick="window.location.href='orders.php'">Orders</button>
                </div>

            <?php
            }else{
            ?>  <div align="center">
                    <p>Please fill all Profile fields to release this order 😉☕.</p>
                    <button class="btn" onclick="window.location.href='profile.php'">Profile</button>
                </div>
            <?php
            }
        }
    ?>
</body>
<?php include_once 'components/footer.php'; ?>

</html>