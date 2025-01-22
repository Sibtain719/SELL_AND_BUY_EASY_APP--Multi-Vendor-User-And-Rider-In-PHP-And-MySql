
<?php
        include('../db_connection.php');
        $Id=$_GET['r_id'];
        //print_r($con);
        $rows =  ExecuteQuery("SELECT 
	        tbl_users.name as 'Customer',
            tbl_users.contact,
	        tbl_users.address, 
            tbl_orderitems.invoice,
            vendor.name as 'Vendor'
            from tbl_users 
            INNER JOIN tbl_orderitems on tbl_orderitems.customerid = tbl_users.uid 
            INNER JOIN tbl_riderorder on tbl_riderorder.oredrinvoice = tbl_orderitems.invoice 
            INNER JOIN tbl_order on tbl_order.invoice = tbl_orderitems.invoice
            INNER JOIN tbl_users as vendor on vendor.uid = tbl_riderorder.assignby 
            where tbl_riderorder.riderid = '$Id' and tbl_order.status='In Process'");
        $itens = array();
        $index = 0;
        while ($cell = mysqli_fetch_array($rows)) 
        {
           $data=[
                    "Customer"=>$cell[0],
                    "contact"=>$cell[1],
                    "address"=>$cell[2],
                    "invoice"=>$cell[3],
                    "Vendor"=>$cell[4]
               ];
               array_push($itens,$data);
        }
        echo json_encode($itens);
?>
