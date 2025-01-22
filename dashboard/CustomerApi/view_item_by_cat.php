<?php
        session_start();
        include('../db_connection.php');
        $Id=$_GET['shop_id'];
        //print_r($con);
        $curr_user = $_SESSION['user'];
        $rows =  ExecuteQuery("SELECT tbl_items.id, tbl_category.c_name, tbl_items.itemname, tbl_items.price, tbl_items.picture FROM tbl_items INNER JOIN tbl_category ON tbl_category.id=tbl_items.category_id WHERE tbl_items.createdby=$Id AND tbl_category.createdby=$Id");
        $itens = array();
        $index = 0;
        while ($cell = mysqli_fetch_array($rows)) 
        {
           $data=[
                    "item_id"=>$cell[0],
                    "category"=>$cell[1],
                    "item"=>$cell[2],
                    "price"=>$cell[3],
                    "picture"=>$cell[4]
               ];
               
               array_push($itens,$data);
        }
        
        echo json_encode($itens);
?>
