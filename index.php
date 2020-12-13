<?php
include_once 'include/bootstrapLinks.php';
// Session
session_start();
include_once 'sessionUser.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="icon" href="img/iconPage.png" type="image/png" size="64x64">
    <!-- CSS files-->
    <link rel="stylesheet" href="css/home.css">
    <!-- JAVA SCRIPT-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- HEADER -->
    <?php include_once 'components/header.php'; ?>

    <!-- SLIDER WITH BANNERS -->
    <?php include_once 'components/sliderBanner.php'; 
    ?>

    <!-- SLIDER BEST PRODUCTS -->
    <?php include_once 'components/sliderTop.php';
    ?>
    <script src="js/script.js"></script>
    <!-- SEE MORE -->
    <div class="row">
        <div class="col-12" align="center">
            <h4>Discover our full menu of coffee</h4>
            <a href="menu.php"><button class="btn btn-dark">Go to Menu</button></a>
        </div>
    </div><br>

    <!-- INFORMATION & GOOGLE MAP -->
    <div class="row">
        <div class="col-md-6 col-12">
            <p class="ml-4"><b>About Oriol's Coffee</b><br>
            <div class="row">
                <div class="col-6">
                    <p class="ml-4" style="text-align: justify;">
                        Starbucks Corporation is an American multinational chain of coffeehouses and roastery reserves headquartered in Seattle, Washington. As the world's largest
                        coffeehouse chain, Starbucks is seen to be the main representation of the United States' second wave of coffee culture. 
                    </p>
                </div>
                <div class="col-5 mx-auto">
                    <img src="https://thehalalinvestor.co.uk/wp-content/uploads/2020/07/man_5-512.png"
                    style="border: 2px solid black; border-radius: 50%;" width="150" height="150">
                    <p><b>Oriol Cortez Cesar</b> <br> -Founder of Oriol's Coffee</p>
                </div>
                </p>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <p><b>Our Location 🌎🚩</b></p>
            <div class="map-responsive">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1001.1156971838826!2d-88.38955412278675!3d18.677022387739758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5bb1399bb9a5ad%3A0x68459b3cd0c64df8!2zWsOzY2Fsbw!5e0!3m2!1ses!2smx!4v1606964787652!5m2!1ses!2smx" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <style>
                .map-responsive{
                    overflow:hidden;
                    padding-bottom:56.25%;
                    position:relative;
                    height:0;
                }
                .map-responsive iframe{
                    left:0;
                    top:0;
                    height:100%;
                    width:100%;
                    position:absolute;
                }
            </style>
        </div>
    </div> <!-- END OF INFORMATION & LOCATION -->
</body>
<!-- FOOTER -->
<?php include_once 'components/footer.php'; ?>
</html>