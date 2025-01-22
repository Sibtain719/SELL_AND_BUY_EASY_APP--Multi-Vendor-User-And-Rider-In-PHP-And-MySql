<?php
       include('db_connection.php');
        $arr=array();      
        $em = $_GET['email'];
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
                    $data=[
                        "status"=>'1',
	                    "msg"=> 'Password is sent on your '.$em,
	                    ];
                 }
                 else 
                 {
                    $data=[
                        "status"=>'2',
	                    "msg"=> 'Your Email is incorrect'
	                    ];
                 }
            }
            else
            {
                $data=[
                    "status"=>'3',
	                "msg"=> 'Your account was deactivated'
	                    ];
            }
        }
        else
        {
                $data=[
                    "status"=>'4',
	                "msg"=> 'Entered Email is not found on Any Server.'
	                  ];
        }
        array_push($arr,$data);
        echo json_encode($arr);

?>


