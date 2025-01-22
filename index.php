<?php
  session_start();
  $_SESSION["url"] =  $_SERVER['REQUEST_URI'];
  unset($_SESSION['cart']);
  include("dashboard/db_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="SABeasy" />
    <meta name="email" content="SABeasy@gmail.com" />
    <meta name="profile" content="https://SABeasyapp.com" />
    <meta name="template" content="Ecomart" />
    <meta name="title" content="Ecomart - eCommerce HTML Template" />
    <meta name="keywords" content="html, ecomart, ecommerce, clothing, food, electronics, minimal, beauty, shopping, simple, fashion, single vendor, multipurpose, store, shop" />
    <title>SABEasy - Home</title>
    <link rel="icon" href="images/favicon.png" />
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css" />
    <link rel="stylesheet" href="fonts/flaticon/grocery/flaticon.css" />
    <link rel="stylesheet" href="css/vendor/slick.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.css" />
    <link rel="stylesheet" href="css/custom/main.css" />
    <link rel="stylesheet" href="css/custom/index.css" />

    <!--RatingBar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }
    </style>
    <script>
        function SearchShop(txtsearch) {
            if (txtsearch.length > 0) {
                var ob = new XMLHttpRequest();
                var url = "shopitem_searched.php?q=" + txtsearch;
                var method = "GET";
                var asc = true;
                ob.open(method, url, asc);
                ob.onreadystatechange = function() {
                    if (ob.readyState == 4 && ob.status == 200) {
                        document.getElementById('shop_item_list').innerHTML = ob.responseText;
                    }
                };
                ob.send();
            } else {
                alert("Please Type Any Shop Name");
            }
        }
    </script>
  </head>
  <body>
    <header class="header-part">
      <div class="container">
        <div class="header-left">
          <div class="header-icon-group">
            <button class="icon-nav"><i class="icofont-align-left"></i></button>
            <a class="header-logo" href="index.php"><img src="logo2.png" alt="logo" /></a>
            <button class="icon-cross"><i class="icofont-close"></i></button>
          </div>
        </div>
        <form class="header-middle">
          <div class="select-option">
            <i class="icon icofont-grocery"></i>
            <span class="text">Shops</span>
            <ul class="option-list">
              <?php
                $query = "SELECT * FROM tbl_users WHERE status = 'active' AND role_id = 3";
                $srows  = mysqli_query($con, $query);
                while ($cell = mysqli_fetch_array($srows)) {
                    $shop = $cell['uid'] . ',' . $cell['name'] . ',' . $cell['logo'];
                    echo '<li>
                        <a href="product-single.php?shop=' . $shop . '">
                        <i class="icofont-grocery"></i><span>' . $cell['name'] . '</span></a>
                    </li>';
                }
              ?>
            </ul>
          </div>
          <input type="text" id="txtsearch" name="txtsearch" placeholder="Search anything..." />
          <button type="button" onclick="SearchShop(txtsearch.value)">
            <i class="icofont-ui-search"></i>
          </button>
        </form>
        <div class="header-right">
          <div class="select-menu header-user">
          <?php
            if (isset($_SESSION['customer'])) {
          ?>
             <img class="img" src="Profiles/<?php echo $_SESSION['customer'][7]; ?>" width="25" height="25" alt="user" style="border-radius:100%" />
              <span class="text">
          <?php 
              echo $_SESSION['customer'][3];
              ?></span>
          <?php
            } else {
          ?>
              <img class="img" src="images/cusicon.png" alt="user" /><span class="text">Login</span>
          </div>
          <div class="header-icon-group">
            <button class="icon-check">
              <i class="icofont-shopping-cart"></i><span>0.00</span><sup>0</sup>
            </button>
          </div>
          <?php 
            }
          ?>
        </div>
      </div>
    </header>
    
    <?php
      include("SidebarMenuLoginInfo.php");
    ?>

    <aside class="sidebar-check">
      <div class="check-container">
        <div class="check-header">
          <button class="check-close"><i class="icofont-close"></i></button>
          <div class="cart-total">
            <i class="icofont-basket"></i>
          </div>
        </div>
      </div>
    </aside>
    <section class="banner-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="banner-content" style="background: url(images/shop/banner/grocery/banner.jpg) no-repeat center; background-size: cover;">
              <h1>get your items quickly.</h1>
              <p>We are always ready to deliver product to your doorstep every day</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="promo-part">
      <div class="container">
        <ul class="promo-slider slider-arrow">
           <?php
             $query = "SELECT * FROM tbl_users WHERE status='active' AND role_id = 3";
             $rows  = mysqli_query($con, $query);
             while ($cell = mysqli_fetch_array($rows)) {
                 $shop = $cell['uid'] . ',' . $cell['name'] . ',' . $cell['logo'];
                 echo '<li><a href="#">';
                 if ($cell['logo'] != '') {
                     echo '<img src="shop_logo/' . $cell['logo'] . '" alt="promo" width="100%" height="250" />';
                 } else {
                     echo '<img src="shop_logo/default_shop.png" alt="promo" width="100%" height="250" />';
                 }
                 echo 'Shop => ' . $cell['name'] . '
                      <br>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      &nbsp;&nbsp;&nbsp; 0.0 </a>
                    </li>';
             }
           ?>            
        </ul>
      </div>
    </section>
    <section class="product-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-1">
            <div class="product-category">
              <ul class="cate-list">
                <?php
                  // Assuming you have tbl_category table and category name is in second column
                  $query = "SELECT * FROM tbl_category";
                  $rows  = mysqli_query($con, $query);
                  while ($cell = mysqli_fetch_array($rows)) {
                      echo '<li>
                        <a class="cate-link" href="#">
                          <i class="flaticon-vegetable"></i><span>' . $cell[1] . '</span>
                        </a>
                      </li>';
                  }
                ?>
              </ul>
            </div>
          </div>
          <div class="row" id="shop_item_list">
            <?php
              $query = "SELECT * FROM tbl_users WHERE status='active' AND role_id = 3";
              $rows  = mysqli_query($con, $query);
              while ($cell = mysqli_fetch_array($rows)) {
                  $shop = $cell['uid'] . ',' . $cell['name'] . ',' . $cell['logo'];
                  echo '<div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <div class="product-card">
                      <figure class="product-media">
                        <a class="product-image" href="product-single.php?shop=' . $shop . '">';
                  if ($cell['logo'] != "") {
                      echo '<img src="shop_logo/' . $cell['logo'] . '" alt="product" />';
                  } else {
                      echo '<img src="shop_logo/default_shop.png" alt="product" />';
                  }
                  echo '</a>
                      </figure>
                      <h5 class="product-name">
                        <a href="product-single.php?shop=' . $shop . '">' . $cell['name'] . '</a>
                      </h5>
                    </div>
                  </div>';
              }
            ?>
          </div>
          <div style="clear:both">
            <hr>      
          </div>
          <div class="row">
            <div class="col-lg-12">
                  <!-- Your existing HTML above -->

    <section class="product-part">
      <div class="container">
        <!-- Your existing product section content -->
      </div>
    </section>
    
    <!-- Modern Footer Section -->
    <footer class="footer-modern">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <h5 class="footer-heading">About SABeasy</h5>
            <p>SABeasy is your one-stop solution for all your grocery needs. We bring the best vendors to your doorstep, ensuring convenience and quality.</p>
          </div>
          <div class="col-lg-2 col-md-6">
            <h5 class="footer-heading">Quick Links</h5>
            <ul class="footer-links">
              <li><a href="#">Home</a></li>
              <li><a href="#">Shops</a></li>
              <li><a href="#">Products</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5 class="footer-heading">Follow Us</h5>
            <ul class="footer-social">
              <li><a href="https://instagram.com" target="_blank"><i class="icofont-instagram"></i></a></li>
              <li><a href="https://facebook.com" target="_blank"><i class="icofont-facebook"></i></a></li>
              <li><a href="https://twitter.com" target="_blank"><i class="icofont-twitter"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5 class="footer-heading">Contact Us</h5>
            <p>Email: support@sabeasyapp.com</p>
            <p>Phone: +123 456 7890</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <p class="footer-copyright">© 2024 SABeasy. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </footer>
    
    <div class="mobile-check">
      <button class="check-btn">
        <span class="check-item"><i class="icofont-basket"></i><span>0 items</span></span>
        <span class="check-price">$00.00</span>
      </button>
    </div>

    <!-- Footer CSS -->
    <style>
      .footer-modern {
        background-color: #343a40;
        color: white;
        padding: 40px 0;
      }
      .footer-heading {
        color: #f8f9fa;
        font-size: 18px;
        margin-bottom: 20px;
      }
      .footer-links li {
        list-style: none;
        margin-bottom: 10px;
      }
      .footer-links a {
        color: #dcdcdc;
        text-decoration: none;
        transition: color 0.3s;
      }
      .footer-links a:hover {
        color: #f8f9fa;
      }
      .footer-social {
        display: flex;
        gap: 10px;
      }
      .footer-social li {
        list-style: none;
      }
      .footer-social a {
        color: white;
        font-size: 24px;
        transition: color 0.3s;
      }
      .footer-social a:hover {
        color: #007bff;
      }
      .footer-copyright {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #495057;
        margin-top: 20px;
        color: #dcdcdc;
      }
    </style>

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/custom/header-part.js"></script>
    <script src="js/custom/product-part.js"></script>
    <script src="js/custom/product-view.js"></script>
    <script src="js/custom/select-option.js"></script>
    <script src="js/custom/dropdown.js"></script>
    <script src="js/vendor/slick.min.js"></script>
    <script src="js/custom/slick.js"></script>
    <script src="js/custom/main.js"></script>
  </body>
</html>
