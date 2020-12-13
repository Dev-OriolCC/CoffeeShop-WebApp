<?php
    // Archivos de Estilos
    include_once 'include/bootstrapLinks.php';
    include_once 'css/footerStyle.css';
    // Session
    session_start();
    include_once 'sessionUser.php';
    // Coffee Data
    include_once 'include/product.php';

    require_once('include/connect.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/menu2.css">
</head>
<body>
    <?php include_once "components/header.php";
    ?>
    <?php   // Default SQL code.
        $SQL_Prod = 'SELECT * FROM producto';
        $dataProduct = CoffeeData($SQL_Prod, $connection);
        $totalProd = count($dataProduct);
        //
        if(isset($_POST['search'])){
            if(isset($_POST['coffee_1'])) {
                $SQL_Prod = 'SELECT * FROM producto WHERE Prod_Categoria = 300';
            }elseif (isset($_POST['coffee_2'])) {
                $SQL_Prod = 'SELECT * FROM producto WHERE Prod_Categoria = 200';
            }elseif (isset($_POST['coffee_3'])) {
                $SQL_Prod = 'SELECT * FROM producto WHERE Prod_Categoria = 400';
            }elseif (isset($_POST['coffee_4'])) {
                $SQL_Prod = 'SELECT * FROM producto WHERE Prod_Categoria = 100';
            }
            
            $dataProduct = CoffeeData($SQL_Prod, $connection);
            $totalProd = count($dataProduct);
        }

    ?>

    <div class="row">
        <div class="col-12" align="center">
            <h3><?php echo $totalProd ?> Results of Coffees found.</h3>
        </div>
    </div>
    <div class="row">
        <!-- FILTERS -->
        <div class="col-12 col-sm-3">            
            <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                <p class="ml-2 mt-4">Type of Coffee</p>
                <input type="checkbox" id="coffee_1" name="coffee_1" class="ml-3">
                <label for="coffee_1">Cappuccino</label> <br>
                <input type="checkbox" id="coffee_2" name="coffee_2" class="ml-3">
                <label for="coffee_2">Latte</label> <br>
                <input type="checkbox" id="coffee_3" name="coffee_3" class="ml-3">
                <label for="coffee_3">Doppio</label> <br>
                <input type="checkbox" id="coffee_4" name="coffee_4" class="ml-3">
                <label for="coffee_4">American</label> <br>
                <div align="center">
                    <input type="submit" value="Search" name="search" class="btn btn-success">
                </div>

            </form>
        </div>
        <!-- ITEMS -->
        <div class="col-12 col-sm-7">
            <div class="row">
                <?php 
                    
                    for ($i=0; $i < $totalProd; $i++) {
                ?>
                <a type="button" data-toggle="modal" data-target="<?php echo '#prodModal'.$i; ?>">
                    <div class="col-sm-4 mt-4">
                        <div class="thumb-wrapper bg-dark">
                            <div class="thumb-content" align="center" style="color: white;">
                                <h4 ><?php echo $dataProduct[$i]['Prod_Nombre']; ?></h4>
                                    <div class="img-box">
                                        <img src="<?php echo $dataProduct[$i]['Prod_Imagen1'] ?>" width="180" height="150" class="img-responsive" alt="">
                                    </div>
                                <p class="item-price" style="color: green;"><strong>$<?php echo $dataProduct[$i]['Prod_Precio'] ?>.00</strong></p>
                                <div align="center">
                                    <a href="cartAdded.php?id=<?php echo $dataProduct[$i]['Prod_ID']; ?>" target="_blank" type="submit" name="<?php echo 'prodCart'.$i;?>" class="btn btn-success" >Add to Cart</a>
                                    <a href="favAdded.php?id=<?php echo $dataProduct[$i]['Prod_ID']; ?>" target="_blank" type="submit" name="<?php echo 'prodFav'.$i; ?>" class="btn btn-success">Favorite</a>
                                </div>
                            </div>						
                        </div>
                    </div>
                </a>

                <div class="modal fade" id="<?php echo 'prodModal'.$i; ?>" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $dataProduct[$i]['Prod_Nombre']; ?> Coffee 🙂☕</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div align="center">
                                    <h5>Information</h5>
                                </div>
                                <p class="modal-sub">Price: <span class="text-dark">$<?php echo $dataProduct[$i]['Prod_Precio']; ?>.00</span></p>
                                <p class="modal-sub">Code: <span class="text-dark"><?php echo $dataProduct[$i]['Prod_Codigo']; ?></span></p>
                                <p class="modal-sub">Specs: <span class="text-dark"><?php echo $dataProduct[$i]['Prod_Carac']; ?></span></p>
                                <p class="modal-sub">Size: <span class="text-dark"><?php echo $dataProduct[$i]['Prod_Size']; ?> ml</span></p>
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
                // ADD TO CART AND FAVOURITE

                    } //END OF FOR CICLE
                
                ?>
            </div><!-- END ROW -->
        </div>
    </div><br><br>
</body>
    <!-- FOOTER -->
    <?php include_once 'components/footer.php'; 
    ?>
</html>