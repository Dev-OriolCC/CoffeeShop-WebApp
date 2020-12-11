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
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
    <?php include_once "components/header.php";
    ?>
    <?php
        $SQL_Prod = 'SELECT * FROM producto';
        $dataProduct = CoffeeData($SQL_Prod, $connection);
        $totalProd = count($dataProduct);
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
        <?php
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
        
        <div class="col-12 col-sm-9">
            <div class="row">
                <?php 
                    
                    for ($i=0; $i < $totalProd; $i++) {
                ?>
                <a href="#">
                    <div class="col-sm-4 mt-4">
                        <div class="thumb-wrapper bg-dark">
                            <div class="thumb-content" align="center">
                                <h4 ><?php echo $dataProduct[$i]['Prod_Nombre']; ?></h4>
                                    <div class="img-box">
                                        <img src="<?php echo $dataProduct[$i]['Prod_Imagen1'] ?>" width="180" height="150" class="img-responsive" alt="">
                                    </div>
                                <p class="item-price">$<?php echo $dataProduct[$i]['Prod_Precio'] ?>.00</p>
                                <a href="#" class="btn btn-primary" >Add to Cart</a>
                                <a href="#" class="btn btn-primary">Favorite</a>
                            </div>						
                        </div>
                    </div>
                </a>
                <?php
                    }
                ?>
            </div>
        </div>

    </div>

</body>
    <!-- FOOTER -->
    <?php include_once 'components/footer.php'; 
    ?>
</html>