<?php
    include('db_connection.php');
    $message = '';    
    $em = $_POST['email'];
    if($em!='')
    {
        $query  = "select * from tbl_users where email='$em'";
        $option = ExecuteQuery($query);
        $rows   = mysqli_fetch_array($option);
        $uid    = $rows[0];
        if($uid > 0)
        {
            if($rows['status'] == 'active' || $rows['status'] == 'Active')
            {
                
                 $to = $em;
                 $subject = "Password Recovered";
                 $message = "<b>Your password is recovered by this email ['.$em.'] address </b>";
                 $message .= "<h1>your password is - ".$rows['password']."</h1>";
                 $message .= "<br>Mail From<br>";
                 $message .= "Chotu App<br>";
                 //$message .= '<img src="companylogo.png">';
                 
                 
                 $header = "From:shafquathussain197@gmail.com \r\n";
                 //$header .= "Cc:afgh@somedomain.com \r\n";
                 $header .= "MIME-Version: 1.0\r\n";
                 $header .= "Content-type: text/html\r\n";
                 $retval = mail ($to,$subject,$message,$header);
                 if( $retval == true) 
                 {
                    $message = "1";
                 }
                 else 
                 {
                    $message = "Server Issue try again";
                 }
            }
            else
            {
                $message = 'Your account was deactivated...';
            }
        }
        else
        {
            $message = "Entered Email is not found - ".$query;
        }
    }
    else
    {
        $message = "Enter Email to Recover password";
    }
     header("location:passwordrecovery.php?q=".$message);
?>