<?php
    session_start();
    // Archivos de Estilos
    include_once 'include/bootstrapLinks.php';
    include_once 'css/footerStyle.css';
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
    <div class="row">
        <div class="col-12" align="center">
            <h3>10 Results of Coffees found.</h3>
        </div>
    </div>
    <div class="row">
        <!-- FILTERS -->
        <div class="col-12 col-sm-3">            
            <form action="<?php $_SERVER['PHP_SELF']?>">
                <p class="ml-2 mt-4">Type of Coffee</p>
                <input type="checkbox" id="#" name="#" class="ml-3">
                <label for="coffee1">Cappuccino</label> <br>
                <input type="checkbox" id="#" name="#" class="ml-3">
                <label for="coffee2">Latte</label> <br>
                <input type="checkbox" id="#" name="#" class="ml-3">
                <label for="coffee3">Doppio</label> <br>
                <input type="checkbox" id="#" name="#" class="ml-3">
                <label for="coffee4">American</label> <br>
                <p class="ml-2">Discounts</p>
                <input type="checkbox" id="#" name="#" class="ml-3">
                <label for="discount1">All discounts</label> <br>
            </form>
        </div>
        <!-- ITEMS -->
        <div class="col-12 col-sm-9">
            <div class="row">
                <?php 
                    for ($i=1; $i <=10 ; $i++) {
                ?>
                <a href="#">
                    <div class="col-sm-4 mt-4">
                        <div class="thumb-wrapper bg-dark">
                            <div class="img-box">
                                <img src="#" class="img-responsive" alt="">
                            </div>
                            <div class="thumb-content" align="center">
                                <h4 >Coffee American</h4>
                                <p class="item-price">$89.00</p>
                                <a href="#" class="btn btn-primary" >Add to Cart</a>
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