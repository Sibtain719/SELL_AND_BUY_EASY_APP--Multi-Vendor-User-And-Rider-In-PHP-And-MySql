<?php
    $con = mysqli_connect('localhost:3306', 'root', '', 'food_db');
    $username   = $_REQUEST['username'];
    $password   = $_REQUEST['password'];
    $arr=array();
	$query =  "SELECT 
	tbl_role.rid,
	tbl_role.name,
	tbl_users.uid,
	tbl_users.name as customer_rider,
	tbl_users.email,
	tbl_users.contact,
	tbl_users.username,
	tbl_users.picture,
	tbl_users.status,
	tbl_users.createddate,
	tbl_users.address
	from tbl_role
	INNER JOIN tbl_users on tbl_users.role_id = tbl_role.rid
	where tbl_users.username = '$username' and tbl_users.password = '$password' and tbl_users.status = 'active'";
	$IsRow = mysqli_query($con, $query);
	$Chk   = mysqli_num_rows($IsRow);
	if ($Chk > 0) 
	{
		$obj = mysqli_fetch_array($IsRow);
	    if($obj["name"]=="customer" || $obj["name"]=="Customer")
	    {
	        $data = [
	                    "rid"=> $obj["rid"]    ,
	                    "name"=>   $obj["name"]  ,
	                    "uid"=>     $obj["uid"],
	                    "customer_rider"=>     $obj["customer_rider"],
	                    "email"=>     $obj["email"],
	                    "contact"=>     $obj["contact"],
	                    "username"=>     $obj["username"],
	                    "picture"=>     $obj["picture"],
	                    "status"=>     $obj["status"],
	                    "createddate"=>     $obj["createddate"],
	                     "address"=> $obj["address"]
	                ];
	                array_push($arr,$data);
	      
	    }
	    
	    else if($obj["name"]=="rider" || $obj["name"]=="Rider")
	    {
	          $data = [
	                    "rid"=> $obj["rid"]    ,
	                    "name"=>   $obj["name"]  ,
	                    "uid"=>     $obj["uid"],
	                    "customer_rider"=>     $obj["customer_rider"],
	                    "email"=>     $obj["email"],
	                    "contact"=>     $obj["contact"],
	                    "username"=>     $obj["username"],
	                    "picture"=>     $obj["picture"],
	                    "status"=>     $obj["status"],
	                    "createddate"=>     $obj["createddate"],
	                     "address"=> $obj["address"]
	                ];
	                array_push($arr,$data);
	       
	    }
		

        echo json_encode($arr);
	        
	} 
	else
	{
	    	$data=["status"=>"invalid user or password"];
	        array_push($arr,$data);
	        echo json_encode($arr);
	}
?>
