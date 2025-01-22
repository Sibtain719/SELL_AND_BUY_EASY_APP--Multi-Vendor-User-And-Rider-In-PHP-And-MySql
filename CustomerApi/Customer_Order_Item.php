<?php
        include('db_connection.php');
        $CUS_ID     =$_GET['CID'];
        $CUS_OR     =$_GET['Order'];
        $amount     =$_GET['total'];
        $shop_id    =$_GET['shop_id'];
        $lat_id     =$_GET['lat'];
        $lng_id     =$_GET['lng'];
        $cus_add    =$_GET['cus_add'];
        // Break String into array
        $ArrItem = (explode("-",$CUS_OR));
        // Count Items
        $Total_Items = count($ArrItem);
        $invoice  = NewInvoice();
        $paymentMethod = "cash";
        $orderdate  = date("Y-m-d");
        $Status = "Ordered";
        // Now Create Invoice By Order Number
        if($lat_id !='' && $lng_id !='')
        {
            $query_order= "insert into tbl_order values(null,
                        '$orderdate',
                        '$invoice',
                        '$paymentMethod',
                        '$amount',
                        'Ordered',
                        '$lat_id',
                        '$lng_id',
                        '$cus_add')";
        }
        else
        {
            $query_order= "insert into tbl_order values(null,
                        '$orderdate',
                        '$invoice',
                        '$paymentMethod',
                        '$amount',
                        'Ordered',
                        '',
                        '',
                        '$cus_add')";
        }
        $IsSuccess  = InsertQuery($query_order);
        $items = array();
        $dt = $Total_Items;
        if($IsSuccess>0)
        {
            $flag = false;
            
            for($i = 0; $i < $Total_Items-1; $i++)
            {
                    $data = (explode(",",$ArrItem[$i]));
                    // Now Add into Order Table
                    $itemid             = $data[0];
                    $price              = $data[3];
                    $qty                = $data[2];
                    $amount             = ($data[3]*$data[2]);
                    $customerid         = $CUS_ID;
                    $orderitemdate      = $orderdate;
                    $ordergeneratedby   = $shop_id;
                    $ordercreateddate   = $orderdate;
                    $query_orderitems = "INSERT INTO tbl_orderitems VALUES(null,'$invoice','$itemid','$price','$qty','$amount','$customerid','$orderitemdate','Ordered','$ordergeneratedby','$ordercreateddate')";
                    $IsSuccess  = InsertQuery($query_orderitems); 
                    if($IsSuccess>0)
                    {
                        $flag = true;
                    }
            }
            if($flag == true)
            {
                // customer deliver address
                // shop vendor address pickup location
            $query = "select 
            		DISTINCT  tbl_order.invoice,
            		tbl_order.cus_lat as 'c_lat',
                    tbl_order.cus_lng as 'c_lon',
                    tbl_order.deliver_address as 'c_address',
                    tbl_users.latitude_val as 'v_lat',
                    tbl_users.longitude_val as 'v_lon',
                    tbl_users.address as 'v_address',
                   
                    tbl_order.orderdate
                    from tbl_order
                    INNER JOIN tbl_orderitems on tbl_orderitems.invoice = tbl_order.invoice
                    INNER JOIN tbl_users on tbl_users.uid = tbl_orderitems.customerid
                    INNER join tbl_users as vendor on vendor.uid = tbl_orderitems.ordergeneratedby
                    WHERE tbl_order.invoice = '$invoice'";
                
            $row = ExecuteQuery($query);
            $obj = Mysqli_fetch_array($row);
                
                 $data=[
                    "IsSuccess"=>'OK',
                    "invoice"=>$invoice,
                    "detail"=>$dt,
                    "c_lat"=>$obj[1],
                    "c_lon"=>$obj[2],
                    "c_add"=>$obj[3],
                    "v_lat"=>$obj[4],
                    "v_lon"=>$obj[5],
                    "v_add"=>$obj[6],
                    "o_dat"=>$obj[7]
               ];
               array_push($items,$data);
            }
        }
        else
        {
              $data=[
                    "IsSuccess"=>'NO',
                    "invoice"=>''
               ];
               array_push($items,$data);
        }
        echo json_encode($items);


  ?>
