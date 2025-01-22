<?php
    session_start();
    if(isset($_SESSION["user"]))
    {
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CRM Admin Panel</title>

    <script>
        function PassStrength(p) 
        {
            CheckPassword(p);

            // document.getElementById("msg").innerHTML = p.length;
            /*   var passw = "/^[A-Za-z]\w{7,14}$/";
               if (p.value.match(passw)) {
                   document.getElementById("msg").innerHTML = "<font color='red'>OK</font>";
               } else {
                   document.getElementById("msg").innerHTML = "<font color='red'>password contains 8 character w</font>";

               }
               if (p.length < 6) {
                   document.getElementById("msg").innerHTML = "<font color='red'>Password Must be > 5 characters</font>";
               }
               if (p.length > 5 && p.length <= 8) {
                   document.getElementById("msg").innerHTML = "<font color='red'>Week Password</font>";
               } else if (p.length > 8) {
                   document.getElementById("msg").innerHTML = "<font color='green'>strong Password</font>";
               }*/

        }

        function CheckPassword(inputtxt) {
            var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
            if (inputtxt.value.match(passw)) {
                alert('Correct, try another...')
                return true;
            } else {
                alert('Wrong...!')
                return false;
            }
        }
    </script>
    <?php
    include('HeaderNavigationLinks.php');
    ?>
</head>

<body>
    <!-- Content Wrapper -->
    <div class="login-wrapper">
        <div class="back-link">
            <a href="login.php" class="btn btn-add">Back to Login</a>
        </div>
        <div class="container-center">
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Forget Password</h3>
                                <small><strong>Please enter your Email to verify</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="recover_pwd.php" method="POST" id="loginForm" novalidate>
                            <div class="form-group">
                                <label class="control-label" for="username">Email</label>
                                <input type="text" name="email" class="form-control" required>
                                <span class="help-block small">Enter Email to Recover Password</span>
                            </div>
                            <div>
                                <input type="submit" value="Verify Now" class="btn btn-primary">
                                <a class="btn btn-warning" href="register.php">Register</a>
                                <a class="btn btn-primary" href="login.php">Login</a>
                                <hr>
                                <span id="msg">

                                    <?php
                                    if (isset($_GET['q']))
                                    {
                                        if($_GET['q'] == '1')
                                        {
                                            echo '<span style="color:green">Password has been sent on email<br>Please check you Email.</span>';
                                        }
                                        else
                                        {
                                            echo '<span style="color:green">'.$_GET['q'].'</span>';
                                        }
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
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <!-- bootstrap js -->
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>



</html>