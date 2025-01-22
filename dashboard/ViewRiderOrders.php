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
        var ajax = new XMLHttpRequest();
        ajax.open("GET","OrderCancelByVendor.php?invoice="+title,true);
        ajax.onreadystatechange=function()
        {
            document.getElementById("re").innerHTML = ajax.responseText;
        }
        ajax.send();

}
function GetOrderCustomerDetail(title)
{
        var ajax = new XMLHttpRequest();
        ajax.open("GET","View_CustomerOrderDetail.php?invoice="+title,true);
        ajax.onreadystatechange=function()
        {
            document.getElementById("fieldset_rider_order_info").innerHTML = ajax.responseText;
        }
        ajax.send();
}
function AcceptOrder(invoice)
{
        var ajax = new XMLHttpRequest();
        ajax.open("GET","AcceptCustomerOrderByRider.php?invoice="+invoice,true);
        ajax.onreadystatechange=function()
        {
            document.getElementById("re").innerHTML = ajax.responseText;
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
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});">
                                                <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON (ignoreColumn)</a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'true'});">
                                                <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON (with Escape)</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'xml',escape:'false'});">
                                                <img src="assets/dist/img/xml.png" width="24" alt="logo"> XML</a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'sql'});">
                                                <img src="assets/dist/img/sql.png" width="24" alt="logo"> SQL</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'csv',escape:'false'});">
                                                <img src="assets/dist/img/csv.png" width="24" alt="logo"> CSV</a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'txt',escape:'false'});">
                                                <img src="assets/dist/img/txt.png" width="24" alt="logo"> TXT</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'excel',escape:'false'});">
                                                <img src="assets/dist/img/xls.png" width="24" alt="logo"> XLS</a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'doc',escape:'false'});">
                                                <img src="assets/dist/img/word.png" width="24" alt="logo"> Word</a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'powerpoint',escape:'false'});">
                                                <img src="assets/dist/img/ppt.png" width="24" alt="logo"> PowerPoint</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" onclick="$('#dataTableExample1').tableExport({type:'png',escape:'false'});">
                                                <img src="assets/dist/img/png.png" width="24" alt="logo"> PNG</a>
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
                                                <th>Order Id </th>
                                                <th>Order Date</th>
                                                <th>Invoice</th>
                                                <th>Paymentmethod</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="re">

                                            <?php

                                            include('db_connection.php');
                                             $obUser = $_SESSION['user'];
                                             $createdby = $obUser[2];

                                            $rows =  ExecuteQuery("SELECT 
                                            tbl_order.orderid,
                                            tbl_order.orderdate,
                                            tbl_order.invoice,
                                            tbl_order.paymentmethod,
                                            tbl_order.amount,
                                            tbl_order.status
                                            from tbl_order
                                            INNER join tbl_riderorder on tbl_riderorder.oredrinvoice = tbl_order.invoice
                                            where 
                                            tbl_riderorder.riderid = '$createdby' 

                                                                        ");
                                            while ($cell = mysqli_fetch_array($rows))
                                            {
                                                $order_detail = $cell[2];
                                                if($cell[5] == "Assigned")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>' . $cell[5] . '</td>
                                                    <td>
                                                        <a  data-toggle="modal" class="btn btn-primary" data-target="#viewrider" title='.$cell[2].' onclick="GetOrderCustomerDetail(this.title)" href="#">Order Detail</a>
                                                         | 
                                                        <a  data-toggle="modal" class="btn btn-danger" data-target="#" title='.$cell[2].' onclick="CancelByRider(this.title)" href="#">Cancel Order</a>
                                                    </td>
                                                   </tr>';
                                                }
                                                if($cell[5] == "In Process")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>' . $cell[5] . '</td>
                                                    <td>
                                                        <a href="#" class="btn btn-success">Accepted</a>
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
                                <h3><i class="fa fa-plus m-r-5"></i> View Order Detail</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
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
