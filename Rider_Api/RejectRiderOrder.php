<?php
    include('db_connection.php');
    if($_GET['invoice']!='')
    {
        $invoice = $_GET['invoice'];
        $query = "update tbl_order set status='Rejected' where tbl_order.invoice='$invoice'";
        $row = UpdateQuery($query);
        if ($row == 1) 
        {
            $itens = array();
            $data=[
                    "message"=>'Order Rejected'
               ];
               array_push($itens,$data);
            echo json_encode($itens);              
        } 
        else 
        {
            $itens = array();
            $data=[
                    "message"=>'Server not responding,Try again.'
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
