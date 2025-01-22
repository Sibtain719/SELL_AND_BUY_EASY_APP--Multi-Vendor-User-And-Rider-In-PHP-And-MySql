<?php
    session_start();
    include('db_connection.php');

    //print_r($_POST);
    $invoice = $_GET['invoice'];
  
     $obUser = $_SESSION['user'];
        $createdby = $obUser[2];
        $query = "update tbl_order set status= 'Cancel' WHERE invoice = $invoice";
        $row = UpdateQuery($query);
        if ($row == 1) 
        {
            
$rows =  ExecuteQuery("SELECT
                                                                           tbl_order.orderid ,
                                                                           tbl_order.orderdate,
                                                                           tbl_order.invoice ,
                                                                           tbl_order.paymentmethod,
                                                                           tbl_order.amount,
                                                                           tbl_order.status

                                                                        from tbl_order
                                                                        ");
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
                                                        <a  data-toggle="modal" data-target="#viewrider" title='.$cell[2].' onclick="GetRiderOrderCustomerDetail(this.title)" href="#">View Rider</a>
                                                    </td>
                                                   </tr>';
                                                }
                                                else if($cell[5] == "Ordered")
                                                {
                                                    $order_detail_cancel = $cell[2]; 

                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>' . $cell[5] . '</td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#addtask" title="'.$order_detail.'" onclick="SetupRider(this.title)">Assign Rider</a>

                                                        <a href="#" class="btn btn-default btn-xs" title="'.$order_detail_cancel.'" onclick="SetupCancel(this.title)">Cancel Order</a>

                                                    </td>
                                                   </tr>';
                                                }
                                                else if($cell[5] == "In Process")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>' . $cell[5] . '</td>
                                                    <td>
                                                        <a href="#">View Rider</a>
                                                    </td>
                                                   </tr>';
                                                }
                                                else if($cell[5] == "Order Delivered")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>' . $cell[5] . '</td>
                                                    <td>
                                                        <a href="#">View Rider</a>
                                                    </td>
                                                   </tr>';
                                                }
                                                else if($cell[5] == "Cancel")
                                                {
                                                    echo '<tr>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>' . $cell[5] . '</td>
                                                    <td>
                                                        <a href="#">Cancelled By Vendor</a>
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
