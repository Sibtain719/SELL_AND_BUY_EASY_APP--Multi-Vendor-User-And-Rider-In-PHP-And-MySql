<?php
    session_start();
    include('dashboard/db_connection.php');
    define("MAX_SIZE", "100000");
    $cphone   = $_POST['cphone'];
    $pid    = $_POST['cpid'];
    if($cphone!='')
    {
               $row = UpdateQuery("update tbl_users set contact='$cphone' where uid='$pid'");
                    if($row > 0)
                    {
                                $_SESSION['customer'][5] =$cphone;
                                header("refresh: 3; profile.php");
                                
                    }
                    else
                    {
                        echo 'Contact cant be updated';                
                    }
    }
    else
    {
        echo 'Enter Contact';
    }
?>
