<?php
	session_start();
    $_SESSION["url"] =  $_SERVER['REQUEST_URI'];
    include("dashboard/db_connection.php");
/*	if(!isset($_SESSION['cart']))
	{
		header("location:product-single.php");
	}*/
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
    <meta name="profile" content="https://SABeasy.com" />
    <meta name="template" content="Ecomart" />
    <meta name="title" content="Ecomart - eCommerce HTML Template" />
    <meta
      name="keywords"
      content="html, ecomart, ecommerce, clothing, food, electronics, minimal, beauty, shopping, simple, fashion, single vendor, multipurpose, store, shop"
    />
    <title>SABeasy - Product</title>
    <link rel="icon" href="images/favicon.png" />
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css" />
    <link rel="stylesheet" href="fonts/flaticon/grocery/flaticon.css" />
    <link rel="stylesheet" href="css/vendor/slick.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.css" />
    <link rel="stylesheet" href="css/custom/main.css" />
    <link rel="stylesheet" href="css/custom/product-single.css" />
	<script>
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
		   
			var ajax = new XMLHttpRequest();
			ajax.open("GET","Remitem_list.php?item="+item,true);
			ajax.onreadystatechange = function()
			{
			    
				document.getElementById("item_list_display").innerHTML = ajax.responseText;
				//alert(ajax.responseText);
			}
			ajax.send();
           location.reload();
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
        <form class="header-middle">
          <input type="text" placeholder="Search anything..." /><button
            type="submit"
          >
            <i class="icofont-ui-search"></i>
          </button>
        </form>
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
          <div class="header-icon-group" id="cart_amount_total_items">
	      	<button class="icon-check">
                  <i class="icofont-shopping-cart"></i><span>
                 <?php if(isset($_SESSION['cart']))
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
                      if(isset($_SESSION['cart']))
                      {
                        echo count($_SESSION['cart']);
                      }
                      else
                      {
                        echo '0';
                      }
                  ?>

                 </sup>
                </button>
          </div>
        </div>
      </div>
    </header>

    <?php
        include('SidebarMenuLoginInfo.php');
    ?>

    <aside class="sidebar-check">
      <div class="check-container" id="item_list_display">
      <div class="check-header">
        		</div>
      <?php
	  if(isset($_SESSION['cart']))
	  {
  		    $item_list = $_SESSION['cart'];
			$total_amount = 0;
            $total_amount_2=0;
            foreach($item_list as $obj)
			{
				$data = explode(',',$obj);
			        //0 productId 1-cat_id 2-itename 3-price 4-quantity 5-picture 6-createdby
				$total_amount_2+= ($data[3]*$data[4]);
            }
			echo '<div class="check-header">
			          		<button class="check-close"><i class="icofont-close"></i></button>
        			  	<div class="cart-total">
            				<i class="icofont-basket"></i>
            				<h5><span>total item</span><span>('.count($item_list).')</span></h5>
          				</div>
        		</div>
        				<ul class="cart-list">';
			foreach($item_list as $obj)
			{
				$data = explode(',',$obj);
			        //0 productId 1-cat_id 2-itename 3-price 4-quantity 5-picture 6-createdby
			       $Remove_item_id = $data[0].','.$data[1].','.$data[2].','.$data[3].',1,'.$data[5].','.$data[6];
				$total_amount+= ($data[3]*$data[4]);
				echo '<li class="cart-item alert fade show">
			          
        			    <div class="cart-image">
              				<a href="#"><img src="../item/'.$data[5].'" alt="product"/></a>
            			    </div>
 			            <div class="cart-info">
        			      <h5><a href="product-single.php">'.$data[2].'</a></h5>
              				<span>PKR - '.$data[3]. ' X 1<small>/ '.$data[3].' </small></span>
              				<h6>'.$data[3].'</h6>
              				<div class="product-action">
                				  <button class="action-minus" title='.$Remove_item_id.' onclick="RemoveItem(this.title)">
                				  <i class="icofont-minus"></i></button>
        		  				  <input class="action-input" title="Quantity Number" type="text" name="quantity" value="'.$data[4].'"/>
		        				  <button class="action-plus" title='.$Remove_item_id.' onclick="AddCart(this.title)">
                  				  <i class="icofont-plus"></i>
                				  </button>
              				</div>
              				</div>
            			   
			           </li>';
			}
				echo '</ul> 
					<div class="check-footer">
					<a href="checkout.php" class="check-btn"
						><span class="check-title">checkout</span
						><span class="check-price">PKR-'.$total_amount.'</span></a
					>
					</div>
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
      class="single-banner mb-0"
      style="
        background: url(images/shop/banner/grocery/single-banner.jpg)
          no-repeat center;
        background-size: cover;
      "
    >
      <div class="container">
        <h2>Shop Item</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Selected Shop Item List
          </li>
        </ol>
      </div>
    </section>
    <section class="related-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="related-title"><h3>Shopping From / 
			<?php
				$shop_id = 0;
				if(isset($_GET['shop']))
				{
				    
					$arr = preg_split('/\,/',$_GET['shop']);	
					$shop_id = $arr[0];
					
					echo $arr[1].' Shop';
				}
			?>

		</h3>
	    </div>
          </div>
        </div>
        <div class="row">

	<?php
			include("db_connection.php");
			 $query = "SELECT * FROM `tbl_items` WHERE createdby='$shop_id'";
			 $rows  = mysqli_query($con,$query);
			 while($cell = mysqli_fetch_array($rows))
			 {
				
			 $item_id = $cell[0].','.$cell[1].','.$cell[2].','.$cell[3].',1,'.$cell[5].','.$cell[6];	
		          echo '<div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-3">
            <div class="product-card">
              <figure class="product-media">
                <div class="product-label-group">
                  <label class="product-label label-new">new</label>
                </div>
                <a class="product-image" href="product_description.php" >
			<img src="item/'.$cell[5].'" alt="product" style="width:230px; height:180px" /></a>
              </figure>
              <div class="product-content">
                <h5 class="product-price">
                  <span>RS - '.$cell[3].'<small>/</small></span
                  ><span>Per Item</span>
                </h5>
                <h5 class="product-name">
                  <a href="#">'.$cell[2].'</a>
                </h5>
			<input type="button" class="action-cart" title="'.$item_id.'" value="Add to Cart" onclick="AddCart(this.title)">
                </div>
            </div>
          </div>';
		}
	?>


        </div>
      </div>
    </section>
    <div class="modal fade" id="product-view">
      <div class="modal-dialog">
        <div class="modal-content">
          <button
            class="modal-close icofont-close"
            data-dismiss="modal"
          ></button>
          <div class="product-view">
            <div class="row">
              <div class="col-md-6 col-lg-6">
                <div class="product-gallery">
                  <ul class="preview-slider">
                    <li>
                      <img
                        src="images/shop/product/grocery/01.jpg"
                        alt="product"
                      />
                    </li>
                  </ul>
                  <ul class="thumb-slider">
                    <li>
                      <img
                        src="images/shop/product/grocery/01.jpg"
                        alt="product"
                      />
                    </li>
                    <li>
                      <img
                        src="images/shop/product/grocery/01.jpg"
                        alt="product"
                      />
                    </li>
                    <li>
                      <img
                        src="images/shop/product/grocery/01.jpg"
                        alt="product"
                      />
                    </li>
                    <li>
                      <img
                        src="images/shop/product/grocery/01.jpg"
                        alt="product"
                      />
                    </li>
                    <li>
                      <img
                        src="images/shop/product/grocery/01.jpg"
                        alt="product"
                      />
                    </li>
                    <li>
                      <img
                        src="images/shop/product/grocery/01.jpg"
                        alt="product"
                      />
                    </li>
                    <li>
                      <img
                        src="images/shop/product/grocery/01.jpg"
                        alt="product"
                      />
                    </li>
                  </ul>
                </div>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mobile-check">
      <button class="check-btn">
        <span class="check-item"
          ><i class="icofont-basket"></i><span>0 items</span></span
        ><span class="check-price">$00.00</span>
      </button>
    </div>
    <footer class="footer-part">
      <p>SABeasy | &COPY; Copyright by <a href="index.php">SABeasy</a></p>
    </footer>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/custom/header-part.js "></script>
    <script src="js/custom/product-part.js "></script>
    <script src="js/custom/product-view.js "></script>
    <script src="js/custom/select-option.js"></script>
    <script src="js/custom/dropdown.js"></script>
    <script src="js/vendor/slick.min.js"></script>
    <script src="js/custom/slick.js"></script>
    <script src="js/custom/main.js"></script>
  </body>
</html>
