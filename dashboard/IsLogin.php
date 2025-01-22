<?php
session_start();
include('db_connection.php');
$user = $_POST['user'];
$pass = $_POST['pass'];

if ($user == '')
{
	header("location:login.php?q= enter username");
} else if ($pass == '')
{
	header("location:login.php?q= enter password");
} else
{
	$obj = LoginQuery($user, $pass);
	if ($obj == "Invalid Username or Password")
	{
		echo $obj;
		header("location:login.php?q=" . $obj);
	}
	else
	{
		if ($obj[1] == "vendor" || $obj[1] == "Vendor")
		{
			$_SESSION['user'] = $obj;
			echo '<img src="load.gif">';
			header("refresh: 5; url=index.php");
		}
		else if ($obj[1] == "customer" || $obj[1] == "Customer")
		{
			$_SESSION['customer'] = $obj;
			//$url = $_SESSION["url"];
			header('location:..'.$url);
		}
		// else if ($obj[1] == "admin" || $obj[1] == "Admin")
		// {
		// 	$_SESSION['user'] = $obj;
		// 	echo '<img src="load.gif">';
		// 	header("refresh: 4; url=index.php");
		// }
		else if($obj[1] == "rider" || $obj[1] == "Rider")
		{
			$_SESSION['user'] = $obj;
			echo '<img src="load.gif">';
			header("refresh: 4; url=index.php");
		}
	}
}
