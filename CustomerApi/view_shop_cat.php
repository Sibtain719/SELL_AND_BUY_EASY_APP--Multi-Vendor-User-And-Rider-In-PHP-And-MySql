<?php
        $con = mysqli_connect('localhost:3306', 'root', '', 'food_db');

        $rows =  mysqli_query($con,"SELECT * FROM tbl_users where status = 'active' and role_id =3");
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

