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
<script>
function SetupRider(title)
{
    document.getElementById('invoice_id').value = title;
}
function SetupCancel(title)
{
    //document.getElementById('invoice_id').value = title;
    alert(title);
        var ajax = new XMLHttpRequest();
        ajax.open("GET","OrderCancelByVendor.php?invoice="+title,true);
        ajax.onreadystatechange=function()
        {
            document.getElementById("re").innerHTML = ajax.responseText;
        }
        ajax.send();

}
function GetRiderOrderCustomerDetail(title)
{

        var ajax = new XMLHttpRequest();
        ajax.open("GET","RiderOrderCustomer.php?invoice="+title,true);
        ajax.onreadystatechange=function()
        {
            document.getElementById("fieldset_rider_order_info").innerHTML = ajax.responseText;
        }
        ajax.send();
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
                    <div class="col-sm-12 col-md-12">
                        <div class="panel panel-bd lobidisable">
                            <div class="panel-heading">
                                <div class="btn-group" id="buttonexport">
                                    <a href="#">
                                        <h4>Order Items</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                                <div class="btn-group">

                                    <button class="btn btn-exp btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
                                    <ul class="dropdown-menu exp-drop" role="menu">
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'false'});">
                                                <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON</a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'csv',escape:'false'});">
                                                <img src="assets/dist/img/csv.png" width="24" alt="logo"> CSV</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'excel',escape:'false'});">
                                                <img src="assets/dist/img/xls.png" width="24" alt="logo"> XLS</a>
                                        </li>
                                        <li class="divider"></li>
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
                                                <th>Invoice</th>
                                                <th>Order Date</th>
                                                <th>Paymentmethod</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="re">
                                            <?php
                                            include('db_connection.php');
                                            $obUser    = $_SESSION['user'];
                                            $createdby = $obUser[2];
                                            //echo $createdby;
                                            $rows =  ExecuteQuery("SELECT 
                                                                    DISTINCT(tbl_order.invoice), 
                                                                    tbl_order.orderdate, 
                                                                    tbl_order.paymentmethod, 
                                                                    tbl_order.amount, 
                                                                    tbl_order.status 
                                                                    from tbl_order 
                                                                    INNER JOIN tbl_orderitems on tbl_orderitems.invoice = tbl_order.invoice 
                                                                    where tbl_orderitems.ordergeneratedby = '$createdby' 
                                                                        ");
                                            while ($cell = mysqli_fetch_array($rows))
                                            {
                                                $order_detail = $cell[0];
                                                if($cell[4] == "Assigned")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>
                                                    <a data-toggle="modal" data-target="#viewrider" title='.$cell[0].' onclick="GetRiderOrderCustomerDetail(this.title)" href="#">View Rider</a>
                                                    </td>
                                                   </tr>';
                                                }
                                                if($cell[4] == "Ordered")
                                                {
                                                    $order_detail_cancel = $cell[2]; 

                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#addtask" title="'.$order_detail.'" onclick="SetupRider(this.title)">Assign Rider</a>
                                                        <a href="#" class="btn btn-default btn-xs" title="'.$order_detail_cancel.'" onclick="SetupCancel(this.title)">Cancel Order</a>

                                                    </td>
                                                   </tr>';
                                                }
                                                if($cell[4] == "In Process")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>
                                                        <a href="#">View Rider</a>
                                                    </td>
                                                   </tr>';
                                                }
                                                if($cell[4] == "Order Delivered")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>
                                                        <a href="#">View Rider</a>
                                                    </td>
                                                   </tr>';
                                                }
                                                else if($cell[4] == "Cancel")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>
                                                        <a href="#">Cancelled By Vendor</a>
                                                    </td>
                                                   </tr>';
                                                }
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
                <div class="modal fade" id="addtask" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3><i class="fa fa-plus m-r-5"></i>Assign Selected Order to Any Rider</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" action="assignrider.php" method="POST">
                                            <fieldset>
                                                <!-- Text input-->
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Order Invoice</label>
                                                    <input type="text" readonly id="invoice_id" name="invoice_id" class="form-control">
                                                </div>
                                                <!-- Text input-->
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Select Rider</label>
                                                    <select class="form-control" id="rider_id" name="rider_id">
                                                        <option>Select</option>
                                                    <?php
                                                    $rows =  ExecuteQuery("SELECT * FROM tbl_users where role_id=4");
                                                    while ($cell = mysqli_fetch_array($rows))
                                                    {
                                                      echo '<option value="'.$cell[0].'">'.$cell[2].' - '.$cell[4].' - '.$cell[12].'</option>';}
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group user-form-group">
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                                        <button type="submit" class="btn btn-add btn-sm">Update</button>
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
                <!-- Modal1 -->
                <div class="modal fade" id="update" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3><i class="fa fa-plus m-r-5"></i> Update Info</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal">
                                            <fieldset>
                                                <!-- Text input-->
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Task Name</label>
                                                    <input type="text" placeholder="Task Name" class="form-control">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Due date</label>
                                                    <input type="number" placeholder="Due title" class="form-control">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Description</label>
                                                    <input type="text" placeholder="Description" class="form-control">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Assign to</label>
                                                    <input type="text" placeholder="Assign to" class="form-control">
                                                </div>
                                                <!-- Text input-->
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">status</label>
                                                    <input type="text" placeholder="status" class="form-control">
                                                </div>
                                                <div class="col-md-12 form-group user-form-group">
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                                        <button type="submit" class="btn btn-add btn-sm">Update</button>
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




                <div class="modal fade" id="viewrider" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3><i class="fa fa-plus m-r-5"></i> View Rider</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" action="add_category.php" method="POST" enctype="multipart/form-data">
                                            <fieldset >
                                                <div class="table-responsive" >
                                                    <table  id="fieldset_rider_order_info" class="table table-bordered table-striped table-hover">


                                                    </table>

                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                <!-- /.modal -->
            </section>


            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023-2024 <a href="#">SABEasy App</a>.</strong> All rights reserved.
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
