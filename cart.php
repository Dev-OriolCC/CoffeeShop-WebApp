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
            <table class="bg-dark text-white">
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
                        <td class="px-5"><a href="coffeeDeleted.php?id=<?php echo $cartUser[$i]['Car_ID']; ?>&page=cart" target="_blank" type="submit" name="<?php echo 'cart'.$i; ?>" class="btn">Delete</a></td>
                    </tr>
                <?php
                    }  // END FOR  
            } else{
                    echo "<tr><td>No Coffees Here!</td></tr>";
                }
                ?>
            </table><br> 
        </div><!-- END OF CLIENT CART -->
        <div align="left" class="col-12 col-sm-4 bg-light"> <!-- SECTION FOR BUTTONS-- STORE VARIABLE FROM SQL TEST-->
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
                $date = date('c');
                $ID = $cartUser[0]['Prod_ID'];//
                // CREATE FOR LOOP TO INSERT THE PRODUCTS IN NEW TABLE WITH ID OF ORDER 
                // TO HAVE A BACKUP

                $SQL_Order = "INSERT INTO orden (Orden_ID, Orden_Pago, Orden_Total, Orden_Cliente, Orden_Fecha)
                VALUES ('', 'Cash Delivered', $totalPrice, $idUser, '')
                ";
                $Result = mysqli_query($connection, $SQL_Order) or die(mysqli_error($connection));
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
                    <p>Please fill all fields to release this order 😉☕.</p>
                    <button class="btn" onclick="window.location.href='profile.php'">Profile</button>
                </div>
            <?php
            }
        }
    ?>
</body>
<?php include_once 'components/footer.php'; ?>

</html>