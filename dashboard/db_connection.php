<?php
// Establish database connection
$con = mysqli_connect('localhost', 'root', '', 'food_db');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to generate a new invoice number
function NewInvoice() {
    global $con;
    $query = "SELECT MAX(invoice) FROM tbl_order";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    return $row[0] > 0 ? $row[0] + 1 : 1001;
}

// Function to insert a record into the database
function InsertQuery($query) {
    global $con;
    return mysqli_query($con, $query);
}

// Function to delete a record from the database
function DeleteQuery($query) {
    global $con;
    return mysqli_query($con, $query);
}

// Function to update a record in the database
function UpdateQuery($query) {
    global $con;
    return mysqli_query($con, $query);
}

// Function to login a user
function LoginQuery($username, $password) {
    global $con;
    $stmt = mysqli_prepare($con, "
        SELECT tbl_role.rid, tbl_role.name, tbl_users.uid, tbl_users.name, tbl_users.email, 
               tbl_users.contact, tbl_users.username, tbl_users.picture, tbl_users.status, 
               tbl_users.createddate, tbl_users.address
        FROM tbl_role
        INNER JOIN tbl_users ON tbl_users.role_id = tbl_role.rid
        WHERE tbl_users.username = ? AND tbl_users.password = ? AND tbl_users.status = 'active'
    ");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_array($result);
    } else {
        return "Invalid Username or Password";
    }
}

// Function to execute a general query
function ExecuteQuery($query) {
    global $con;
    return mysqli_query($con, $query);
}

// Function to get vendor rating
function VendorRating($createdby) {
    global $con;
    
    // Calculate the total number of ratings
    $query1 = "
        SELECT COUNT(*)
        FROM tbl_rating
        INNER JOIN tbl_orderitems ON tbl_orderitems.invoice = tbl_rating.invoice_orderid
        INNER JOIN tbl_items ON tbl_items.id = tbl_orderitems.itemid
        WHERE tbl_items.createdby = ?
    ";
    
    // Calculate the sum of ratings
    $query2 = "
        SELECT SUM(tbl_rating.rating)
        FROM tbl_rating
        INNER JOIN tbl_orderitems ON tbl_orderitems.invoice = tbl_rating.invoice_orderid
        INNER JOIN tbl_items ON tbl_items.id = tbl_orderitems.itemid
        WHERE tbl_items.createdby = ?
    ";

    // Prepare and execute the first query
    $stmt1 = mysqli_prepare($con, $query1);
    mysqli_stmt_bind_param($stmt1, "s", $createdby);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    $count = mysqli_fetch_array($result1)[0];
    
    if ($count > 0) {
        // Prepare and execute the second query
        $stmt2 = mysqli_prepare($con, $query2);
        mysqli_stmt_bind_param($stmt2, "s", $createdby);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        $sum = mysqli_fetch_array($result2)[0];
        return $sum / $count;
    } else {
        return 0.0;
    }
}

// Function to update user profile information
function UpdateProfile($uid) {
    global $con;
    $stmt = mysqli_prepare($con, "
        SELECT tbl_role.rid, tbl_role.name, tbl_users.uid, tbl_users.name, tbl_users.email, 
               tbl_users.contact, tbl_users.username, tbl_users.picture, tbl_users.status, 
               tbl_users.createddate, tbl_users.address
        FROM tbl_role
        INNER JOIN tbl_users ON tbl_users.role_id = tbl_role.rid
        WHERE tbl_users.uid = ? AND tbl_users.status = 'active'
    ");
    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_array($result);
    } else {
        return "Invalid Username or Password";
    }
}
?>
