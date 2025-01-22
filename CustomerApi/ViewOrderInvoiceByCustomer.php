<?php
        include('db_connection.php');
        if(isset($_GET['cid']))
        {
            $cid=$_GET['cid'];
            $rows =  ExecuteQuery("
            select COUNT(tbl_orderitems.orderitemid), tbl_orderitems.invoice, vendor.name as 'Vendor', vendor.uid as 'shop_id', vendor.logo as 'shop_logo' 
            from tbl_orderitems 
            INNER JOIN tbl_items on tbl_items.id = tbl_orderitems.itemid 
            INNER join tbl_users as vendor on vendor.uid = tbl_orderitems.ordergeneratedby 
            INNER JOIN tbl_order on tbl_order.invoice = tbl_orderitems.invoice
            where tbl_orderitems.customerid = '$cid' GROUP by tbl_orderitems.invoice ORDER BY 'shop_logo' ASC");
            $orders = array();
            $index = 0;
          
            while ($cell = mysqli_fetch_array($rows)) 
            {
               $data=[
                        "total"=>$cell[0],
                        "invoice"=>$cell[1],
                        "vendor"=>$cell[2],
                        "shop_id"=>$cell[3],
                        "shop_logo"=>$cell[4]
                  ];
                   array_push($orders,$data);
            }
            echo json_encode($orders);
        }
        else
        {
            echo 'Customer Id Required';
        }
            
?>