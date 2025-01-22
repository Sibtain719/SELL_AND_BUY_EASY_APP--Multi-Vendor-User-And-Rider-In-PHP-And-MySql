<?php
session_start();
if (isset($_SESSION["user"])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SABeasy App Login</title>
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <?php include('HeaderNavigationLinks.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
    <div class="login-wrapper">
        <div class="container-center">
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="IsLogin.php" method="POST" id="loginForm" novalidate>
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" name="user" class="form-control" required>
                                <span class="help-block small">Your unique username to app</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" id="pass" name="pass" class="form-control" required>
                                <span class="help-block small">Your strong password</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="role">Login As</label>
                                <select name="role" class="form-control" required>
                                    <option value="customer">Customer</option>
                                    <option value="vendor">Vendor</option>
                                    <option value="rider">Rider</option>
                                </select>
                                <span class="help-block small">Select your role</span>
                            </div>
                            <div>
                                <input type="submit" value="Login" class="btn btn-primary">
                                <a class="btn btn-warning" href="register.php">Register</a>
                                <a class="btn btn-warning" href="passwordrecovery.php">Forget password</a>
                                <hr>
                                <span id="msg" style="color:red">
                                    <?php
                                    if (isset($_GET['q'])) {
                                        echo htmlspecialchars($_GET['q']);
                                    }
                                    ?>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
