<?php
        $con = mysqli_connect('localhost:3306', 'root', '', 'food_db');
        $id = $_GET['shopid'];
        $rows =  mysqli_query($con,"SELECT SUM(tbl_ratings.rating)/count(tbl_ratings.id) 
                FROM 
                tbl_ratings 
                INNER JOIN tbl_users on tbl_users.uid = tbl_ratings.shop_id
                where shop_id='$id'");
        $count = mysqli_num_rows($rows);
        $rating = array();
        if($count > 0)
        {
            $cell = mysqli_fetch_array($rows);
            if($cell[0]!=null)
            {
                $data=
                [
                    "status"=>'OK',
                    "rating"=>$cell[0]
                ];
            }
            else
            {
                $data=
                [
                    "status"=>'OK',
                    "rating"=>'0.0'
                ];
            }
        }
        else
        {
                $data=
                [
                    "status"=>'NO',
                    "rating"=>'0.0'

                ];
        }      
        array_push($rating,$data);
        echo json_encode($rating);
?>

