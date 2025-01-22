<?php
include('db_connection.php');

$role = $_POST['cname'];
$query = "insert into tbl_role values(null,'$role')";
$msg = InsertQuery($query);
if ($msg == true) {
    echo 'success';
} else {
    echo "failed";
}
