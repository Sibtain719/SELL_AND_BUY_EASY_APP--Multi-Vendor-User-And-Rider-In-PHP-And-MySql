<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SABeasy Register</title>
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <?php include('HeaderNavigationLinks.php'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                document.getElementById("error").innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            document.getElementById('lat').value = position.coords.latitude;
            document.getElementById('lng').value = position.coords.longitude;
        }

        function validateForm() {
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone-number').value;
            var password = document.getElementById('password').value;

            var emailRGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var phoneRGEX = /^\d{11}$/;
            var passwordRGEX = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

            var emailResult = emailRGEX.test(email);
            var phoneResult = phoneRGEX.test(phone);
            var passwordResult = passwordRGEX.test(password);

            if (!emailResult) {
                document.getElementById('email-error').innerHTML = "Invalid email format.";
                return false;
            } else {
                document.getElementById('email-error').innerHTML = "";
            }

            if (!phoneResult) {
                document.getElementById('phone-error').innerHTML = "Invalid phone number format. Must be 11 digits.";
                return false;
            } else {
                document.getElementById('phone-error').innerHTML = "";
            }

            if (!passwordResult) {
                document.getElementById('password-error').innerHTML = "Password must be at least 8 characters long and contain both letters and numbers.";
                return false;
            } else {
                document.getElementById('password-error').innerHTML = "";
            }

            return true;
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=getLocation"></script>
</head>

<body>
    <div class="login-wrapper">
        <div class="container-center lg">
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Register</h3>
                                <small><strong>Please enter your data to register.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="Vendor_CustomerRegister.php" id="loginForm" method="post" onsubmit="return validateForm()">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Select</label>
                                    <select class="form-control" name="rid" required>
                                        <option value="">Select</option>
                                        <?php
                                        include('db_connection.php');
                                        $rows = mysqli_query($con, "select * from tbl_role where name!='admin'");
                                        while ($c = mysqli_fetch_array($rows)) {
                                            echo '<option value=' . $c[0] . '>' . $c[1] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="help-block small">Select your unique role to register</span>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Name</label>
                                    <input type="text" name="user" required class="form-control">
                                    <span class="help-block small">Your name</span>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                    <span id="email-error" class="text-danger"></span>
                                    <span class="help-block small">Your email address</span>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Contact</label>
                                    <input type="number" id="phone-number" class="form-control" required name="contact" maxlength="11">
                                    <span id="phone-error" class="text-danger"></span>
                                    <span class="help-block small">Your contact number</span>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Username</label>
                                    <input type="text" name="uname" class="form-control" required>
                                    <span class="help-block small">Your username to log in</span>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    <span id="password-error" class="text-danger"></span>
                                    <span class="help-block small">Your password to log in</span>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" required>
                                    <span class="help-block small">Your permanent address</span>
                                </div>

                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">

                                <div>
                                    <input style="margin-left: 20px;" type="submit" value="Register" class="btn btn-primary">
                                    <a style="margin-left: 20px;" class="btn btn-add" href="login.php">Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap JS -->
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>
