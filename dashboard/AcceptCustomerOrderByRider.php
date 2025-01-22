<?php
    session_start();
    include('db_connection.php');
    $invoice = $_GET['invoice'];
        $obUser = $_SESSION['user'];
        $createdby = $obUser[2];
        $query = "update tbl_order set status='In Process' where tbl_order.invoice='$invoice'";
        $row = UpdateQuery($query);
        if ($row == 1) 
        {
                    $rows =  ExecuteQuery("SELECT 
                                            tbl_order.orderid,
                                            tbl_order.orderdate,
                                            tbl_order.invoice,
                                            tbl_order.paymentmethod,
                                            tbl_order.amount,
                                            tbl_order.status
                                            from tbl_order
                                            INNER join 
                                            tbl_riderorder on tbl_riderorder.oredrinvoice = tbl_order.invoice
                                            where 
                                            tbl_riderorder.riderid ='$createdby'"); 
                                            while ($cell = mysqli_fetch_array($rows))
                                            {
                                                $order_detail = $cell[2];
                                                if($cell[5] == "Assigned")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>' . $cell[5] . '</td>
                                                    <td>
                                                        <a  data-toggle="modal" class="btn btn-primary" data-target="#viewrider" title='.$cell[2].' onclick="GetOrderCustomerDetail(this.title)" href="#">Order Detail</a>
                                                         | 
                                                        <a  data-toggle="modal" class="btn btn-danger" data-target="#" title='.$cell[2].' onclick="CancelByRider(this.title)" href="#">Cancel Order</a>
                                                    </td>
                                                   </tr>';
                                                }
                                                if($cell[5] == "In Process")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>' . $cell[5] . '</td>
                                                    <td>
                                                        <a href="#" class="btn btn-success">Accepted</a>
                                                    </td>
                                                   </tr>';
                                                }
 
                                            }                                            
        } 
        else 
        {
            echo "Not Added";
        }
?>
