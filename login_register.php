<?php
    require_once 'include/connect.php';
    // Connect to Database and Style Sheet's
    include_once 'include/bootstrapLinks.php';
    include_once 'css/footerStyle.css';

    $ERROR = NULL;
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
                <form method="POST" action="" class="bg-dark mx-auto col-8 col-sm-4">
                    <div class="form-group">
                        <p class="text-white">Email/Username: </p>
                        <input type="text" class="form-control" name="Username" placeholder="Example@gmail.com" required>
                    </div> <!-- PASSWORD -->
                    <div class="form-group">
                        <p class="text-white">Password: </p>
                        <input type="password" class="form-control" name="UserPassword"  required>
                    </div>
                    <div align="center">
                        <button class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div align="center">
            <h4 id="register" class="text-white">Register</h4>
        </div>
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
                <form action="" method="POST" class="bg-dark mx-auto col-8 col-sm-4">
                    <div class="form-group">
                        <p class="text-white">Email: </p>
                        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <p class="text-white">Username: </p>
                        <input type="text" class="form-control" name="Username" required>
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
                        <button class="btn btn-success">Register</button>
                    </div>
                </form>
            </div>
        </div>
        <div align="center">
            <h4 id="login" class="text-white" style="display: none;">Login</h4>
        </div>
        <script>
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
    </main>
</body>
    <!-- FOOTER -->
    <?php include_once 'components/footer.php' ?>
</html>