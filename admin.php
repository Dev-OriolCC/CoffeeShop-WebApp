<?php
    require_once 'include/connect.php';
    // Connect to Database and Style Sheet's
    include_once 'include/bootstrapLinks.php';

    $ERROR = NULL;
    //SESION DE USUARIO
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<header align="center" class="bg-success">
        <h2>Admin</h2>
    </header>
<body class="bg-dark">
    <main class="col-12 col-sm-12"> <!-- MENU WITH THE FORM -->
    <div id="loginForm">
            <div class="row">
                <form method="POST" action="" class="bg-dark mx-auto col-8 col-sm-4 mt-5">
                    <div class="form-group">
                        <p class="text-white">Username: </p>
                        <input type="text" class="form-control" name="Username" placeholder="Jerry" required>
                    </div> <!-- PASSWORD -->
                    <div class="form-group">
                        <p class="text-white">Password: </p>
                        <input type="password" class="form-control" name="UserPassword"  required>
                    </div>
                    <div align="center">
                        <button type="submit" class="btn btn-success" name="Login">Login</button>
                    </div>
                </form>
            </div>
            <?php
            //  1 == admin -> oriolcesar
            //  2 == oriol -> 123
             // CODE FOR LOGIN
             if (isset($_POST['Login'])) {
                // Get the values from FORM
                $uName = mysqli_real_escape_string($connection, $_POST['Username']);
                $uPassword = mysqli_real_escape_string($connection, $_POST['UserPassword']);
                //
                $SQL_Login = "SELECT * FROM admin WHERE A_User='$uName'";
                $UserResult = mysqli_query($connection, $SQL_Login);
                $Result = mysqli_num_rows($UserResult);
                if ($Result >0) {
                    $User = mysqli_fetch_assoc($UserResult); //This
                    $Hash = password_verify($uPassword, $User['A_Password']);
                    if ($Hash) {
                        // GET DATA FROM DB
                        $_SESSION['id'] = $User['A_ID'];
                        $_SESSION['name'] = $User['A_User'];
                        $_SESSION['date'] = $User['A_Date'];

                        // Finally Redirect to Home (index.php)
                        header('location: admin.panel.php');
                    }else{
                        echo 'ERROR HASH';
                    }

                }else {
                    echo 'Fatal Error D:';
                }


            }
        ?>
        </div>
    </main>
    
</body>
</html>