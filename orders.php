<?php
    include_once 'include/bootstrapLinks.php';
    // Session
    session_start();
    include_once 'sessionUser.php';
    // Use function fetch data
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
    <title>Orders</title>
    <link rel="stylesheet" href="css/orders.css">
</head>
<body>
    <?php include_once "components/header.php";
    ?>
    <div class="table-responsive-sm table-responsivew-md mt-3" align="center">
        <div class="bg-success col-7 col-sm-4" align="center">
            <p><?php echo $userName; ?>`s Orders</p>
        </div>
        <table class="bg-dark text-white">
            <?php
                $SQL_SearchO = "SELECT * FROM orden WHERE Orden_Cliente = $idUser";
                $OrderUser = CoffeeData($SQL_SearchO, $connection);
                // Get Data from Order Table NOW 
                //echo $OrderUser[0]["Orden_ID"];

                if ($OrderUser == true) {
                    $numOrder = count($OrderUser);
                    for ($i=0; $i <$numOrder ; $i++) {
                        $UserArray = UserInfo($idUser, $connection);
                        $name = $UserArray[0]['C_Nombre'];
                        $lastName = $UserArray[0]['C_ApellidoP'];
                        $finalName = $UserArray[0]['C_ApellidoM']
            ?>
                <tr>
                    <td class="px-5" style="padding: 20px;"><strong class="text-success">Order:</strong> # <?php echo $i+1; ?></td>
                    <td class="px-5"><strong class="text-success">Date:</strong> <?php echo $OrderUser[$i]['Orden_Fecha']; ?></td>
                    <td class="px-5"><strong class="text-success">Status:</strong> <?php echo $OrderUser[$i]['Orden_Estado']; ?></td>
                    <td class=" px-5"><button class="btn" data-toggle="modal" data-target="<?php echo '#orderModal'.$i; ?>">Order Details</button></td>
                    <td class=" px-5"><button class="btn" data-toggle="modal" data-target="<?php echo '#prodModal'.$i; ?>">Order Products</button></td>
                </tr>
                <!-- Modal ORDER DETAILS-->
                <div class="modal fade" id="<?php echo 'orderModal'.$i; ?>" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $userName; ?>`s Order 🙂☕</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div align="center">
                                    <h5>Information</h5>
                                </div>
                                <p class="modal-sub text-success"><b>Status:</b> <span class="text-dark"><?php echo $OrderUser[$i]['Orden_Estado']; ?></span></p>
                                <p class="modal-sub text-success"><b>Total:</b> <span class="text-dark">$<?php echo $OrderUser[$i]['Orden_Total']; ?>.00</span></p>
                                <p class="modal-sub text-success"><b>Client:</b> <span class="text-dark"><?php echo $name.' '.$lastName.' '.$finalName ?></span></p>
                                <p class="modal-sub text-success"><b>Payment:</b> <span class="text-dark"><?php echo $OrderUser[$i]['Orden_Pago']; ?></span></p>
                                <p class="modal-sub text-success"><b>Date:</b> <span class="text-dark"><?php echo $OrderUser[$i]['Orden_Fecha']; ?></span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal ORDER PRODUCTS-->
                <div class="modal fade" id="<?php echo 'prodModal'.$i; ?>" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $userName; ?>`s Order 🙂☕</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div align="center">
                                    <h5>Information</h5>
                                </div>
                                <?php
                                    $orderID = $OrderUser[$i]['Orden_ID'];
                                    $SQL_SearchProd = "SELECT * FROM ordentable
                                    INNER JOIN producto ON ordentable.Producto_ID = producto.Prod_ID
                                    WHERE Orden = $orderID";
                                    $prodData = CoffeeData($SQL_SearchProd, $connection);
                                    //print_r($prodData);
                                    if ($prodData == true) {
                                        $prodNum = count($prodData);
                                        for ($k=0; $k <$prodNum; $k++) { 
                                    ?>
                                    <p>Coffee #<?php echo $k+1 ?></p>
                                    <img src="<?php echo $prodData[$k]['Prod_Imagen1']; ?>" width="60" height="60">
                                    <p class="modal-sub text-success"><b>Coffee:</b> <span class="text-dark"><?php echo $prodData[$k]['Prod_Nombre']; ?></span></p>
                                    <p class="modal-sub text-success"><b>Price:</b> $<span class="text-dark"><?php echo $prodData[$k]['Prod_Precio']; ?>.00</span></p>
                                    <p class="modal-sub text-success"><b>Code:</b> <span class="text-dark"><?php echo $prodData[$k]['Prod_Codigo']; ?></span></p>
                                    <p class="modal-sub text-success"><b>Size:</b> <span class="text-dark"><?php echo $prodData[$k]['Prod_Size']; ?>ml</span></p>
                                    <hr>
                                    <?php
                                        }

                                    }else{
                                        echo "<p>ERROR NOT FOUND</p>";
                                    }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                    } // END FOR
                }
            ?>
        </table>

    </div><br><br>

</body>

    

    <?php include_once 'components/footer.php'; ?>
</html>