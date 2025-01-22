<?php
    include('db_connection.php');
    $pass   = $_REQUEST['newpass'];
    $urid   = $_REQUEST['uid'];
    


    $row = UpdateQuery("update tbl_users set password='$pass' where uid='$urid'");
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
