<?php
    require_once 'include/connect.php';
    // Connect to Database and Style Sheet's
    include_once 'include/bootstrapLinks.php';
    include_once 'css/footerStyle.css';

    $ERROR = NULL;
    //SESION DE USUARIO
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="css/login2.css">
</head>
    <header align="center" class="bg-success">
        <h2>Oriol's Coffee</h2>
    </header>
<body class="bg-dark">
    <main class="col-12 col-sm-12"> <!-- MENU WITH THE FORM -->
        <!-- LOGIN -->
        <div style="display: block;" id="loginForm">
            <div class="row">
                <form method="POST" action="" class="bg-dark mx-auto col-8 col-sm-4 mt-5">
                    <div class="form-group">
                        <p class="text-white">Email: </p>
                        <input type="text" class="form-control" name="UserEmail" placeholder="Example@gmail.com" required>
                    </div> <!-- PASSWORD -->
                    <div class="form-group">
                        <p class="text-white">Password: </p>
                        <input type="password" class="form-control" name="UserPassword"  required>
                    </div>
                    <div align="center">
                        <button type="submit" class="btn btn-success" name="NewLogin">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div align="center">
            <h4 id="register" class="text-white">Register</h4>
        </div>
        <?php   // CODE FOR LOGIN
            if (isset($_POST['NewLogin'])) {
                // Get the values from FORM
                $Email = mysqli_real_escape_string($connection, $_POST['UserEmail']);
                $Password = mysqli_real_escape_string($connection, $_POST['UserPassword']);
                //

                $SQL_Login = "SELECT C_ID, C_UserName, C_Password FROM cliente WHERE C_CorreoE='$Email'";
                $UserResult = mysqli_query($connection, $SQL_Login);
                $Result = mysqli_num_rows($UserResult);
                if ($Result >0) {
                    $User = mysqli_fetch_assoc($UserResult); //This
                    $Hash = password_verify($Password, $User['C_Password']);

                    if ($Hash) {
                        // GET DATA FROM DB
                        $_SESSION['id'] = $User['C_ID'];
                        $_SESSION['userName'] = $User['C_UserName'];
                        // Finally Redirect to Home (index.php)
                        header('location: index.php');
                    }else{
                        echo 'ERROR HASH';
                    }

                }else {
                    echo 'Fatal Error D:';
                }


            }


        ?>
        <!-- END LOGIN -->
        <script> //Here a few of Javascript
            document.getElementById("register").onclick = function() {register2 ()};
            function register2(){
                document.getElementById("register").style.display = "none";
                document.getElementById("registerUser").style.display = "block"; //Yes
                document.getElementById("login").style.display = "block"; //NEW
                document.getElementById("loginForm").style.display = "none"; //Yes
            }
        </script>

        <!-- REGISTER -->
        <div style="display: none;" id="registerUser">
            <div class="row">
                <form action="" method="POST" class="bg-dark mx-auto col-8 col-sm-4 mt-5"">
                    <div class="form-group">
                        <p class="text-white">Email: </p>
                        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <p class="text-white">Username: </p>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <p class="text-white">Password: </p>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <p class="text-white">Confirm Password: </p>
                        <input type="password" class="form-control" name="password_2" required>
                    </div>
                    <div align="center">
                        <button type="submit" class="btn btn-success" name="NewUser">Register</button>
                    </div>
                </form>
            </div>
        </div>
        <div align="center">
            <h4 id="login" class="text-white" style="display: none;">Login</h4>
        </div>
        <script>
            // Validate if passwords are not equal!
            var password = document.getElementById("password"), confirm_password = document.getElementById("password_2");
                function validatePassword(){
                    if(password.value != confirm_password.value) {
                        confirm_password.setCustomValidity("Passwords are not equal 😓...");
                    } else {
                        confirm_password.setCustomValidity('');
                    }
                }
            // Dynamic Button
            document.getElementById("login").onclick = function() {login2 ()};
            function login2() {
                document.getElementById("register").style.display = "block";
                document.getElementById("registerUser").style.display = "none"; //Yes
                document.getElementById("loginForm").style.display = "block"; //Yes
                document.getElementById("login").style.display = "none";
            }
          password.onchange = validatePassword;
          confirm_password.onkeyup = validatePassword;
        </script>
        <?php   // CODE FOR REGISTER
            if(isset($_POST['NewUser'])){
                /* Comment this for now!
                $user_1 = $_POST['username'];
                if (strlen($user_1 <= 8)) {
                    $ERROR = '<p>Username is too Short!!</p>';
                } else{ */ 
                    // Securtiy
                    $Email = mysqli_real_escape_string($connection, $_POST['email']);
                    $Username = mysqli_real_escape_string($connection, $_POST['username']);
                    $Password = mysqli_real_escape_string($connection, $_POST['password']);
                    // Generate KEY
                    $timeStr = time();
                    $Key = password_hash($timeStr, PASSWORD_BCRYPT);

                    //Hash Password Security GOD Level
                    $Password_Hashed = password_hash($Password, PASSWORD_BCRYPT);
                    // Verify if not registered already!
                    $SQL_Mail = 'SELECT C_CorreoE FROM cliente WHERE C_CorreoE = "$Email"';
                    $MailResult = mysqli_query($connection, $SQL_Mail) or die(mysqli_error($connection));
                    $Email_Registered = mysqli_num_rows($MailResult);
                    if ($Email_Registered > 0) {
                        echo "<div class='alert alert-danger' role='alert'>
                        ERROR is already REGISTERED!
                        </div>";
                    } else{
                        // Register NEW USER
                        $SQL_Register = "INSERT INTO cliente (C_ID, C_CorreoE, C_UserName, C_Password, C_Key)
                        VALUES ('', '$Email', '$Username', '$Password_Hashed', '$Key')";
                        // INSERT INTO BD
                        if (mysqli_query($connection, $SQL_Register)) {
                            echo "<p>User created, Now Login!🙂👍</p>";
                        } else{
                            echo 'ERROR D:';
                        }
                    }
                }
            //}
        ?>
    </main>
</body>
    <!-- FOOTER -->
    <?php include_once 'components/footer.php' ?>
</html>