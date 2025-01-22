<?php
     session_start();
    include('db_connection.php');
    ini_set('upload_max_filesize','50MB');
     $obUser    = $_SESSION['user'];
     $createdby = $obUser[2];

    $item_id        = $_POST['item_id'];
    $item_cid       = $_POST['item_cid'];
    $item_name      = $_POST['item_name'];
    $item_price     = $_POST['item_price'];
    $item_qty       = $_POST['item_qty'];
    $item_status    = $_POST['item_status'];
    $image          = $_FILES['item_image']['name'];
    $temp           = $_FILES['item_image']['tmp_name'];
    $createddate    = date('Y-m-d');
    if($image!='')
    {
        $query = "update tbl_items set category_id='$item_cid',itemname='$item_name', price='$item_price', 
        qty='$item_qty', status='$item_status', picture='$image' where id='$item_id'";
     }
     else
     {
        $query = "update tbl_items set category_id='$item_cid',itemname='$item_name', price='$item_price', 
        qty='$item_qty', status='$item_status' where id='$item_id'";
     }
        $row = InsertQuery($query);
        if ($row == 1)
        { 
            // upload image in folder
            move_uploaded_file($temp, "../item/".$image);
            header("location:F_item.php?q=Item Update");
        }
        else
        {
            header("location:F_item.php?q=Item Not Update");
        }
?>
