<?php
        session_start();
        include('../db_connection.php');
        //print_r($con);
        $curr_user = $_SESSION['user'];
        //echo 'Current User Info :'.$curr_user[1];
        //print_r($curr_user);
        json_encode($curr_user);
        print_r($curr_user);
        echo '<hr/>';
        echo $curr_user['name'];
        
?>
