<?php
    include_once 'include/bootstrapLinks.php';
    session_start();
    include_once 'sessionUser.php';
    // Coffee Data
    include_once 'include/product.php';

    require_once('include/connect.php');
    // Coger el id
    $prodID = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Added</title>
</head>
<body class="bg-dark">
    <div class="row">
    <?php 
        if ($idUser != null) {
    ?>
        <div align="center" class="col-sm-12 col-12">
            <h3 class="text-white">Coffee added Successfully!</h3><br>
            <img src="img/coffeeLove.png" alt="cartPNG" width="180px" height="180px">
            <?php
            // Get the data of the Coffee (Product)
                $ID = $prodID;
                $SQL = "SELECT * FROM producto WHERE Prod_ID = $ID";
                $result = mysqli_query($connection, $SQL) or die(mysqli_error($connection));
                $numResult = mysqli_num_rows($result);
                if ($numResult != 0) {
                    $data = mysqli_fetch_row($result);
                } else{
                    header('location: index.php');
                }
                 // INSERT INTO FAV
                 $SQL_InsertFav = "INSERT INTO favorito (Fav_ID, Cliente_ID, Producto_ID) VALUES ('', $idUser, '$ID')";
                 $insertResult= mysqli_query($connection, $SQL_InsertFav) or die(mysqli_error($connection));
                    
                ?>
                <p class="text-white"><span class="text-success"><?php echo $data[1]; ?> Coffee</span> is now in you're Favourite List💗!</p>
            </div>
        <?php
            }else{
                ?>
                <div align="center" class="col-sm-12 col-12">
                    <h3 class="text-white">Please Login/Register for this function</h3><br>
                    <img src="img/coffeeSad.png" alt="sadPNG" width="150px" height="150px"><br>
                    <a href="login_register.php" class="btn btn-success">Login/Register</a>
                </div>
                <?php
            }
        ?>


    </div>
</body>
</html>