<?php
// Rider Information Query
// Customer Information Query
// Order Detail Information Query
include('db_connection.php');
$invoice  = $_GET['invoice'];
$Query_Bridge = ExecuteQuery("SELECT * from tbl_riderorder where oredrinvoice='$invoice'");
$OrderData = mysqli_fetch_array($Query_Bridge);
$Rider_ID = $OrderData['riderid'];
$Customer_ID = $OrderData['customerid'];
$Query_Rider =  ExecuteQuery("SELECT
                        tbl_users.uid,
                        tbl_users.name as 'Rider Name',
                        tbl_users.email,
                        tbl_users.contact,
                        tbl_users.username,
                        tbl_users.picture,
                        tbl_users.address
                        FROM tbl_users
                        where tbl_users.uid='$Rider_ID'
                            ");
$Rider_Info = mysqli_fetch_array($Query_Rider);
$Query_Customer =  ExecuteQuery("SELECT
                        tbl_users.uid,
                        tbl_users.name as 'Customer Name',
                        tbl_users.email,
                        tbl_users.contact,
                        tbl_users.username,
                        tbl_users.picture,
                        tbl_users.address
                        FROM tbl_users
                        where tbl_users.uid='$Customer_ID'
                            ");
$Customer_Info = mysqli_fetch_array($Query_Customer);
echo '<table class="table table-bordered table-striped table-hover">
                <tr>
                    <td>Rider ID</td>
                    <td>Rider Name</td>
                    <td>Email</td>
                    <td>Contact</td>
                    <td>Username</td>
                    <td>Picture</td>
                    <td>Address</td>
                </tr>
                <tr>
                    <td>'.$Rider_Info[0].'</td>
                    <td>'.$Rider_Info[1].'</td>
                    <td>'.$Rider_Info[2].'</td>
                    <td>'.$Rider_Info[3].'</td>
                    <td>'.$Rider_Info[4].'</td>
                    <td>'.$Rider_Info[5].'</td>
                    <td>'.$Rider_Info[6].'</td>
                </tr>
                <tr>
                    <td >Customer ID</td>
                    <td >Customer Name</td>
                    <td >Email</td>
                    <td >Contact</td>
                    <td >Username</td>
                    <td >Picture</td>
                    <td >Address</td>
                </tr>
                <tr>
                    <td>'.$Customer_Info[0].'</td>
                    <td>'.$Customer_Info[1].'</td>
                    <td>'.$Customer_Info[2].'</td>
                    <td>'.$Customer_Info[3].'</td>
                    <td>'.$Customer_Info[4].'</td>
                    <td>'.$Customer_Info[5].'</td>
                    <td>'.$Customer_Info[6].'</td>
                </tr>
</table>
<table class="table table-bordered table-striped table-hover">
                <tr>
                    <td>ID</td>
                    <td>Invoice</td>
                    <td>Item</td>
                    <td>Price</td>
                    <td>Qty</td>
                    <td>Amount</td>
                    <td>Order Date</td>
                    <td>Order Issue Date</td>
                </tr>';
$Query_Order_ItemList = ExecuteQuery("SELECT
                        tbl_items.id,
                        tbl_items.itemname,
                        tbl_orderitems.invoice,
                        tbl_orderitems.price,
                        tbl_orderitems.qty,
                        tbl_orderitems.amount,
                        tbl_orderitems.orderitemdate,
                        tbl_orderitems.ordercreateddate
                        from tbl_orderitems
                        INNER JOIN tbl_items on tbl_items.id = tbl_orderitems.itemid
                        INNER JOIN tbl_order on tbl_order.invoice = tbl_orderitems.invoice
                        where tbl_orderitems.invoice='$invoice' and tbl_order.status = 'Assigned'
                        ");
            while ($cell = mysqli_fetch_array($Query_Order_ItemList))
            {
                    echo '<tr>
                    <td>' . $cell[0] . '</td>
                    <td>' . $cell[2] . '</td>
                    <td>' . $cell[1] . '</td>
                    <td>' . $cell[3] . '</td>
                    <td>' . $cell[4] . '</td>
                    <td>' . $cell[5] . '</td>
                    <td>' . $cell[6] . '</td>
                    <td>' . $cell[7] . '</td>
                </tr>';

            }
echo '</table>';

?>