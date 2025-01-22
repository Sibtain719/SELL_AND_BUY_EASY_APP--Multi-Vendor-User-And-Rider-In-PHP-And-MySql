<?php
$con = mysqli_connect('localhost:3306', 'root', '', 'food_db');
function NewInvoice()
{
	global $con;
	$query = mysqli_query($con,'select max(invoice) from tbl_order');
	$rows  = mysqli_fetch_array($query);
	if($rows[0]>0)
	{
		$updated = $rows[0] + 1;
		return $updated;
	}         
	else
	{
		return 1001;
	}    
}
function InsertQuery($query)
{
	global $con;
	$row = mysqli_query($con, $query);
	$IsSuccess = $row == 1 ? true : false;
	return $IsSuccess;
}
function DeleteQuery($query)
{
	global $con;
	$row = mysqli_query($con, $query);
	$IsSuccess = $row == 1 ? true : false;
	return $IsSuccess;
}
function UpdateQuery($query)
{
	global $con;
	$row = mysqli_query($con, $query);
	$IsSuccess = $row == 1 ? true : false;
	return $IsSuccess;
}
function LoginQuery($username, $password)
{
	global $con;
	$query =  "SELECT
	tbl_role.rid,
	tbl_role.name,
	tbl_users.uid,
	tbl_users.name,
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
	if ($Chk > 0) {
		$Obj = mysqli_fetch_array($IsRow);
		return $Obj;
	} else {
		return "Invalid Username or Password";
	}
}
function ExecuteQuery($query)
{
	global $con;
	$Isrow = mysqli_query($con,$query);
	return $Isrow;
}
function VendorRating($createdby)
{
	global $con;
	$query1 =  "SELECT
	count(*)
	from tbl_rating
	INNER JOIN tbl_orderitems on tbl_orderitems.invoice = tbl_rating.invoice_orderid
	INNER JOIN tbl_users on tbl_users.uid = tbl_orderitems.customerid
	INNER JOIN tbl_items on tbl_items.id = tbl_orderitems.itemid
	where tbl_items.createdby ='$createdby'";
	$query2 =  "SELECT
	sum(tbl_rating.rating)
	from tbl_rating
	INNER JOIN tbl_orderitems on tbl_orderitems.invoice = tbl_rating.invoice_orderid
	INNER JOIN tbl_users on tbl_users.uid = tbl_orderitems.customerid
	INNER JOIN tbl_items on tbl_items.id = tbl_orderitems.itemid
	where tbl_items.createdby ='$createdby'";

	$IsRow1 = mysqli_query($con, $query1);
	if(mysqli_num_rows($IsRow1)>0)
	{
		$fir = mysqli_fetch_array($IsRow1);
		$a = $fir[0];
		$IsRow2 = mysqli_query($con, $query2);
		$sec = mysqli_fetch_array($IsRow2);
		$b =$sec[0];
		$c = $b/$a;
		return $c;
	}
	else
	{
		return 0.0;
	}
}
