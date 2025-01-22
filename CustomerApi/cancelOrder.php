<?php
    include('db_connection.php');
    $invoice   = $_REQUEST['invoice'];
    $row = UpdateQuery("delete from tbl_order where invoice='$invoice'");
    $arr=array();      
    if($row > 0)
    {
         $row1 = UpdateQuery("delete from tbl_orderitems where invoice='$invoice'");
         if($row > 0)
         {
             $data = [
	                    "status"=> 'canceled'
	                 ];
	         array_push($arr,$data);
             echo json_encode($arr);
         }
         else
         {
             $data = [
	                    "status"=> 'cant cancel order'
	                 ];
	         array_push($arr,$data);
             echo json_encode($arr);
         }
    }
    else
    {
        $data = [
	              "message"=> 'failed'
	            ];
	    array_push($arr,$data);
        echo json_encode($arr);
    }
?>
