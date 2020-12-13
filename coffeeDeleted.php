<?php
    include_once 'include/bootstrapLinks.php';
    session_start();
    include_once 'sessionUser.php';
    // Coffee Data
    include_once 'include/product.php';

    require_once('include/connect.php');
    // Coger el id
    $tabID = $_GET['id'];
    $pageID = $_GET['page'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Deleted</title>
</head>
<body class="bg-dark text-white">
    <div class="row">
        <div align="center" class="col-12 col-sm-12">
        <?php 
            if ($idUser != null && $pageID == 'fav' && $tabID != null) {
                $SQL_Delete = "DELETE FROM favorito WHERE Fav_ID = $tabID AND Cliente_ID = $idUser";
                $result = mysqli_query($connection, $SQL_Delete) or die(mysqli_error($connection));
                DeleteMSG();
            } elseif ($idUser != null && $pageID == 'cart' && $tabID != null) {
                $SQL_Delete = "DELETE FROM carrito WHERE Car_ID = $tabID AND Cliente_ID = $idUser";
                $result = mysqli_query($connection, $SQL_Delete) or die(mysqli_error($connection));
                DeleteMSG();
            } else{
                header('location: index.php');
            }
        ?>

        </div>
    </div>
</body>
</html>
