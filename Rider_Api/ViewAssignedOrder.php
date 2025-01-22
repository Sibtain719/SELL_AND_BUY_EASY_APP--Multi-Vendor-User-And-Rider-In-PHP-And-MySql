
<?php
        include('db_connection.php');
        $Id=$_GET['r_id'];
        //print_r($con);
        $rows =  ExecuteQuery("SELECT 
            DISTINCT tbl_orderitems.invoice, 
	        tbl_users.address, 
            tbl_orderitems.ordercreateddate
            from tbl_users 
            INNER JOIN tbl_orderitems on tbl_orderitems.customerid = tbl_users.uid 
            INNER JOIN tbl_riderorder on tbl_riderorder.oredrinvoice = tbl_orderitems.invoice 
            INNER JOIN tbl_order on tbl_order.invoice = tbl_orderitems.invoice
            where tbl_riderorder.riderid = '$Id' and tbl_order.status='Assigned';");
        $itens = array();
        $index = 0;
        while ($cell = mysqli_fetch_array($rows)) 
        {
           $data=[
                    "address"=>$cell[1],
                    "ordercreateddate"=>$cell[2],
                    "invoice"=>$cell[0]
               ];
               
               array_push($itens,$data);
        }
        
        echo json_encode($itens);
?>
