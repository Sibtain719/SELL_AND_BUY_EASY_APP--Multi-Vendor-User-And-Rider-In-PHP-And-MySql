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

<script type="text/javascript" src="jq.js"></script>
<script>
    $(document).ready(function()
    {

        $("#btnAddClick").click(function()
        {
            var cimag = $("#cimage").get(0).files;
            var cname = $("#cname").val();


            if(cname == "")
            {
                    return  $("#error_name").html("Name REquired").css("color","red");

            }
            var frm = new FormData();
            frm.append("cname",cname);
            frm.append("cimage",cimag[0]);

            $.ajax(
                {
                    url:"add_category.php",
                    data:frm,
                    type:"POST",
                    processData:false,
                    contentType:false,
                    success:function(result)
                    {
                        $("#tbl_rows").html(result);
                    },
                    error: function(error)
                    {
                        $("#msg").html(error);
                    }
                });
        });

        // UpDateRow
        $("#btnchangeClick").click(function(e)
            {
                if(document.getElementById('chk').checked)
                {
                    var frm = new FormData();
                    var cimag = $("#uimage").get(0).files;
                    frm.append("cid",$('#uid').val());
                    frm.append("cname",$('#uname').val());
                    frm.append("cimage",cimag[0]);
                    frm.append("img_key","yes");
                    e.preventDefault();
                    $.ajax(
                        {
                            url:"update_category.php",
                            data:frm,
                            type:"POST",
                            processData:false,
                            contentType:false,
                            success:function(result)
                            {
                                    $("#tbl_rows").html(result);
                                    $('#uid').val();
                                    $('#uname').val();
                                    $('#update').modal('hide');

                                //alert('updated');
                            },
                            error: function(error)
                            {
                                $("#umsg").html(error);
                            }
                        });
                }
                else{
                 var frm = new FormData();
                    var cimag = $("#uimage").get(0).files;
                    frm.append("cid",$('#uid').val());
                    frm.append("cname",$('#uname').val());
                    frm.append("cimage",cimag[0]);
                    frm.append("img_key","No");
                    e.preventDefault();
                    $.ajax(
                        {
                            url:"update_category.php",
                            data:frm,
                            type:"POST",
                            processData:false,
                            contentType:false,
                            success:function(result)
                            {
                            $("#tbl_rows").html(result);
                                $('#uid').val();
                                $('#uname').val();
                                $('#update').modal('hide');

                            },
                            error: function(error)
                            {
                                $("#umsg").html(result);
                            }
                        });
                }

            });

    });
    function CallImagePreview(title)
    {

        document.getElementById("pre_img").src=title;
    }
    function Delete(title)
    {

        var IsDeleted = confirm("do you want to delete this ("+title+") Row");
        if(IsDeleted == true)
        {
                var ajax = new XMLHttpRequest();
                ajax.open("GET","delete_category.php?cid="+title,true);
                // now event used to access response from server
                ajax.onreadystatechange=function()
                {
                    $("#tbl_rows").html(ajax.responseText);
                }
                ajax.send();

        }

    }
    function Update(title)
    {
        var arr = title.split(',');
        $('#uid').val(arr[0]);
        $('#uname').val(arr[1]);
        $('#update').modal('show');
    }
    function SearchRecord(txt)
    {
            var ajax = new XMLHttpRequest();
                ajax.open("GET","search_category.php?search="+txt,true);
                // now event used to access response from server
                ajax.onreadystatechange=function()
                {
                    $("#tbl_rows").html(ajax.responseText);
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
                                        <h4>Create Shop/Company Logo</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                                <div class="btn-group">
                                    <div class="buttonexport">
                                        <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addtask"><i class="fa fa-plus"></i> Create Logo</a>
                                    </div>

                                </div>

<style>

 .active-cyan-4  input[type=text]:focus:not([readonly]) {
  border: 1px solid #4dd0e1;
  box-shadow: 0 0 0 1px #4dd0e1;
}



</style>




<!-- search end -->

                                <!-- <input type="text" id="txtSearch" class="form-control" onkeyup="SearchRecord(this.value)"> -->

                                <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                                <div class="table-responsive">
                                    <span id="del_msg"></span>
                                    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="info">
                                                <td>Company Name</td>
                                            </tr>   
                                           
                                        </thead>
                                        <tbody id="tbl_rows">
                                            <?php

                                            include('db_connection.php');
                                                $obUser = $_SESSION['user'];
                                                $createdby = $obUser[2];

                                            $rows =  ExecuteQuery("SELECT * FROM tbl_users where uid='$createdby'");
                                            while ($cell = mysqli_fetch_array($rows))
                                            {
                                                $cat = $cell[0].','.$cell[1];
                                                echo '<tr>
                                                        <td><img src="shop_logo/'.$cell[9].'" class="img-circle" width="50" height="50" data-toggle="modal" data-target="#update_pre" id="btnimage" title="category/'.$cell[2].'" onClick="CallImagePreview(this.title)"></td>
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
                <div class="modal fade" id="addtask" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3><i class="fa fa-plus m-r-5"></i> Add Logo</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" action="add_logo.php" method="POST" enctype="multipart/form-data">
                                            <fieldset>
                                                <!-- Text input-->
                                                <div class="col-md-12 form-group ">
                                                    <label class="control-label ">Image</label>
                                                    <input type="file" id="cimage" name="cimage" class="form-control ">
                                                </div>
                                                <div class="col-md-12 form-group user-form-group ">
                                                    <div class="pull-right">
                                                        <span id="msg">
                                                        </span>
                                                        <input type="submit" value="Upload Company Logo" class="btn btn-primary">
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
                <!-- /.modal -->
                <!-- Modal1 -->
              <div class="modal fade" id="update" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3><i class="fa fa-plus m-r-5"></i> Update Category</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" action="add_category.php" method="POST" enctype="multipart/form-data">
                                            <fieldset>
                                                <!-- Text input-->
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Category Id</label>
                                                    <input type="text" id="uid" name="uid" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">name</label>
                                                    <input type="text" id="uname" name="uname" class="form-control "><span id="uerror_name"></span>
                                                </div>
                                                <div class="col-md-6 form-group ">
                                                    <label class="control-label ">Image</label>
                                                    <input type="file" id="uimage" name="uimage" placeholder="status " class="form-control ">
                                                </div>
                                                <div class="col-md-6 form-group ">
                                                    <input type="checkbox" id="chk" name="chk" class="form-control-sm"> Do you want to change Image then Tick.
                                                </div>

                                                <div class="col-md-12 form-group user-form-group ">
                                                    <div class="pull-right ">
                                                        <span id="umsg">

                                                        </span>
                                                        <input type="button" onclick="UpdateQuery()" value="Update Now" id="btnchangeClick" class="btn btn-primary">

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

                             <div class="modal fade" id="update_pre" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3><i class="fa fa-plus m-r-5"></i>Category Image Preview</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="#" id="pre_img"  width="560" height="350">
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

            </section>


            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer ">
            <strong>Copyright &copy; 2023-2024 <a href="# ">SABEasy App</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- /.wrapper -->
    <!-- Start Core Plugins
         =====================================================================-->
    <!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js " type="text/javascript "></script>
    <!-- jquery-ui -->
    <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js " type="text/javascript "></script>
    <!-- Bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js " type="text/javascript "></script>
    <!-- lobipanel -->
    <script src="assets/plugins/lobipanel/lobipanel.min.js " type="text/javascript "></script>
    <!-- Pace js -->
    <script src="assets/plugins/pace/pace.min.js " type="text/javascript "></script>
    <!-- SlimScroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js " type="text/javascript ">
    </script>
    <!-- FastClick -->
    <script src="assets/plugins/fastclick/fastclick.min.js " type="text/javascript "></script>
    <!-- CRMadmin frame -->
    <script src="assets/dist/js/custom.js " type="text/javascript "></script>
    <!-- End Core Plugins
         =====================================================================-->
    <!-- Start Page Lavel Plugins
         =====================================================================-->
    <!-- ChartJs JavaScript -->
    <script src="assets/plugins/chartJs/Chart.min.js " type="text/javascript "></script>
    <!-- Counter js -->
    <script src="assets/plugins/counterup/waypoints.js " type="text/javascript "></script>
    <script src="assets/plugins/counterup/jquery.counterup.min.js " type="text/javascript "></script>
    <!-- Monthly js -->
    <script src="assets/plugins/monthly/monthly.js " type="text/javascript "></script>
    <!-- End Page Lavel Plugins
         =====================================================================-->
    <!-- Start Theme label Script
         =====================================================================-->
    <!-- Dashboard js -->
    <script src="assets/dist/js/dashboard.js " type="text/javascript "></script>
    <!-- End Theme label Script
         =====================================================================-->

</body>



</html>