<?php
    include('db_connection.php');
    ini_set('upload_max_filesize','50MB');
    $arr=array();      
    $msg = '';
    if (isset($_SERVER['REQUEST_METHOD']) =='POST')
    {
        $uid      = $_POST["id"];
        $picture  = $_POST["IMG"];
        if(isset($uid))
        {
            $file_path = "../Profiles/" . $uid . ".jpg";
            $pf = $uid.".jpg";
            if (file_exists($file_path)) 
            {
                unlink($file_path);
                $sql = "UPDATE tbl_users SET picture='$pf' WHERE uid='" . $uid . "'";
                $row = UpdateQuery($sql);
                if($row > 0)
                {
                file_put_contents($file_path, base64_decode($picture));
                    $msg = 'Success';
                }
                else
                {
                    $msg = 'Server Query Failed : ';   
                }
            }
            else
            {
                $sql = "UPDATE tbl_users SET picture='$pf' WHERE uid='" . $uid . "'";
                $row = UpdateQuery($sql);
                if($row > 0)
                {
                file_put_contents($file_path, base64_decode($picture));
                    $msg = 'Success';
                }
                else
                {
                    $msg = 'Server Query Failed : ';   
                }
            }
        }
        else
        {
            $msg = 'UID';
        }
    }
    else
    {
        $msg = 'Upload Profile Image';
    }

	        echo $msg;
?>
