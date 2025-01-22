<?php
  session_start();
  include("db_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="SABeasy" />
    <meta name="email" content="SABeasy@gmail.com" />
    <meta name="profile" content="https:SABeasy.com" />
    <meta name="template" content="Ecomart" />
    <meta name="title" content="Ecomart - eCommerce HTML Template" />
    <meta name="keywords" content="html, ecomart, ecommerce, clothing, food, electronics, minimal, beauty, shopping, simple, fashion, single vendor, multipurpose, store, shop" />
    <title>SABeasy - Map Location</title>
    <link rel="icon" href="images/favicon.png" />
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css" />
    <link rel="stylesheet" href="fonts/flaticon/grocery/flaticon.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.css" />
    <link rel="stylesheet" href="css/custom/main.css" />
    <link rel="stylesheet" href="css/custom/invoice.css" />
    
    <!-- Leaflet.js CSS for map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    
    <style>
      #mapholder {
        height: 450px;
        margin: 40px;
        border-radius: 20px;
        box-shadow: 0px 0px 5px 7px yellow;
        margin-top: -10px;
      }
    </style>
  </head>
  <body onload="getLocation()">
    <header class="header-part">
      <div class="container">
        <div class="header-left">
          <div class="header-icon-group">
            <button class="icon-nav"><i class="icofont-align-left"></i></button>
            <a class="header-logo" href="index.php"><img src="logo2.png" alt="logo" /></a>
            <button class="icon-cross"><i class="icofont-close"></i></button>
          </div>
        </div>
        <div class="select-menu header-user">
          <?php if (isset($_SESSION['customer'])) { ?>
            <img class="img" src="Profiles/<?php echo $_SESSION['customer'][7] ?>" width="25" height="25" alt="user" style="border-radius:100%" />
            <span class="text"><?php echo $_SESSION['customer'][3]; ?></span>
          <?php } else { ?>
            <img class="img" src="images/user.png" alt="user" />
            <span class="text">Login</span>
          <?php } ?>
        </div>
      </div>
    </header>

    <section>
      <div id="mapholder"></div>
      <div class="container" style="text-align: center;">
        <h2>Your Location</h2>
      </div>
    </section>

    <footer class="footer-part">
      <p>SABeasy | &COPY; Copyright by <a href="#">Sibtain Ali</a></p>
    </footer>

    <!-- Leaflet.js for map -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
      function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
          showError();
        }
      }

      function showPosition(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        var map = L.map('mapholder').setView([lat, lon], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([lat, lon]).addTo(map)
          .bindPopup("<b>Your Location</b>").openPopup();
      }

      function showError() {
        var lat = 35.9225;  // Default to a dummy location (e.g., KIU)
        var lon = 74.3655;

        var map = L.map('mapholder').setView([lat, lon], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([lat, lon]).addTo(map)
          .bindPopup("<b>Location</b><br>KIU Location.").openPopup();
      }
    </script>

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/custom/header-part.js"></script>
    <script src="js/custom/select-option.js"></script>
    <script src="js/custom/dropdown.js"></script>
    <script src="js/custom/main.js"></script>
  </body>
</html>
