<nav class="sidebar-nav">
    <div class="nav-container">
        <div class="nav-header">
            <button class="nav-close"><i class="icofont-close"></i></button>
            <a class="nav-logo" href="#">
                <img src="logo2.png" alt="logo" />
            </a>
            <ul class="nav nav-tabs">
                <?php if (isset($_SESSION['customer'])) { ?>
                    <li>
                        <a href="#menu-list" class="nav-link active" data-toggle="tab">CUS-Dashboard</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="#menu-list" class="nav-link active" data-toggle="tab">Menus</a>
                    </li>
                <?php } ?>
                <li>
                    <a href="#cate-list" class="nav-link" data-toggle="tab" title="chkout">Grocery Shops</a>
                </li>
            </ul>
        </div>
        <div class="nav-content">
            <div class="tab-pane active" id="menu-list">
                <div class="nav-profile">
                    <?php if (isset($_SESSION['customer'])) { ?>
                        <a href="profile.php">
                            <img src="Profiles/<?php echo $_SESSION['customer'][7]; ?>" alt="user" />
                        </a>
                        <h4>
                            <a href="#">
                                <?php echo $_SESSION['customer'][3]; ?>
                            </a>
                        </h4>
                    <?php } ?>
                </div>
                <ul class="nav-list">
                    <li>
                        <a class="nav-link" href="index.php">
                            <i class="icofont-ui-home"></i><span>Home</span>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['customer'])) { ?>
                        <li>
                            <a class="nav-link" href="profile.php">
                                <i class="icofont-ui-user"></i><span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="checkout.php">
                                <i class="icofont-ui-check"></i><span>Checkout</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="orderlist.php">
                                <i class="icofont-basket"></i><span>Your Order</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="maplocation.php">
                                <i class="icofont-map"></i><span>Map Current Location</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="dashboard/signout.php">
                                <i class="icofont-ui-lock"></i><span>Logout</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a class="nav-link" href="dashboard/login.php">
                                <i class="icofont-ui-lock"></i><span>Login</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="dashboard/register.php">
                                <i class="icofont-ui-lock"></i><span>Register</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="tab-pane" id="cate-list">
                <ul class="cate-list">
                    <?php
                    $squery = "SELECT uid, name, logo FROM tbl_users WHERE status='active' AND role_id = 3";
                    $srows  = mysqli_query($con, $squery);
                    while ($cell = mysqli_fetch_assoc($srows)) {
                        $shop = $cell['uid'] . ',' . $cell['name'] . ',' . $cell['logo'];
                        echo '<li>
                                <a class="cate-link dropdown" href="product-single.php?shop=' . urlencode($shop) . '">
                                    <i class="flaticon-vegetable"></i><span>' . htmlspecialchars($cell['name']) . '</span>
                                </a>
                              </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
