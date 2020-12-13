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
    <title>Orders</title>
    <link rel="stylesheet" href="css/orders.css">
</head>
<body>
    <?php include_once "components/header.php";
    ?>
    <br><br><br><br><br><br><br><br><br>


</body>

    

    <?php include_once 'components/footer.php'; ?>
</html>