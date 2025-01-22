
<?php
        include('../db_connection.php');
        $Invoice=$_GET['invoice'];
        //echo $Invoice;
        //print_r($con);
        $rows =  ExecuteQuery("SELECT tbl_items.itemname,tbl_items.price,tbl_orderitems.qty,sum(tbl_items.price*tbl_orderitems.qty) as 'total' FROM tbl_orderitems INNER JOIN tbl_items ON tbl_items.id = tbl_orderitems.itemid WHERE tbl_orderitems.invoice='$Invoice' GROUP BY tbl_items.itemname,tbl_items.price,tbl_orderitems.qty");
        $itens = array();
        $index = 0;
        $sn=01;
        while ($cell = mysqli_fetch_array($rows)) 
        {
            
           $data=[
                    "sn"=>$sn,
                    "itemname"=>$cell[0],
                    "price"=>$cell[1],
                    "qty"=>$cell[2],
                    "total"=>$cell[3]
               ];
               array_push($itens,$data);
               $sn++;
        }
        echo json_encode($itens);
?>
