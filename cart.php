<?php
    include_once 'include/bootstrapLinks.php';
    // Session
    session_start();
    include_once 'sessionUser.php';

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
        <table>
            <?php 
                $userCart = 1;
                if ($userCart >0) { 
            ?>
                <tr>
                    <div class="row">
                        <td class="bg-dark px-3"><img src="img/latte.png" width="60" height="60"></td>
                        <td class="bg-dark text-white px-5">Latte</td>
                        <td class="bg-dark text-white px-5"><button style="border-radius: 5px;" class="btn-danger">Delete</button></td>
                    </div>
                </tr>
            <?php } else{
                echo "<tr><td>No Coffees Here!</td></tr>";

            }
            ?>
        </table> 
    </div><!-- END OF CLIENT CART -->
    <div align="center"> <!-- SECTION FOR BUTTONS-- STORE VARIABLE FROM SQL TEST-->
        <?php
            if ($userCart >0) {
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