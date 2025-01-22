<?php
    include('../db_connection.php');
    if($_GET['invoice']!='')
    {
        $invoice = $_GET['invoice'];
        $query = "update tbl_order set status='In Process' where tbl_order.invoice='$invoice'";
        $row = UpdateQuery($query);
        if ($row == 1) 
        {
            $itens = array();
            $data=[
                    "message"=>'Accepted'
               ];
               array_push($itens,$data);
            echo json_encode($itens);              
        } 
        else 
        {
            $itens = array();
            $data=[
                    "message"=>'Not accepted due to network issue'
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
