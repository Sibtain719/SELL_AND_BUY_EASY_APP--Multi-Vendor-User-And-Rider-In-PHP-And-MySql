<ul class="sidebar-menu">
    <?php
    $obj = $_SESSION['user'];
    if ($obj[1] == "vendor" || $obj[1] == "Vendor") {
        echo '  <li class="active">
        <a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
   <li>
                    <a href="C_customer.php">
                        <i class="fa fa-comment"></i> <span>Customer</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="D_Rider.php">
                        <i class="fa fa-comment"></i> <span>Rider</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="E_category.php">
                        <i class="fa fa-comment"></i> <span>Category</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="F_item.php">
                        <i class="fa fa-comment"></i> <span>Items</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="G_order.php">
                        <i class="fa fa-comment"></i> <span>Order</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="H_Orderinvoice.php">
                        <i class="fa fa-comment"></i> <span>Order History</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-comment"></i> <span>Reports</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                <a href="company_logo.php">
                    <i class="fa fa-comment"></i> <span>Company Logo</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
                ';
    } 
    else if ($obj[1] == "rider" || $obj[1] == "Rider") 
    {
        echo '<li>
        <a href="ViewRiderOrders.php">
            <i class="fa fa-comment"></i> <span>Orders</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
    <li>
        <a href="H_Orderinvoice.php">
            <i class="fa fa-comment"></i> <span>Order History</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
    <li>
        <a href="I_Reports.php">
            <i class="fa fa-comment"></i> <span>Reports</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>';
    } else if ($obj[1] == "admin" || $obj[1] == "Admin") {
    ?>
        <li class="active">
            <a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li>
            <a href="A_Role.php">
                <i class="fa fa-envelope-o"></i> <span>Role Type</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>

        <li>
            <a href="B_Vendor.php">
                <i class="fa fa-envelope-o"></i> <span>Vendor</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li>
            <a href="C_customer.php">
                <i class="fa fa-comment"></i> <span>Customer</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li>
            <a href="D_Rider.php">
                <i class="fa fa-comment"></i> <span>Rider</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li>
            <a href="E_category.php">
                <i class="fa fa-comment"></i> <span>Category</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li>
            <a href="F_item.php">
                <i class="fa fa-comment"></i> <span>Items</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li>
            <a href="G_order.php">
                <i class="fa fa-comment"></i> <span>Order</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li>
            <a href="H_Orderinvoice.php">
                <i class="fa fa-comment"></i> <span>Order History</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-comment"></i> <span>Reports</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
</ul>
<?php
    } else
    {
        header("location:login.php");
    }
?>