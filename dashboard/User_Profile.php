<?php
session_start();
$User = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM Admin Panel</title>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <?php
    require('HeaderNavigationLinks.php');
    ?>

    <script>
        /*var loadFile = function(event) 
        {
            var image = document.getElementById('uploading');
            image.src = URL.createObjectURL(event.target.files[0]);
        };*/
        function UpdateProfile(type_change,a,b,c) 
        {
            alert(type_change);
            alert(a);
            alert(b);
            alert(c);
            if(type_change="change_pw")
            {
                if(a!="")
                {
                    if (b == c) 
                    {
                        // code
                        var url = "edit_profile.php?type="+type_change+"&pass="+b;
                        var ajax = new XMLHttpRequest();
                        ajax.open("GET", url, true);
                        ajax.onreadystatechange = function() 
                        {
                            alert(ajax.responseText);
                            document.getElementById("msg_pass").innerHTML = ajax.responseText;
                        }
                        ajax.send();
                    } 
                    else 
                    {
                        alert('Password not Matched');
                    }
                    
                }
            }
        }

    </script>


</head>

<body class="hold-transition sidebar-mini">
    <!--preloader-->
    <div id="preloader">
        <div id="status"></div>
    </div>
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <a href="index-2.html" class="logo">
                <!-- Logo -->
                <span class="logo-mini">
                    <img src="assets/dist/img/mini-logo.png" alt="">
                </span>
                <span class="logo-lg">
                    <img src="assets/dist/img/logo.png" alt="">
                </span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <!-- Sidebar toggle button-->
                    <span class="sr-only">Toggle navigation</span>
                    <span class="pe-7s-angle-left-circle"></span>
                </a>
                <!-- searchbar-->

                <div class="navbar-custom-menu">
                    <?php
                    include("profileheader.php");
                    ?>
                </div>
            </nav>
        </header>
        <!-- =============================================== -->
        <!-- Left side column. contains the sidebar -->
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar -->
            <div class="sidebar">
                <!-- sidebar menu -->
                <?php
                include('SideNavigation.php');
                ?>
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="header-icon">
                    <i class="fa fa-dashboard"></i>
                </div>
                <div class="header-title">
                    <h1>CRM Admin Dashboard</h1>
                    <small>Very detailed & featured admin.</small>
                </div>
            </section>
            <!-- Main content -->



            <section class="content">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-header-headshot">
                                <img src="Profiles/<?php echo $User[7];?>" class="img-circle" width="81" height="81" alt="<?php echo $obUser[7]; ?>""></a>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-content-member text-center">
                                    <h4 class="m-t-0"><?php echo $User[3]; ?></h4>
                                    <p class="m-t-0"><?php echo $User[4]; ?></p>
                                </div>
                                <div class="card-content-languages">
                                    <div class="card-content-languages-group">
                                        <div>
                                            <h4>Mobile:</h4>
                                        </div>
                                        <div>
                                            <ul>
                                                <li>
                                                    <?php echo $User[5]; ?>
                                                    <div class="fluency fluency-4"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-content-languages-group">
                                        <div>
                                            <h4>Date:</h4>
                                        </div>
                                        <div>
                                            <ul>
                                                <li> <?php echo $User[9]; ?></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content-summary">
                                    <p>Address : <?php echo $User[10]; ?></p>
                                </div>


                            </div>




                            <div class="card-footer">
                                <div class="card-footer-stats">
                                    <div>
                                        <p>Orders:</p>
                                        <i class="fa fa-users"></i><span>241</span>
                                    </div>
                                    <div>
                                        <p>Riders:</p>
                                        <i class="fa fa-coffee"></i><span>350</span>
                                    </div>
                                    <div>
                                        <p>Customers</p>
                                        <span class="stats-small">3 days ago</span>
                                    </div>
                                </div>
                                <div class="card-footer-message">
                                    <h4><i class="fa fa-comments"></i> Message me</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($obUser[1] == "admin" || $obUser[1] == "Admin") {
                    } else if ($obUser[1] == "vendor" || $obUser[1] == "Vendor") {
                    ?>

                        <div class="col-sm-12 col-md-8">
                            <div class="row">

                               <div class="col-sm-12 col-md-6">
                                    <div class="rating-block">
                                        <h4>Change Password</h4>
                                        <h7 class="s-10">if you want to change your password then<br> click below button<br></h7>
                                        <div class="buttonexport">
                                            <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addtask"><i class="fa fa-plus"></i> Change Password</a>
                                        </div>
                                                                                        <?php
                                                    if(isset($_GET['msg']))
                                                    {
                                                        echo $_GET['msg'];
                                                    }
                                                ?>

                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-6">
                                    <div class="rating-block">
                                        <h4>Change Your Profile Image</h4>
                                        <h7 class="s-10">if you want to change your profile picture then click below button<br></h7>
                                        <div class="buttonexport">
                                            <a href="#" class="btn btn-add" data-toggle="modal" data-target="#update"><i class="fa fa-plus"></i> Upload Image</a>


                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="rating-block">
                                        <h4>Change Address</h4>
                                        <h7 class="s-10">if you want to change your Address then<br> click below button<br></h7>
                                        <div class="buttonexport">
                                            <a href="#" class="btn btn-add" data-toggle="modal" data-target="#address"><i class="fa fa-plus"></i> Change Address</a>


                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="rating-block">
                                        <h4>Change Phone</h4>
                                        <h7 class="s-10">if you want to change your Address then<br> click below button<br></h7>
                                        <div class="buttonexport">
                                            <a href="#" class="btn btn-add" data-toggle="modal" data-target="#phone"><i class="fa fa-plus"></i> Change Phone</a>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                    <div class="rating-block">
                                        <h4>Average user rating</h4>
                                        <h2 class="m-b-20">4.3 <small>/ 5</small></h2>
                                        <button type="button" class="btn btn-rating btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="btn btn-rating btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="btn btn-rating btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                 </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="rating-block">
                                    <h4>You Feedback</h4>
                                        <h7 class="s-10">Feedback about the product Quality<br> click below button<br></h7>
                                        <div class="buttonexport">
                                            <a href="#" class="btn btn-add" data-toggle="modal" data-target="#Feedback"><i class="fa fa-plus"></i>FeedBack</a>


                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                     </div>
                    <?php
                    }
                    ?>
                </div>
            </section>






            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <div class="modal fade" id="addtask" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-plus m-r-5"></i> Password</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="edit_profile.php" method="POST" enctype="multipart/form-data">
                                    <fieldset>
                                        <!-- Text input-->
                                        <div class="col-md-12 form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" id="newpass" name="newpass" class="form-control "><span id="error_name"></span>
                                        </div>
                                        <div class="col-md-12 form-group ">
                                            <label class="control-label ">Retype Password</label>
                                            <input type="password" id="retypepass" name="retypepass" placeholder="Retype" class="form-control ">
                                        </div>
                                        <div class="col-md-12 form-group user-form-group ">
                                            <div class="pull-left">
                                                <span id="msg_pass">

                                                </span>
                                                <input type="submit" class="btn btn-add btn-sm" title="Update" value="Update Passowrd">
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>



                    <div class="modal-footer ">
                        <button type="button " class="btn btn-danger pull-left " data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="address" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-plus m-r-5"></i> Address</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="edit_address.php" method="POST" enctype="multipart/form-data">
                                    <fieldset>
                                        <!-- Text input-->

                                        <div class="col-md-12 form-group">
                                            <label class="control-label">New Address</label>
                                            <input type="text" id="newadd" name="newadd" class="form-control "><span id="error_name"></span>
                                        </div>

                                        <div class="col-md-12 form-group user-form-group ">
                                            <div class="pull-left">
                                                <span id="msg_pass">

                                                </span>
                                                <input type="submit"  value="Create" id="btnAddClick" class="btn btn-primary">
                                                <button type="submit " class="btn btn-add btn-sm ">Update</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button " class="btn btn-danger pull-left " data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="phone" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-plus m-r-5"></i> Phone</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="edit_phone.php" method="POST" enctype="multipart/form-data">
                                    <fieldset>
                                        <!-- Text input-->
                                        <div class="col-md-12 form-group">
                                            <label class="control-label">New Phone</label>
                                            <input type="text" id="phone" name="phone" class="form-control">
                                        </div>


                                        <div class="col-md-12 form-group user-form-group ">
                                            <div class="pull-left">
                                                <span id="msg_pass">

                                                </span>
                                                <input type="submit"  value="Create" id="btnAddClick" class="btn btn-primary">
                                                <button type="submit " class="btn btn-add btn-sm ">Update</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button " class="btn btn-danger pull-left " data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="update" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-plus m-r-5"></i> Upload Profile Image</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="updateprofile.php" method="POST" enctype="multipart/form-data">
                                    <fieldset>
                                        <!-- Text input-->

                                        <div class="col-md-6 form-group ">
                                            <label class="control-label ">Image</label>
                                            <input type="file" id="cimage" name="cimage" accept="image/gif, image/jpeg, image/png" onchange="loadFile(event)" class="form-control ">
                                        </div>
                                        <div class="col-md-6 form-group ">
                                            <img src="#" id="uploading" name="uploading" alt="not found" width="100" height="100">
                                        </div>
                                        <div class="col-md-12 form-group user-form-group ">
                                            <div class="pull-right ">
                                                <input type="submit" value="Upload Profile" id="btnAddClick" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button " class="btn btn-danger pull-left " data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="Feedback" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-plus m-r-5"></i> Feedback</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                               
                               
                               
                               
                                
                                
                                
                                
                            </div>
                        </div>
                    </div>



                    <div class="modal-footer ">
                        <button type="button " class="btn btn-danger pull-left " data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>



        <footer class="main-footer">
            <strong>Copyright &copy; 2023-2024 <a href="#">SABeasy App</a>.</strong> All rights reserved.
        </footer>
        <!-- /.wrapper -->
        <!-- Start Core Plugins
         =====================================================================-->
        <!-- jQuery -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- jquery-ui -->
        <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- lobipanel -->
        <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
        <!-- Pace js -->
        <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript">
        </script>
        <!-- FastClick -->
        <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <!-- CRMadmin frame -->
        <script src="assets/dist/js/custom.js" type="text/javascript"></script>
        <!-- End Core Plugins
         =====================================================================-->
        <!-- Start Page Lavel Plugins
         =====================================================================-->
        <!-- ChartJs JavaScript -->
        <script src="assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
        <!-- Counter js -->
        <script src="assets/plugins/counterup/waypoints.js" type="text/javascript"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <!-- Monthly js -->
        <script src="assets/plugins/monthly/monthly.js" type="text/javascript"></script>
        <!-- End Page Lavel Plugins
         =====================================================================-->
        <!-- Start Theme label Script
         =====================================================================-->
        <!-- Dashboard js -->
        <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
        <!-- End Theme label Script
         =====================================================================-->

</body>



</html>