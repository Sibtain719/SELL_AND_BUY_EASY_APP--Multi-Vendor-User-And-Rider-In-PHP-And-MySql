<?php
	session_start();
  include('dashboard/db_connection.php');
  $customer_id = $_SESSION['customer'][2];
  $invoice = $_SESSION['invoice_code'];
  $query = "SELECT 
                tbl_items.id,
                tbl_items.itemname,
                tbl_items.picture,
                tbl_orderitems.invoice,
                tbl_orderitems.price,
                tbl_orderitems.qty,
                tbl_orderitems.amount,
                tbl_orderitems.orderitemdate
                FROM tbl_orderitems
                INNER JOIN tbl_items on tbl_items.id = tbl_orderitems.itemid
                INNER join tbl_order on tbl_order.invoice = tbl_orderitems.invoice
                where tbl_orderitems.customerid = '$customer_id' and tbl_order.status = 'Process' and tbl_orderitems.invoice='$invoice' and tbl_order.invoice='$invoice'";
  //Item List Query;
  $rows = ExecuteQuery($query);
  // Order Detail Query
  // query for total orders by this customer
  /*$order_list_query = ExecuteQuery(
  "SELECT 
  count(tbl_order.orderid)
  FROM tbl_orderitems
  inner join tbl_users ON tbl_users.uid = tbl_orderitems.customerid
  INNER join tbl_order ON tbl_order.invoice = tbl_orderitems.invoice
  INNER join tbl_users as shop on shop.uid = tbl_orderitems.ordergeneratedby
  where tbl_users.uid = '$customer_id' and tbl_order.status = 'Process'");*/
  
  $order_list_query = ExecuteQuery("select count(DISTINCT tbl_orderitems.invoice) from tbl_orderitems 
INNER JOIN tbl_order on tbl_order.invoice = tbl_orderitems.invoice
where tbl_orderitems.customerid='$customer_id'"
);

  $Total_Order_Count = mysqli_fetch_array($order_list_query);

    // query for multiple orders by customer  with status process-delivered
  $query_invoices = "select DISTINCT tbl_order.invoice,tbl_order.status from tbl_order
  INNER JOIN tbl_orderitems on tbl_order.invoice = tbl_orderitems.invoice
  where tbl_orderitems.customerid = '$customer_id' order by invoice desc";  
  $INVOICE_list_query = ExecuteQuery($query_invoices);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="author" content="SABeasyappgrocery" />
    <meta name="email" content="SABeasyappgrocery@gmail.com" />
    <meta name="profile" content="https://SABeasyappgrocery.com" />
    <meta name="template" content="Ecomart" />
    <meta name="title" content="SABeasy - Grocery" />
    <meta
      name="keywords"
      content="html, SABeasy, SABeasy, shops, food, Grocery, shopping, simple, Grocery, single vendor, Grocery multipurpose, Grocery store, shop"
    />
    <title>SABeasy - Orderlist</title>
    <link rel="icon" href="images/favicon.png" />
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css" />
    <link rel="stylesheet" href="fonts/flaticon/grocery/flaticon.css" />
    <link rel="stylesheet" href="css/vendor/slick.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.css" />
    <link rel="stylesheet" href="css/custom/main.css" />
    <link rel="stylesheet" href="css/custom/orderlist.css" />
  </head>
  <body>
    <header class="header-part">
      <div class="container">
        <div class="header-left">
          <div class="header-icon-group">
            <button class="icon-nav"><i class="icofont-align-left"></i></button
            ><a class="header-logo" href="index.php"
              ><img src="logo2.png" alt="logo" /></a
            ><button class="icon-cross"><i class="icofont-close"></i></button>
          </div>
  
        </div>
     
        <div class="header-right">
          <div class="select-menu header-user">
          <?php
            if(isset($_SESSION['customer']))
            {
        ?>
           <img class="img" src="Profiles/<?php echo  $_SESSION['customer'][7] ?>" width="25" height="25" alt="user" style="border-radius:100%" />
            <span class="text">
        <?php 
            echo $_SESSION['customer'][3];
            ?></span>
            <?php
            }
            else
            {
            ?>
              <img class="img" src="images/user.png" alt="user" /><span class="text">Login</span>
               </div>
          <a href="dashboard/login.php">
          <div class="select-menu header-user">
            <img class="img" src="images/user.png" alt="user" /><span
              class="text">Vendor </span>
            
          </div>
          </a>
            <?php 
            }?>

        
        </div>
      </div>
    </header>
    <?php
      include('SidebarMenuLoginInfo.php');
    ?>
    <section
      class="single-banner"
      style="
        background: url(images/shop/banner/grocery/single-banner.jpg)
          no-repeat center;
        background-size: cover;
      "
    >
      <div class="container">
        <h2>your orderlist</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">orderlist</li>
        </ol>
      </div>
    </section>



    <section class="orderlist-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="orderlist-filter">
              <h3>total order <span>- (<?php echo $Total_Order_Count[0];?>)</span></h3>
              <!--<div class="filter-short">-->
              <!--  <label class="form-label">short by:</label-->
              <!--  ><select class="form-select">-->
              <!--    <option value="all" selected>all order</option>-->
              <!--    <option value="recieved">recieved order</option>-->
              <!--    <option value="processed">processed order</option>-->
              <!--    <option value="delivered">delivered order</option>-->
              <!--  </select>-->
              <!--</div>-->
            </div>
          </div>
        </div>
        <?php

            // multi-orders by customers 
            $order_no = 1;
            while($option = mysqli_fetch_array($INVOICE_list_query))
            {

                $query = "SELECT 
                tbl_items.id,
                tbl_items.itemname,
                tbl_items.picture,
                tbl_orderitems.invoice,
                tbl_orderitems.price,
                tbl_orderitems.qty,
                tbl_orderitems.amount,
                tbl_orderitems.orderitemdate
                FROM tbl_orderitems
                INNER JOIN tbl_items on tbl_items.id = tbl_orderitems.itemid
                INNER join tbl_order on tbl_order.invoice = tbl_orderitems.invoice
                where tbl_orderitems.customerid = '$customer_id' and tbl_orderitems.invoice='$option[0]' and tbl_order.invoice='$option[0]'";
                //Item List Query;
                $rows = ExecuteQuery($query);


              // Customer each Order detail
              $Order_detail_query = "SELECT 
              count(tbl_orderitems.orderitemid),
              tbl_order.orderid,
              tbl_order.amount,
              tbl_order.invoice,
              tbl_order.orderdate,
              tbl_order.status,
              tbl_orderitems.ordercreateddate,
              tbl_users.address as 'cust_loc',
              shop.address      as 'from_loc',
              shop.name         as 'shop_name',
              shop.contact      as 'ctct_num',
              shop.email        as 'mail_num'
              FROM tbl_orderitems
              inner join tbl_users ON tbl_users.uid = tbl_orderitems.customerid
              INNER join tbl_order ON tbl_order.invoice = tbl_orderitems.invoice
              INNER join tbl_users as shop on shop.uid = tbl_orderitems.ordergeneratedby
              where tbl_users.uid = '$customer_id' and tbl_order.status = '$option[1]' and tbl_orderitems.invoice='$option[0]' and tbl_order.invoice='$option[0]'
              group by 
              tbl_order.amount,
              tbl_order.invoice,
              tbl_order.orderdate,
              tbl_order.status,
              tbl_users.address,
              shop.address,
              shop.name,
              shop.contact,
              shop.email,
              tbl_order.orderid";
              $Order_detail_Row = ExecuteQuery($Order_detail_query);
              $ODR              = mysqli_fetch_array($Order_detail_Row); 



  ?>
       <div class="row">
          <div class="col-lg-12">
            <div class="orderlist">
              <div class="orderlist-head">
                <h4>order#<?php echo $order_no;?></h4>
                <h4>order recieved</h4>
              </div>
              <div class="orderlist-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="order-track">
                      <ul class="order-track-list">
                        <li class="order-track-item">
                          <i class="icofont-close"></i
                          ><span>order recieved</span>
                        </li>
                        <?php
                            if($ODR[5] == "Process")
                            {
                            ?>
                            <li class="order-track-item active">
                              <i class="icofont-check"></i
                              ><span>order processed</span>
                            </li>
                        <?php } ?>


                        <li class="order-track-item">
                          <i class="icofont-close"></i
                          ><span>order shipped</span>
                        </li>
                        <li class="order-track-item">
                          <i class="icofont-close"></i
                          ><span>order delivered</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <ul class="orderlist-details">
                      <li>
                        <h5>order id</h5>
                        <p><?php echo $ODR[1];?></p>
                      </li>
                      <li>
                        <h5>Invoice No</h5>
                        <p>
                        <a href="invoice_reports.php?invoice=<?php echo $option[0];?>" style="margin-bottom:10px;" class="btn-sm btn-success">View Invoice</a>
                        <?php echo $option[0];?>
                      </p>
                      </li>

                      <li>
                        <h5>Total Item</h5>
                        <p><?php echo $ODR[0];?></p>
                      </li>
                      <li>
                        <h5>Order Date</h5>
                        <p><?php echo $ODR[4];?></p>
                      </li>
                      <li>
                        <h5>Delivery Date</h5>
                        <p><?php echo $ODR[6];?></p>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-4">
                    <ul class="orderlist-details">
                      <li>
                        <h5>Sub Total</h5>
                        <p><?php echo $ODR[2];?></p>
                      </li>
                      <li>
                        <h5>delivery fee</h5>
                        <p>PKR : 50.00</p>
                      </li>
                      <li>
                        <h5>Total<small>(Incl. VAT)</small></h5>
                        <p><?php echo ($ODR[2]+50);?></p>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-3">
                    <div class="orderlist-deliver">
                      <h5>Delivery location</h5>
                      <p>
                      <?php echo $ODR[7];?>
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="table-scroll">
                      <table class="table-list">
                        <thead>
                          <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
              $sno = 0;
              while($data = mysqli_fetch_array($rows))
              {
                $sno++;
                echo '
                      <tr>
                        <td><h5>'.$sno.'</h5></td>
                        <td>
                         <img src="dashboard/item/'.$data[2].'" alt="product"/>
                        </td>
                        <td><h5>'.$data[1].'</h5></td>
                        <td>
                          <h5>'.$data[4].'</h5>
                        </td>
                        <td><h5>'.($data[5]).'</h5></td>
                        <td><h5>'.($data[4]*$data[5]).'</h5></td>
                      </tr>';
              }
            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php
            $order_no++;}?>


      <!--  <div class="row">-->
      <!--    <div class="col-lg-12">-->
      <!--      <div class="load-btn mt-5">-->
      <!--        <button class="btn btn-outline">Load more items</button>-->
      <!--      </div>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->
    </section>




    <footer class="footer-part">
      <p>SABeasy | &COPY; Copyright by <a href="#">Sibtain Ali</a></p>
    </footer>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/custom/header-part.js "></script>
    <script src="js/custom/select-option.js"></script>
    <script src="js/custom/dropdown.js"></script>
    <script src="js/custom/accordion.js"></script>
    <script src="js/custom/main.js"></script>
  </body>
</html>
