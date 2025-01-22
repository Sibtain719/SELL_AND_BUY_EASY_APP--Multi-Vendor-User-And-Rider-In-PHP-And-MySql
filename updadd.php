<?php
    session_start();
    include('dashboard/db_connection.php');
    define("MAX_SIZE", "100000");
    $cadd   = $_POST['cadd'];
    $pid    = $_POST['cupid'];
    if($cadd!='')
    {
               $row = UpdateQuery("update tbl_users set address='$cadd' where uid='$pid'");
                    if($row > 0)
                    {
                                $_SESSION['customer'][10] =$cadd;
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
