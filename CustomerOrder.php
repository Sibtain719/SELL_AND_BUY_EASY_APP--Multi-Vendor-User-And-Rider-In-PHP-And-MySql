<?php
    // code to check if user session alive
    // end user checking code
    session_start();
    include('dashboard/db_connection.php');
    //print_r($con);
    $uri = $_SESSION["url"];
    $lat        = $_POST['lat'];
    $lng        = $_POST['lng'];
    //echo $uri;
    if(!isset($_SESSION['customer']))
    {
        header("location:dashboard/login.php");
    }
    else
    {
        if(isset($_SESSION['cart']))
        {
            $amount     = $_SESSION['total'];
            $orderdate  = date("Y-m-d");
            $invoice    = NewInvoice();
            $status     = 'Ordered'; 
           
            if($lat=='' && $lng=='')
            {
                $lat='0';
                $lng = '0';
            }
            $query_order= "insert into tbl_order values(null,'$orderdate','$invoice','cash','$amount','$status','$lat','$lng','')";
            $IsSuccess  = InsertQuery($query_order);
            //echo $IsSuccess;

            if($IsSuccess>0)
            {
                $item_list = $_SESSION['cart'];
                $flag = false;
                foreach($item_list as $obj)
                {
                    $data               = explode(',',$obj);
                    $itemid             = $data[0];
                    $price              = $data[3];
                    $qty                = $data[4];
                    $amount             = ($data[3]*$data[4]);
                    $customerid         = $_SESSION['customer'][2];
                    $orderitemdate      = $orderdate;
                    $ordergeneratedby   = $data[6];
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
                    $_SESSION["cart"] = '';
                    $_SESSION["total"] = '0';
                    $_SESSION['invoice_code'] = $invoice;
                    header("location:orderlist.php");
                   
                }
            }
            else
            {
                echo "Invoice Issue";
            }
        }
        else
        {
            echo "cart empty";
        }
    }
?>