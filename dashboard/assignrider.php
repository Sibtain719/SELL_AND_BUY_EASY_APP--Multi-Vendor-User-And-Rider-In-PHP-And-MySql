<?php
    session_start();
    include('db_connection.php');
    print_r($_POST);
    $rider_id   = $_POST['rider_id'];
    $invoice    = $_POST['invoice_id'];
    $obUser    = $_SESSION['user'];
    $createdby = $obUser[2];
    $createddate = date('Y-m-d');

    $query = "select distinct customerid from tbl_orderitems where invoice='$invoice'";
    $row   =mysqli_query($con,$query);
    $customer = mysqli_fetch_array($row);

    $customer_id = $customer[0];
    $query = "insert into tbl_riderorder values(null,'$invoice','$customer_id','$rider_id','$createdby','$createddate')";
    $row = InsertQuery($query);
    if ($row == 1)
    {
        // Now Update Order Status as Assigned
        $query = "update tbl_order set status='Assigned' where invoice='$invoice'";
        $row = mysqli_query($con,$query);
        header("location:H_Orderinvoice.php");
    }
    else{
        header("location:H_Orderinvoice.php");

    }
?>