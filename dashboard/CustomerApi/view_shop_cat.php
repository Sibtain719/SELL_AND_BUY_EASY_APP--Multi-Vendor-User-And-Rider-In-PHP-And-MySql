<?php
        session_start();
        include('../db_connection.php');
        //print_r($con);
        $curr_user = $_SESSION['user'];
        $rows =  ExecuteQuery("SELECT * FROM tbl_users where status = 'active' and role_id =3");
        $shop = array();
        $index = 0;
        while ($cell = mysqli_fetch_array($rows)) 
        {
           $data=[
                    "shop_id"=>$cell[0],
                    "shop_name"=>$cell[2],
                    "shop_logo"=>$cell[9]
               ];
               
               array_push($shop,$data);
        }
        
        echo json_encode($shop);
?>

