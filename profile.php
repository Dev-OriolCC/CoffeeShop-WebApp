<?php
    require_once 'include/connect.php';

    include_once 'include/bootstrapLinks.php';
    include_once 'css/footerStyle.css';
    // Session
    session_start();
    include_once 'sessionUser.php';

    if ($idUser == null) {
        header('location: login_register.php');
    }else{
        $SQL_User = "SELECT C_Nombre, C_ApellidoP, C_ApellidoM, C_CorreoE, C_UserName, C_Direccion, C_Genero, C_Numero FROM cliente WHERE C_ID = '$idUser'";
        $resultUser = mysqli_query($connection, $SQL_User) or die(mysqli_error($connection));
        $numberUser = mysqli_num_rows($resultUser);
        // Store the data in the Array
        if ($numberUser != 0) {
            $dataUser = mysqli_fetch_row($resultUser);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <?php include_once "components/header.php";
    ?>
    <div class="bg-light">
        <div class="row">
            <div class="col-4" align="center">
                <img src="img/express.png" height="60px" width="60px">
                <p><?php echo $dataUser[4]; ?></p>
            </div>
            <div class="col-8">
                <form action="" method="post">
                    <div class="form-group"><!--NAME -->
                        <p class="text-black">First Name:</p>
                        <input type="text" class="col-10 col-sm-6 "class="form-control" name="Name" value="<?php echo $dataUser[0]; ?>">
                    </div>
                    <div class="form-group"><!--LAST NAME -->
                        <p class="text-black">Last Name:</p>
                        <input type="text" class="col-10 col-sm-6 "class="form-control" name="LastName" value="<?php echo $dataUser[1]; ?>">
                    </div>
                    <div class="form-group"><!--FINAL NAME -->
                        <p class="text-black">Final Name:</p>
                        <input type="text" class="col-10 col-sm-6 "class="form-control" name="FinalName" value="<?php echo $dataUser[2]; ?>">
                    </div>
                    <div class="form-group"><!--EMAIL -->
                        <p class="text-black">Email:</p>
                        <input type="email" class="col-10 col-sm-6 "class="form-control" name="Email" value="<?php echo $dataUser[3]; ?>">
                    </div>
                    <div class="form-group"><!--USERNAME -->
                        <p class="text-black">User Name:</p>
                        <input type="text" class="col-10 col-sm-6 "class="form-control" name="UserName" value="<?php echo $dataUser[4]; ?>">
                    </div>
                    <div class="form-group"><!--ADDRESS -->
                        <p class="text-black">Address:</p>
                        <input type="text" class="col-10 col-sm-6 "class="form-control" name="Address" value="<?php echo $dataUser[5]; ?>">
                    </div>
                    <div class="form-group"><!--GENDER -->
                        <p class="text-black">Gender:</p>
                        <input type="text" class="col-10 col-sm-6 "class="form-control" name="Gender" value="<?php echo $dataUser[6]; ?>">
                    </div>
                    <div class="form-group"><!--PHONE -->
                        <p class="text-black">Phone:</p>
                        <input type="text" class="col-10 col-sm-6 "class="form-control" name="Phone" value="<?php echo $dataUser[7]; ?>">
                    </div>
                    <!-- BUTTON -->
                    <button class="mt-3 btn btn-success" name="UpdateUser">Update Info</button>
                </form>
                <?php 
                    if (isset($_POST['UpdateUser'])) {
                        // Sanitize our Data before UPDATE DB 
                        $name = mysqli_real_escape_string($connection, $_POST['Name']);
                        $lastName = mysqli_real_escape_string($connection, $_POST['LastName']);
                        $finalName = mysqli_real_escape_string($connection, $_POST['FinalName']);
                        $email = mysqli_real_escape_string($connection, $_POST['Email']);
                        $userName = mysqli_real_escape_string($connection, $_POST['UserName']);
                        $address = mysqli_real_escape_string($connection, $_POST['Address']);
                        $gender = mysqli_real_escape_string($connection, $_POST['Gender']);
                        $phone = mysqli_real_escape_string($connection, $_POST['Phone']);
                        // SQL
                        $SQL_Update = "UPDATE cliente SET C_Nombre = '$name', C_ApellidoP = '$lastName', C_ApellidoM = '$finalName', C_CorreoE = '$email', 
                        C_UserName = '$userName', C_Direccion = '$address', C_Genero = '$gender', C_Numero = '$phone'
                        WHERE C_ID = '$idUser' ";
                        $Update = mysqli_query($connection, $SQL_Update);
                    }
                
                ?>
            </div>
        </div><!-- ROW -->
    </div>
</body>

    <?php include_once 'components/footer.php'; ?>
</html>