<?php
session_start();
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
                    <div class="col-sm-12 col-md-12">
                        <div class="panel panel-bd lobidisable">
                            <div class="panel-heading">
                                <div class="btn-group" id="buttonexport">
                                    <a href="#">
                                        <h4>Customer Feedback For Vendor's Items</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                                <div class="btn-group">
                                    <button class="btn btn-exp btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
                                    <ul class="dropdown-menu exp-drop" role="menu">
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'csv',escape:'false'});">
                                                <img src="assets/dist/img/csv.png" width="24" alt="logo"> CSV</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'excel',escape:'false'});">
                                                <img src="assets/dist/img/xls.png" width="24" alt="logo"> XLS</a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">
                                                <img src="assets/dist/img/pdf.png" width="24" alt="logo"> PDF</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                                <div class="table-responsive">
                                    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="info">
                                                <th>FID</th>
                                                <th>Feedback</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Invoice</th>
                                                <th>Customer</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            include('db_connection.php');
                                            $obUser    = $_SESSION['user'];
                                            $createdby = $obUser[2];

                                            $rows =  ExecuteQuery("SELECT
                                            tbl_feedback.id,
                                            tbl_feedback.feedback,
                                            tbl_feedback.fddate,
                                            tbl_feedback.fdtime,
                                            tbl_feedback.invoice_order,
                                            tbl_users.username as 'Customer'
                                            from tbl_feedback
                                            INNER JOIN tbl_orderitems on tbl_orderitems.invoice = tbl_feedback.invoice_order
                                            INNER JOIN tbl_users on tbl_users.uid = tbl_orderitems.customerid
                                            INNER JOIN tbl_items on tbl_items.id = tbl_orderitems.itemid
                                            where tbl_items.createdby ='$createdby'
                                                                        ");
                                            while ($cell = mysqli_fetch_array($rows)) {
                                                echo '<tr>
                                                                 <td>' . $cell[0] . '</td>
                                                                 <td>' . $cell[1] . '</td>
                                                                 <td>' . $cell[2] . '</td>
                                                                 <td>' . $cell[3] . '</td>
                                                                 <td>' . $cell[4] . '</td>
                                                                 <td>' . $cell[5] . '</td>
                                                                 <td>
                                                         <button type="button" class="btn btn-add btn-xs" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
                                                         <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delt"><i class="fa fa-trash-o"></i> </button>
                                                                   </td>
                                                        </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal1 -->
                <!-- /.modal -->
                <!-- delete user Modal2 -->
                <div class="modal fade" id="delt" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3><i class="fa fa-user m-r-5"></i> Delete task</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal">
                                            <fieldset>
                                                <div class="col-md-12 form-group user-form-group">
                                                    <label class="control-label">Delete task</label>
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-danger btn-sm">NO</button>
                                                        <button type="submit" class="btn btn-success btn-sm">YES</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </section>


            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023-2024 <a href="#">SABeasy App</a>.</strong> All rights reserved.
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

</body>



</html>