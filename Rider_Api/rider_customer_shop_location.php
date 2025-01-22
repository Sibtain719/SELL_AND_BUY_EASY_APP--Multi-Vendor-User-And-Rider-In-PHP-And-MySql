
<?php
        include('db_connection.php');
        $invoice=$_GET['invoice'];
        $cus =  ExecuteQuery("
                            SELECT 
         DISTINCT(tbl_users.contact),tbl_users.name, 
         tbl_order.cus_lat as 'cus_latitude',tbl_order.cus_lng as 'Cus_longitude', 
         tbl_order.deliver_address as 'cus_address',
         vendor.name as 'vendor', vendor.contact as 'vcontact',vendor.latitude_val as 'vlat',vendor.longitude_val as 'vlon'
        FROM tbl_order 
         INNER JOIN tbl_orderitems on tbl_orderitems.invoice = tbl_order.invoice 
         INNER JOIN tbl_riderorder on tbl_riderorder.oredrinvoice = tbl_orderitems.invoice 
         INNER JOIN tbl_users on tbl_users.uid = tbl_riderorder.customerid
         INNER JOIN tbl_users as vendor on vendor.uid = tbl_orderitems.ordergeneratedby
        where tbl_riderorder.oredrinvoice='$invoice'");
     
        $Cus_loc = mysqli_fetch_array($cus);
        $location = array();
        $data=[
                    "option"        => '1',
                    "contact"       =>$Cus_loc[0],
                    "name"          =>$Cus_loc[1],
                    "cus_latitude"  =>$Cus_loc[2],
                    "Cus_longitude" =>$Cus_loc[3],
                    "cus_address"   =>$Cus_loc[4],
                    "vendor"        =>$Cus_loc[5],
                    "vcontact"      =>$Cus_loc[6],
                    "vlat"          =>$Cus_loc[7],
                    "vlon"          =>$Cus_loc[8]
              ];
        array_push($location,$data);
        echo json_encode($location);
?>
