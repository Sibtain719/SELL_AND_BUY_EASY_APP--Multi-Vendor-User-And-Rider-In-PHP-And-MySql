
<?php
    session_start();
    include('db_connection.php');
        $invoice = $_GET['invoice'];
  
        $obUser = $_SESSION['user'];
        $createdby = $obUser[2];

        echo '<table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="info">
                                                <th>S.No</th>
                                                <th>Invoice </th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Order Date</th>

                                            </tr>
                                        </thead>';
                                            $rows =  ExecuteQuery("select 
                                                    tbl_orderitems.invoice,
                                                    tbl_items.itemname,
                                                    tbl_orderitems.price,
                                                    tbl_orderitems.qty,
                                                    tbl_orderitems.amount,
                                                    tbl_orderitems.ordercreateddate
                                                    FROM 
                                                    tbl_orderitems
                                                    INNER JOIN 
                                                    tbl_items on tbl_items.id = tbl_orderitems.itemid
                                                                        ");
                                            $sno=1;
                                            $total =0;
                                            while ($cell = mysqli_fetch_array($rows))
                                            {
                                                    echo '<tr>
                                                    <td>' . $sno . '</td>
                                                    <td>' . $cell[0] . '</td>
                                                    <td>' . $cell[1] . '</td>
                                                    <td>' . $cell[2] . '</td>
                                                    <td>' . $cell[3] . '</td>
                                                    <td>' . $cell[4] . '</td>
                                                    <td>' . $cell[5] . '</td>
                                                   </tr>';
                                                   $total +=$cell[4];
                                                   $sno++;
                                            }            
                        
   
echo '
        <tr style="background-color:black;">
            <td colspan="5" align="right" style="color:yellow">
            Sub-Total</td>
            <td colspan="2" style="color:yellow">'.$total.'</td>
        </tr>
        </table>';

 // Now Customer Information Here
    $rows_cus =  ExecuteQuery("SELECT 
        tbl_users.uid,
        tbl_users.name,
        tbl_users.contact,
        tbl_users.address,
        tbl_role.name as 'Role Type'
        FROM tbl_users
        INNER JOIN tbl_orderitems on tbl_orderitems.customerid = tbl_users.uid
        INNER JOIN tbl_role on tbl_role.rid = tbl_users.role_id
        where tbl_orderitems.invoice=$invoice");
    $info = mysqli_fetch_array($rows_cus);
    echo '<table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="info">
                                                <th>Customer Code</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>'.$info[0].'</td>
                                            <td>'.$info[1].'</td>
                                            <td>'.$info[2].'</td>
                                            <td>'.$info[3].'</td>
                                            <td>'.$info[4].'</td>
                                        </tr>';

echo '
      <a  class="btn btn-sm btn-primary" title='.$invoice.' onclick="AcceptOrder(this.title)" href="#">Accept Order</a>';
?>
