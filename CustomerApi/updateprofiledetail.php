<?php
    include('db_connection.php');
    $name   = $_REQUEST['name'];
    $addr   = $_REQUEST['address'];
    $urid   = $_REQUEST['uid'];
    


    $row = UpdateQuery("update tbl_users set name='$name',address='$addr' where uid='$urid'");
    $arr=array();      
    if($row > 0)
    {
         
        $data = [
	                    "message"=> 'success'
	               
	            ];
	                array_push($arr,$data);
         echo json_encode($arr);
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
