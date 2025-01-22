
<?php
	session_start();
    $_SESSION["url"] =  $_SERVER['REQUEST_URI'];
    if(!isset($_SESSION['customer']))
    {
        header("location:login.php");
    }
    include("dashboard/db_connection.php");

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
     <meta name="author" content="SABeasyappgrocery" />
    <meta name="email" content="SABeasygrocery@gmail.com" />
    <meta name="profile" content="https://SABeasygrocery.com" />
    <meta name="template" content="Ecomart" />
    <meta name="title" content="SABeasy - Grocery" />
    <meta
      name="keywords"
      content="html, SABeasy, SABeasy, shops, food, Grocery, shopping, simple, Grocery, single vendor, Grocery multipurpose, Grocery store, shop"
    />
    <title>SABeasy - Profile</title>
    <link rel="icon" href="images/favicon.png" />
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css" />
    <link rel="stylesheet" href="fonts/flaticon/grocery/flaticon.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.css" />
    <link rel="stylesheet" href="css/custom/main.css" />
    <link rel="stylesheet" href="css/custom/profile.css" />
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
              Cart Item List
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
        <h2>your profile</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">profile</li>
        </ol>
      </div>
    </section>
    <section class="profile-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="account-card">
              <div class="account-title">
                <h4>Your Profile</h4>
                <button data-toggle="modal" data-target="#profile-edit">
                  edit profile
                </button>
              </div>
              <div class="account-content">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="profile-image">
                      <a href="#"
                        ><img src="Profiles/<?php 
                             echo $_SESSION['customer'][7];
                             ?>" alt="user"
                      style="width:100px; height:100px"  /></a>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-5">
                    <div class="form-group">
                      <label class="form-label">name</label
                      ><input
                        class="form-control"
                        type="text"
                        value=" <?php 
                                echo $_SESSION['customer'][3];
                                ?>"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-5">
                    <div class="form-group">
                      <label class="form-label">Email</label
                      ><input
                        class="form-control"
                        type="email"
                        value="<?php 
                            echo $_SESSION['customer'][4];
                            ?>"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="account-card">
              <div class="account-title">
                <h4>contact number</h4>
                <button data-toggle="modal" data-target="#contact-add">
                  Update contact
                </button>
              </div>
              <div class="account-content">
                <div class="row">
                  <div class="col-md-6 col-lg-4 alert fade show">
                    <div class="profile-card contact active">
                      <h5>primary</h5>
                      <p><?php 
                            echo $_SESSION['customer'][5];
                        ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="account-card">
              <div class="account-title">
                <h4>delivery address</h4>
                <button data-toggle="modal" data-target="#address-add">
                  Update Address
                </button>
              </div>
              <div class="account-content">
                <div class="row">
                  <div class="col-md-6 col-lg-4 alert fade show">
                    <div class="profile-card address active">
                      <h5>Home</h5>
                      <p>
                        <?php 
                            echo $_SESSION['customer'][10];
                        ?>
                      </p>
                
                    </div>
                  </div>
              
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="account-card mb-0">
              <div class="account-title">
                <h4>payment option</h4>
                <button data-toggle="modal" data-target="#">
                  Cash On Delivery
                </button>
              </div>
       
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="contact-add">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button class="modal-close" data-dismiss="modal">
            <i class="icofont-close"></i>
          </button>
          <form class="modal-form" action="updphone.php" method="post">
            <div class="form-title"><h3>add new contact</h3></div>
         
            <div class="form-group">
              <label class="form-label">number</label
              >
              <input type="text"  value="<?php echo $_SESSION['customer'][2];?>" name="cpid" style="display:none">
              <input
                class="form-control"
                type="text"
                placeholder="Enter your number" name="cphone" value="<?php echo $_SESSION['customer'][5];?>"
                        
              />
            </div>
            <button class="form-btn" type="submit">save contact info</button>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="address-add">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button class="modal-close" data-dismiss="modal">
            <i class="icofont-close"></i>
          </button>
          <form class="modal-form" action="updadd.php" method="post">
            <div class="form-title"><h3>add new address</h3></div>
            <div class="form-group">
              <label class="form-label">address</label>
              
               <input type="text"
                class="form-control"
                placeholder="Enter your address" value="<?php echo $_SESSION['customer'][10] ?>" name="cadd">
               <input type="text" value="<?php echo $_SESSION['customer'][2];?>" name="cupid" style="display:none" />
            </div>
            <button class="form-btn" type="submit">save address info</button>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="payment-add">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button class="modal-close" data-dismiss="modal">
            <i class="icofont-close"></i>
          </button>
          <form class="modal-form">
            <div class="form-title"><h3>add new payment</h3></div>
            <div class="form-group">
              <label class="form-label">card number</label
              ><input
                class="form-control"
                type="text"
                placeholder="Enter your card number"
              />
            </div>
            <button class="form-btn" type="submit">save card info</button>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="profile-edit">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button class="modal-close" data-dismiss="modal">
            <i class="icofont-close"></i>
          </button>
          <form class="modal-form" action="updprofile.php" method="post" enctype="multipart/form-data">
            <div class="form-title"><h3>edit profile info</h3></div>
            <div class="form-group">
              <label class="form-label">profile image</label
              ><input class="form-control" type="file" name='profile_image' />
              <input class="form-control" type="text" style="display:none" name='pid' value="<?php echo $_SESSION['customer'][2];?>"/>
            </div>
            <div class="form-group">
              <label class="form-label">name</label
              ><input class="form-control" type="text" name='txtname' value="<?php echo $_SESSION['customer'][3];?>" />
            </div>
            <div class="form-group">
              <label class="form-label">email</label
              ><input
                readonly
                class="form-control"
                type="text"
                value="<?php echo $_SESSION['customer'][4];?>"
              />
            </div>
            <button class="form-btn" type="submit">Update profile info</button>
          </form>
        </div>
      </div>
    </div>
  
   
    <footer class="footer-part">
      <p>SABeasy | &COPY; Copyright by <a href="#">SABeasy App</a></p>
    </footer>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/custom/header-part.js "></script>
    <script src="js/custom/select-option.js"></script>
    <script src="js/custom/dropdown.js"></script>
    <script src="js/custom/main.js"></script>
  </body>
</html>
