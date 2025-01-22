<ul class="nav navbar-nav">
    <li class="dropdown dropdown-help hidden-xs">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="pe-7s-settings"></i></a>
        <ul class="dropdown-menu">
            <li>
                <a href="#">
                    <i class="fa fa-line-chart"></i> New Orders(0)</a>
            </li>
        </ul>
    </li>
                        <?php
                               $obUser    = $_SESSION['user'];
                        ?>
    <!-- user -->
    <li class="dropdown dropdown-user">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="Profiles/<?php echo $obUser[7];?>" class="img-circle" width="45" height="45" alt="<?php echo $obUser[7]; ?>""></a>
        <ul class="dropdown-menu">
            <li>
                <a href="#">
                    <i class=""></i>
                    <?php
                               echo '
                               Welcome  '.$obUser[1].' - '.$obUser[3];
                    ?>
                </a>
            </li>


            <li>
                <a href="User_Profile.php">
                    <i class="fa fa-user"></i> User Profile</a>
            </li>
            <li><a href="#"><i class="fa fa-inbox"></i> Inbox</a></li>
            <li>
                <a href="signout.php">
                    <i class="fa fa-sign-out"></i> Signout</a>
            </li>
        </ul>
    </li>
</ul>