
<?php
    include('db_connection.php');
    if($_GET['invoice']!='')
    {
        $invoice = $_GET['invoice'];
        $query = "update tbl_order set status='Delivered' where tbl_order.invoice='$invoice'";
        $row = UpdateQuery($query);
        if ($row == 1) 
        {
            $itens = array();
            $data=[
                    "message"=>'Your order has been delivered'
               ];
               array_push($itens,$data);
            echo json_encode($itens);              
        } 
    }   
    else
    {
        $itens = array();
            $data=[
                    "message"=>'Invoice Required'
               ];
               array_push($itens,$data);
            echo json_encode($itens);
    }
?>
