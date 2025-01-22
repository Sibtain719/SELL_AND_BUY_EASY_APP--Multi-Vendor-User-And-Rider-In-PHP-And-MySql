<?php

$con = mysqli_connect('localhost:3306', 'root', '', 'food_db');

    include('db_connection.php');
    $role_id    = $_REQUEST['Role_Id'];
    $name       = $_REQUEST['name'];
    $email      = $_REQUEST['email'];
    $username   = $_REQUEST['user'];
    $password   = $_REQUEST['password'];
    $contact    = $_REQUEST['contact'];
    $address    = $_REQUEST['address'];
   // echo $name.'-'.$email.'-'.$contact;
    $createddate = date('Y-m-d');

    $query = "insert into tbl_users values(null,'$role_id','$name','$email','$contact','$username','$password',null,'active',null,0,'$createddate','$address')";

	$row = mysqli_query($con,$query);
	if ($row == 1) 
    {
       echo 'Success';
	} 
	else 
	{
		echo 'Error';
	}
    

?>
