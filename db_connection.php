<?php
// Database connection
$con = mysqli_connect('localhost:3306', 'root', '', 'food_db');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

// Function to generate a new invoice number
if (!function_exists('NewInvoice')) {
    function NewInvoice() {
        global $con;
        $query = mysqli_query($con, 'SELECT MAX(invoice) FROM tbl_order');
        $rows = mysqli_fetch_array($query);
        if ($rows[0] > 0) {
            $updated = $rows[0] + 1;
            return $updated;
        } else {
            return 1001;
        }
    }
}

// Function to execute an insert query
if (!function_exists('InsertQuery')) {
    function InsertQuery($query) {
        global $con;
        $row = mysqli_query($con, $query);
        return $row ? true : false;
    }
}

// Function to execute a delete query
if (!function_exists('DeleteQuery')) {
    function DeleteQuery($query) {
        global $con;
        $row = mysqli_query($con, $query);
        return $row ? true : false;
    }
}

// Function to execute an update query
if (!function_exists('UpdateQuery')) {
    function UpdateQuery($query) {
        global $con;
        $row = mysqli_query($con, $query);
        return $row ? true : false;
    }
}

// Function to execute a login query
if (!function_exists('LoginQuery')) {
    function LoginQuery($username, $password) {
        global $con;
        $query = "SELECT
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
            FROM tbl_role
            INNER JOIN tbl_users ON tbl_users.role_id = tbl_role.rid
            WHERE tbl_users.username = '$username' AND tbl_users.password = '$password' AND tbl_users.status = 'active'";
        $IsRow = mysqli_query($con, $query);
        $Chk = mysqli_num_rows($IsRow);
        if ($Chk > 0) {
            $Obj = mysqli_fetch_array($IsRow);
            return $Obj;
        } else {
            return "Invalid Username or Password";
        }
    }
}

// Function to execute a general query
if (!function_exists('ExecuteQuery')) {
    function ExecuteQuery($query) {
        global $con;
        $Isrow = mysqli_query($con, $query);
        return $Isrow;
    }
}

// Function to calculate vendor rating
if (!function_exists('VendorRating')) {
    function VendorRating($createdby) {
        global $con;
        $query1 = "SELECT COUNT(*) FROM tbl_rating
            INNER JOIN tbl_orderitems ON tbl_orderitems.invoice = tbl_rating.invoice_orderid
            INNER JOIN tbl_users ON tbl_users.uid = tbl_orderitems.customerid
            INNER JOIN tbl_items ON tbl_items.id = tbl_orderitems.itemid
            WHERE tbl_items.createdby = '$createdby'";
        $query2 = "SELECT SUM(tbl_rating.rating) FROM tbl_rating
            INNER JOIN tbl_orderitems ON tbl_orderitems.invoice = tbl_rating.invoice_orderid
            INNER JOIN tbl_users ON tbl_users.uid = tbl_orderitems.customerid
            INNER JOIN tbl_items ON tbl_items.id = tbl_orderitems.itemid
            WHERE tbl_items.createdby = '$createdby'";
        $IsRow1 = mysqli_query($con, $query1);
        if (mysqli_num_rows($IsRow1) > 0) {
            $fir = mysqli_fetch_array($IsRow1);
            $a = $fir[0];
            $IsRow2 = mysqli_query($con, $query2);
            $sec = mysqli_fetch_array($IsRow2);
            $b = $sec[0];
            $c = $b / $a;
            return $c;
        } else {
            return 0.0;
        }
    }
}

// Function to update user profile
if (!function_exists('UpdateProfile')) {
    function UpdateProfile($uid) {
        global $con;
        $query = "SELECT
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
            FROM tbl_role
            INNER JOIN tbl_users ON tbl_users.role_id = tbl_role.rid
            WHERE tbl_users.uid='$uid' AND tbl_users.status = 'active'";
        $IsRow = mysqli_query($con, $query);
        $Chk = mysqli_num_rows($IsRow);
        if ($Chk > 0) {
            $Obj = mysqli_fetch_array($IsRow);
            return $Obj;
        } else {
            return "Invalid Username or Password";
        }
    }
}
?>
