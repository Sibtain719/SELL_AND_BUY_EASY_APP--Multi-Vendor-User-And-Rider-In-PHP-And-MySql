<?php
	session_start();
  include('dashboard/db_connection.php');
  $customer_id = $_SESSION['customer'][2];
  $invoice = $_GET['invoice'];
  $query = "SELECT 
                tbl_items.id,tbl_items.itemname,tbl_items.picture,
                tbl_orderitems.invoice,
                tbl_orderitems.price,
                tbl_orderitems.qty,
                tbl_orderitems.amount,
                tbl_orderitems.orderitemdate
                FROM tbl_orderitems
                INNER JOIN tbl_items on tbl_items.id = tbl_orderitems.itemid
                INNER join tbl_order on tbl_order.invoice = tbl_orderitems.invoice
                where tbl_orderitems.customerid = '$customer_id' and tbl_orderitems.invoice='$invoice' and tbl_order.invoice='$invoice'";
  //Item List Query;
  $rows = ExecuteQuery($query);


    // customer and Shop info query
    
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
              where tbl_users.uid = '$customer_id' and tbl_orderitems.invoice='$invoice' and tbl_order.invoice='$invoice'
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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="author" content="SABeasy" />
    <meta name="email" content="SABeasy@gmail.com" />
    <meta name="profile" content="https:SABeasy.com" />
    <meta name="template" content="Ecomart" />
    <meta name="title" content="Ecomart - eCommerce HTML Template" />
    <meta
      name="keywords"
      content="html, ecomart, ecommerce, clothing, food, electronics, minimal, beauty, shopping, simple, fashion, single vendor, multipurpose, store, shop"
    />
    <title>SABeasy - Orderlist</title>
    <link rel="icon" href="images/favicon.png" />
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css" />
    <link rel="stylesheet" href="fonts/flaticon/grocery/flaticon.css" />
    <link rel="stylesheet" href="css/vendor/slick.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.css" />
    <link rel="stylesheet" href="css/custom/main.css" />
    <link rel="stylesheet" href="css/custom/orderlist.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script>
    $(document).ready(function() 
    {
        $('#btnpdf').on('click', function() 
        {
            var pdf = new jsPDF('p','mm', 'letter');
            alert(pdf);        
            pdf.addHTML($('#rrrr')[0], function() 
            {
                pdf.setFontSize(9);
                pdf.save('Test.pdf');
            });
        });
    });  

    // Download PDF Report
    function GetHTML()
    {
                    var pdf = new jsPDF('p','pt', 'a4',true);
                    pdf.addHTML($('#pdf_report')[0], function() 
                    {
                        pdf.save('downloadinvoice.PDF');
//                        window.location.href="listvoucher.php";
                    });
    }  
    </script>

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
    
    
    
    <aside class="sidebar-check">
      <div class="check-container">
        <div class="check-header">
          <button class="check-close"><i class="icofont-close"></i></button>
          <div class="cart-total">
            <i class="icofont-basket"></i>
            <h5><span>total item</span><span>(0)</span></h5>
          </div>
        </div>
        <ul class="cart-list">
        </ul>
      </div>
    </aside>




    <section
      class="single-banner"
      style="
        background: url(images/shop/banner/grocery/single-banner.jpg)
          no-repeat center;
        background-size: cover;
      "
    >
      <div class="container">
        <h2>Invoice</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">invoice_reports</li>
        </ol>
      </div>
    </section>



   
    <section class="orderlist-part" id="pdf_report">
      <div class="container">
       <div class="row">
          <div class="col-lg-12">
            <div class="orderlist">
                <div class="row">
                  <div class="col-lg-4">
                   </div>
                                           

                   <div class="col-lg-4" style="text-align:center" >
                            <img src="logo2.png" alt="PHOTO" style="width:40%; height:60%; margin-top:20px">
                            <h5>Accepted Order Invoice</h5>
                            <h6>
                                
                                        <?php 
                                            echo $_SESSION['customer'][3];
                                        ?>
                            </h6>
                   </div>
                   <div class="col-lg-4">
                      
                   </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="row">
                          <div class="col-lg-2">
                          </div>
                          <div class="col-lg-6" style="margin-left:20px">
                          Date
                          <br>
                         <?php echo  $ODR[4]; ?><br><br>

                          Pickup Location : <?php echo  $ODR[8]; ?><br>
                          Delivery Address: <?php echo  $ODR[7]; ?><br>
                          Payment Method&nbsp; : Cash on delivery<br>
                        </div>
                        <div class="col-lg-2">
                            Code<br>
                            <?php echo  $invoice; ?>
                          </div>
                      </div>
                               <div class="row">
                  <div class="col-lg-2">
                  </div>
                  <div class="col-lg-8">
                  <div class="table-scroll">
                      <table class="table-list table-response">
                        <thead>
                          <tr>
                            <th >SL No</th>
                            <th >Product</th>
                            <th >Name</th>
                            <th >Price</th>
                            <th >Quantity</th>
                            <th >Total</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
              $sno = 0;
              $total = 0;
              while($data = mysqli_fetch_array($rows))
              {
                $sno++;
                echo '
                      <tr style="font-size:12px">
                        <td style="font-size:12px">'.$sno.'</td>
                        <td>
                         <img src="../item/'.$data[2].'" alt="product"/>
                        </td>
                        <td style="font-size:12px;">'.$data[1].'</td>
                        <td style="font-size:12px">
                          '.$data[4].'
                        </td style="font-size:12px">
                        <td style="font-size:12px">1</td>
                        <td style="font-size:12px">'.($data[4]*1).'</td>
                      </tr>';
                      $total += ($data[4]*1);
              }
            ?>
                        </tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td style="font-size:12px">Delivery Charges</td>
                          <td style="font-size:12px"><?php echo '50'; ?></td>
                        </tr>
                        <footer>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td style="font-size:12px">Grand Total</td>
                          <td style="font-size:12px"><?php echo ($total+50); ?></td>
                        </footer>
                        <tr>
                            <td colspan="5"></td>
                            <td><input type="button" value="Download Invoice" onclick="GetHTML()"></td>
                        </tr>
                      </table>
                      <hr>
                       
                        </div>

                  </div>
                  <div class="col-lg-2">
                  </div>
                </div>

                   
                </div>



       


            </div>
            </div>
           </div>
        </div>
      </div>
    </section>




    <footer class="footer-part">
      <p>SABeasy | &COPY; Copyright by <a href="#">SABeasy App</a></p>
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
