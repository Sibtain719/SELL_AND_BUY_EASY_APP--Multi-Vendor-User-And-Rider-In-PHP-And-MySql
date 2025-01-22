<?php
session_start();
include('db_connection.php');
if(!isset($_SESSION['user']))
{
    header("location:login.php");
}
// Query for counters
$obUser_id    = $_SESSION['user'];
$vid = $obUser_id[2];
$query_customer = mysqli_query($con,"SELECT COUNT(DISTINCT(customerid)) from tbl_orderitems where ordergeneratedby='$vid'");
$cus_count = 0;
if(mysqli_num_rows($query_customer)>0)
{
    $ob=mysqli_fetch_array($query_customer);
    $cus_count = $ob[0];
}
$query_rider = mysqli_query($con,"SELECT COUNT(DISTINCT(uid)) from tbl_users where role_id='4'");
$rid_count = 0;
if(mysqli_num_rows($query_rider)>0)
{
    $ob=mysqli_fetch_array($query_rider);
    $rid_count = $ob[0];
}
$query_orders = mysqli_query($con,"SELECT COUNT(DISTINCT(tbl_orderitems.invoice)) 
from tbl_orderitems 
INNER JOIN tbl_order on tbl_order.invoice = tbl_orderitems.invoice
where tbl_orderitems.ordergeneratedby='$vid' and tbl_order.status = 'Ordered'");
$ord_count = 0;
if(mysqli_num_rows($query_orders)>0)
{
    $ob=mysqli_fetch_array($query_orders);
    $ord_count = $ob[0];
}
$query_process = mysqli_query($con,"SELECT COUNT(DISTINCT(tbl_orderitems.invoice)) 
from tbl_orderitems 
INNER JOIN tbl_order on tbl_order.invoice = tbl_orderitems.invoice
where tbl_orderitems.ordergeneratedby='$vid' and tbl_order.status = 'Assigned'");
$pro_count = 0;
if(mysqli_num_rows($query_process)>0)
{
    $ob=mysqli_fetch_array($query_process);
    $pro_count = $ob[0];
}

$query_delivered = mysqli_query($con,"SELECT COUNT(DISTINCT(tbl_orderitems.invoice)) 
from tbl_orderitems 
INNER JOIN tbl_order on tbl_order.invoice = tbl_orderitems.invoice
where tbl_orderitems.ordergeneratedby='$vid' and tbl_order.status = 'Delivered'");
$del_count = 0;
if(mysqli_num_rows($query_delivered)>0)
{
    $ob=mysqli_fetch_array($query_delivered);
    $del_count = $ob[0];
}

$query_items = mysqli_query($con,"SELECT COUNT(DISTINCT(itemname)) from tbl_items WHERE createdby='$vid' and status='active'");
$itm_count = 0;
if(mysqli_num_rows($query_items)>0)
{
    $ob=mysqli_fetch_array($query_items);
    $itm_count = $ob[0];
}


$query_rating = mysqli_query($con,"SELECT SUM(rating)/count(id)  as 'Rating' FROM tbl_ratings where shop_id ='$vid'");
$rat_count = 0;
if(mysqli_num_rows($query_rating)>0)
{
    $ob=mysqli_fetch_array($query_rating);
    $rat_count = $ob[0];
}
else
{
    $rat_count = 0.0;
}


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
    include('HeaderNavigationLinks.php');
    ?>
</head>

<body class="hold-transition sidebar-mini">
    <!--preloader-->
    <div id="preloader">
        <div id="status"></div>
    </div>
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo">
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
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div id="cardbox1">
                            <div class="statistic-box">
                                <i class="fa fa-user-plus fa-3x"></i>
                                <div class="counter-number pull-right">
                                    <span class="count-number"><?php echo $cus_count; ?></span>
                                    <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                                    </span>
                                </div>
                                <h3>Total Customers</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <a href="vendor_rating.php">
                        <div id="cardbox3">
                            <div class="statistic-box">

                                        <button type="button" class="btn btn-rating btn-sm" aria-label="Left Align">
                                             <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>

                                <div class="counter-number pull-right">
                                    <?php echo $rat_count; ?>
                                    </span>
                                    <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                                    </span>
                                </div>
                                <h3> Rating</h3>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div id="cardbox4">
                            <div class="statistic-box">
                                <i class="fa fa-files-o fa-3x"></i>
                                <div class="counter-number pull-right">
                                    <span class="count-number"><?php echo $rid_count; ?></span>
                                    <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                                    </span>
                                </div>
                                <h3> Total Riders</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div id="cardbox4">
                            <div class="statistic-box">
                                <i class="fa fa-files-o fa-3x"></i>
                                <div class="counter-number pull-right">
                                    <span class="count-number"><?php echo $itm_count;?></span>
                                    <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                                    </span>
                                </div>
                                <h3> Active Items</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div id="cardbox4">
                            <div class="statistic-box">
                                <i class="fa fa-files-o fa-3x"></i>
                                <div class="counter-number pull-right">
                                    <span class="count-number"><?php echo $ord_count;?></span>
                                    <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                                    </span>
                                </div>
                                <h3>Active Orders</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div id="cardbox1">
                            <div class="statistic-box">
                                <i class="fa fa-user-plus fa-3x"></i>
                                <div class="counter-number pull-right">
                                    <span class="count-number"><?php echo $pro_count;?></span>
                                    <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                                    </span>
                                </div>
                                <h3> In Process Orders</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div id="cardbox4">
                            <div class="statistic-box">
                                <i class="fa fa-files-o fa-3x"></i>
                                <div class="counter-number pull-right">
                                    <span class="count-number"><?php echo $del_count;?></span>
                                    <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                                    </span>
                                </div>
                                <h3>Delivered Order </h3>
                            </div>
                        </div>
                    </div>
          
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023-2024 <a href="#">SABeasy</a>.</strong> All rights reserved.
        </footer>
    </div>
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
    <script>
        function dash() {
            // single bar chart
            var ctx = document.getElementById("singelBarChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
                    datasets: [{
                        label: "My First dataset",
                        data: [40, 55, 75, 81, 56, 55, 40],
                        borderColor: "rgba(0, 150, 136, 0.8)",
                        width: "1",
                        borderWidth: "0",
                        backgroundColor: "rgba(0, 150, 136, 0.8)"
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            //monthly calender
            $('#m_calendar').monthly({
                mode: 'event',
                //jsonUrl: 'events.json',
                //dataType: 'json'
                xmlUrl: 'events.xml'
            });

            //bar chart
            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "august", "september", "october", "Nobemver", "December"],
                    datasets: [{
                        label: "My First dataset",
                        data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
                        borderColor: "rgba(0, 150, 136, 0.8)",
                        width: "1",
                        borderWidth: "0",
                        backgroundColor: "rgba(0, 150, 136, 0.8)"
                    }, {
                        label: "My Second dataset",
                        data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
                        borderColor: "rgba(51, 51, 51, 0.55)",
                        width: "1",
                        borderWidth: "0",
                        backgroundColor: "rgba(51, 51, 51, 0.55)"
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            //counter
            $('.count-number').counterUp({
                delay: 10,
                time: 5000
            });
        }
        dash();
    </script>
</body>


</html>



