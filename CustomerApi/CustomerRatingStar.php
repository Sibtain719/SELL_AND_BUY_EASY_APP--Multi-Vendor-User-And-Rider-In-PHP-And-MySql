<?php

    $con = mysqli_connect('localhost:3306', 'root', '', 'food_db');

    //include('db_connection.php');
    $rating     = $_REQUEST['rating'];
    $cus_id     = $_REQUEST['cus_id'];
    $shop_id    = $_REQUEST['shop_id'];
    $ratdat     = date('Y-m-d');
  
   // echo $name.'-'.$email.'-'.$contact;
    $createddate = date('Y-m-d');
    $query = "INSERT INTO tbl_ratings VALUES(null,'$rating','$cus_id','$shop_id','$ratdat')";
	$row = mysqli_query($con,$query);
    $obj = array();
	if ($row == 1) 
    {
      $data=[
                    "status"=>'true',
            ];
            array_push($obj,$data);
	} 
	else 
	{
	$data=[
                    "status"=>'false',
            ];
            array_push($obj,$data);
	}
	echo json_encode($obj);
?>
