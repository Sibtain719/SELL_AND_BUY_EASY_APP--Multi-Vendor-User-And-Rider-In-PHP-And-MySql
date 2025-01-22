<?php
	session_start();
  $_SESSION["url"] =  $_SERVER['REQUEST_URI'];
  
  	include("dashboard/db_connection.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="author" content="mironcoder" />
    <meta name="email" content="mironcoder@gmail.com" />
    <meta name="profile" content="https://themeforest.net/user/mironcoder" />
    <meta name="template" content="Ecomart" />
    <meta name="title" content="Ecomart - eCommerce HTML Template" />
    <meta
      name="keywords"
      content="html, ecomart, ecommerce, clothing, food, electronics, minimal, beauty, shopping, simple, fashion, single vendor, multipurpose, store, shop"
    />
    <title>SABeasy - Checkout</title>
    <link rel="icon" href="images/favicon.png" />
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css" />
    <link rel="stylesheet" href="fonts/flaticon/grocery/flaticon.css" />
    <link rel="stylesheet" href="css/vendor/slick.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.css" />
    <link rel="stylesheet" href="css/custom/main.css" />
    <link rel="stylesheet" href="css/custom/checkout.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script language=javascript></script>

    <script>
    function getLocation() 
    {
      if (navigator.geolocation) 
      {
        navigator.geolocation.getCurrentPosition(showPosition);
      } 
      else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    function showPosition(position) {
     alert("Latitude: " + position.coords.latitude + 
      "\nLongitude: " + position.coords.longitude);
      document.getElementById('lat').value = position.coords.latitude;
      document.getElementById('lng').value = position.coords.longitude;
      
    }
  	function AddCart(item)
		{
			//alert(item);
			var ajax = new XMLHttpRequest();
			ajax.open("GET","additem_list.php?item="+item,true);
			ajax.onreadystatechange = function()
			{
				document.getElementById("item_list_display").innerHTML = ajax.responseText;
			}
			ajax.send();
            location.reload();
		}
       	function RemoveItem(item)
		{
		    //alert(item);
			var ajax = new XMLHttpRequest();
			ajax.open("GET","RemovePermenantly.php?item="+item,true);
			ajax.send();
            location.reload();
		}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ3t0k8boOKrL5PO4ybP96ychdD8rflXY&callback=getLocation"></script>
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
            <?php 
            }?>
          </div>
          <div class="header-icon-group">
           <button class="icon-check">
              <i class="icofont-shopping-cart"></i><span> 
                <?php 
                if(isset($_SESSION['cart']))
                {
                        $_items  = $_SESSION['cart'];
                        $t = 0;
                          foreach($_items as $ob)
                          {
                            $arr = explode(',',$ob); 
                            $t += ($arr[3]*$arr[4]);
                          }
                        $_SESSION['total'] = $t;
                        echo $t; 
                      }
                      else
                      {
                        echo '00.00';
                      }
                  ?>
                  </span
                 ><sup>
                  <?php
                  
                      if(isset($_items))
                      {
                        echo count($_items) > 0 ? count($_items) : '0';
                      }
                      else
                      {
                        echo '0';
                      }
                  ?></sup>
            </button>
          </div>
        </div>
      </div>
    </header>

    <?php
      include('SidebarMenuLoginInfo.php');
    ?>

    <aside class="sidebar-check">
      <div class="check-container">
      <?php
      if(isset($_SESSION['cart']))
      {
		  $item_list2 = $_SESSION['cart'];
			$total_amount2 = 0;
			echo '<div class="check-header">
			          		<button class="check-close"><i class="icofont-close"></i></button>
        			  	<div class="cart-total">
            				<i class="icofont-basket"></i>
            				<h5><span>total item</span><span>('.count($item_list2).')</span></h5>
          				</div>
        			      </div>
        				<ul class="cart-list">';
			foreach($item_list2 as $obj_1)
			{
				$data1 = explode(',',$obj_1);
        $total_amount2+= ($data1[3]*$data1[4]);
         $Remo_item_id = $data1[0].','.$data1[1].','.$data1[2].','.$data1[3].',1,'.$data1[5].','.$data1[6];
				echo '<li class="cart-item alert fade show">
        			    <div class="cart-image">
              				<a href="#"><img src="item/'.$data1[5].'" alt="product"/></a>
            			    </div>
 			            <div class="cart-info">
        			      <h5><a href="product-single.html">'.$data1[2].'</a></h5>
              				<span>PKR - '.$data1[3]. ' X 1<small>/ '.$data1[4].' </small></span>
              				<h6>'.($data1[3]*$data1[4]).'</h6>
              				<div class="product-action">
                				<button class="action-minus" title="'.$Remo_item_id.'" onclick="RemoveItem(this.title)">
                				  <i class="icofont-minus"></i></button>
		  				  <input class="action-input" title="Quantity Number" type="text" name="quantity" value="'.$data1[4].'"/>
						  <button class="action-plus" title="'.$Remo_item_id.'" onclick="AddCart(this.title)" >
                  				  <i class="icofont-plus"></i>
                				  </button>
              				</div>
            			    </div>
			            
			           </li>';
			}
				echo '</ul> 
					<div class="check-footer">
					<a href="checkout.php" class="check-btn">
            <span class="check-title">checkout</span>
            <span class="check-price">'.$total_amount2.'</span></a>';//<span class="check-price">'.$total_amount2.'</span></a>
					echo '</div>
				</div>';
    }
    else
    {
      ?>
        <div class="check-header">
          <button class="check-close"><i class="icofont-close"></i></button>
          <div class="cart-total">
            <i class="icofont-basket"></i>
            <h5><span>total item</span><span>(0)</span></h5>
          </div>
        </div>
        <ul class="cart-list">
              Cart Item List
        </ul>
      <?php
    }
  ?>
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
        <h2>checkout</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">checkout</li>
        </ol>
      </div>
    </section>
    <section class="checkout-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="account-card">
              <div class="account-title"><h4>Your order</h4></div>
              <div class="account-content">
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
                        <th scope="col">action</th>
                      </tr>
                    </thead>
                    <tbody>
			<?php
      if(isset($_SESSION['cart']))
      {
				$item_list = $_SESSION['cart'];
      //  print_r($item_list);
				$total_amount = 0;
				$sno = 0;
        // removing duplicates and addition of qty
        foreach($item_list as $obj)
				{
					$data = explode(',',$obj);
					$total_amount+= ($data[3]*$data[4]);
					$sno++;
          //0 productId 1-cat_id 2-itename 3-price 4-quantity 5-picture 6-createdby
           $Remove_item_id = $data[0].','.$data[1].','.$data[2].','.$data[3].',1,'.$data[5].','.$data[6];
					echo '
                      <tr>
                        <td><h5>'.$sno.'</h5></td>
                        <td>
                         <img src="item/'.$data[5].'" alt="product"/>
                        </td>
                        <td><h5>'.$data[2].'</h5></td>
                        <td>
                          <h5>'.$data[3].'</h5>
                        </td>
                        <td><h5>'.$data[4].'</h5></td>
                        <td><h5>'.($data[3]*$data[4]).'</h5></td>
                        <td>
                          <ul class="table-action">
                            <li>
                              <a class="trash" href="#" title="'.$Remove_item_id.'" onclick="RemoveItem(this.title)"><i class="icofont-trash"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>';
				}
      }
			?>



                      
                    </tbody>
                  </table>
                </div>
                <div class="checkout-charge">
                  <ul>
                    <li><span>Sub total</span><span>
                    <?php 
                      if(isset($total_amount))
                      {
                    echo $total_amount; }?></span></li>
                    <!--<li><span>delivery fee</span><span>$10.00</span></li>
                    <li><span>discount</span><span>$00.00</span></li>-->
                    <li>
                      <span>Total<small>(Incl. VAT)</small></span
                      ><span> <?php 
                      if(isset($total_amount))
                      {
                    echo $total_amount; }?></span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
	      <div class="col-lg-12" style="margin-top:-60px">
          <div class="account-card mb-0">
              <div class="checkout-check">
                </div>
                <div class="checkout-proced">
                  <form action="CustomerOrder.php" method="post">
                    <input type="text" name="lat" id="lat" style="">
                    <input type="text" name="lng" id="lng" style="">
                    <div style="font-size:15px;color:blue; text-align:center">Deliver On Current Address</div>
                    <input type="submit" value="Place Order" class="btn btn-inline">
                  </form>
                <!--  <div style="font-size:15px;color:blue; text-align:center">Pickup Address to place this Order</div>-->
                <!--  <a href="PickupLocation.php" class="btn btn-inline"-->
                <!--    >Pickup Address</a-->
                <!--  >-->
                <!--</div>-->
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
    <script src="js/custom/product-view.js "></script>
    <script src="js/custom/select-option.js"></script>
    <script src="js/custom/dropdown.js"></script>
    <script src="js/vendor/slick.min.js"></script>
    <script src="js/custom/slick.js"></script>
    <script src="js/custom/main.js"></script>
  </body>
</html>
