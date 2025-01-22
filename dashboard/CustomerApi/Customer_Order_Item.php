<?php
        include('../db_connection.php');
        $CUS_ID =$_GET['CID'];
        $CUS_OR =$_GET['Order'];
        $amount  =$_GET['total'];
        $shop_id =$_GET['shop_id'];
        // Break String into array
        $ArrItem = (explode("-",$CUS_OR));
        
        // Count Items
        $Total_Items = count($ArrItem);
        $invoice  = NewInvoice();
        $paymentMethod = "cash";
        $orderdate  = date("Y-m-d");
        $Status = "In Process";
        // Now Create Invoice By Order Number
        
        $query_order= "insert into tbl_order values(null,'$orderdate','$invoice','$paymentMethod','$amount','$status')";
        $IsSuccess  = InsertQuery($query_order);
        $items = array();
                         $data=[
                    "IsSuccess"=>'OK',
                    "invoice"=>$invoice
               ];
               array_push($items,$data);

        if($IsSuccess>0)
        {
            $flag = false;
            
            for($i = 0; $i < $Total_Items; $i++)
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
                 $data=[
                    "IsSuccess"=>'OK',
                    "invoice"=>$invoice
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
