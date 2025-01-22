
<?php
        include('db_connection.php');
        $Invoice=$_GET['invoice'];
        //$rows =  ExecuteQuery("SELECT tbl_items.itemname,tbl_items.price,tbl_orderitems.qty,sum(tbl_items.price*tbl_orderitems.qty) as 'total' FROM tbl_orderitems INNER JOIN tbl_items ON tbl_items.id = tbl_orderitems.itemid WHERE tbl_orderitems.invoice='$Invoice' GROUP BY tbl_items.itemname,tbl_items.price,tbl_orderitems.qty");
        $rows = ExecuteQuery("SELECT 
                        		tbl_items.itemname,
                        		tbl_items.price,
                                tbl_orderitems.qty,
                                sum(tbl_items.price*tbl_orderitems.qty) as 'total',
                                vendor.address as 'ven_add',
                                vendor.latitude_val as 'ven_lat',
                                vendor.longitude_val as 'ven_lon',
                                cus.address as 'cus_add',
                                cus.latitude_val as 'cus_lat',
                                cus.longitude_val as 'cus_lon',
                                tbl_orderitems.orderitemdate,
                                tbl_order.deliver_address,
                                tbl_order.cus_lat,
                                tbl_order.cus_lat
                                
                                FROM tbl_orderitems 
                                INNER JOIN tbl_items ON tbl_items.id = tbl_orderitems.itemid
                                INNER JOIN tbl_users as vendor ON vendor.uid = tbl_orderitems.ordergeneratedby
                                INNER JOIN tbl_users as cus ON cus.uid = tbl_orderitems.customerid
                                INNER JOIN tbl_order on tbl_order.invoice = tbl_orderitems.invoice
                                WHERE tbl_orderitems.invoice='$Invoice' 
                                GROUP BY 
                                tbl_items.itemname,
                                tbl_items.price,
                                tbl_orderitems.qty,
                                vendor.address,
                                vendor.latitude_val,
                                vendor.longitude_val,
                                cus.address,
                                cus.latitude_val,
                                cus.longitude_val, 
                                tbl_orderitems.orderitemdate
                            ");
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
                    "total"=>$cell[3],
                    "vadd"=>$cell[4],
                    "vlat"=>$cell[5],
                    "vlon"=>$cell[6],
                    "cadd"=>$cell[7],
                    "clat"=>$cell[8],
                    "clon"=>$cell[9],
                    "odate"=>$cell[10],
                    "invoice"=>$Invoice,
                    "del_add"=>$cell[11],
                    "del_lat"=>$cell[12],
                    "del_lon"=>$cell[13]
                    
               ];
               array_push($itens,$data);
               $sn++;
        }
        echo json_encode($itens);
?>
