<?php
    session_start();
    $user = $_SESSION['user'];
    include('db_connection.php');
    $msg = '';
            $newpass = $_POST['newpass'];
            $retpass = $_POST['retypepass'];
        if($retpass !="" && $newpass!="")
        {
            
            if($retpass == $newpass)
            {
                    $query = "update tbl_users set password='$newpass' where username='$user[6]'";
                    $row  = mysqli_query($con,$query);
                    //$isFound = UpdateQuery($query);
                    if($row > 0)
                    {
                        header("location:login.php");
                    }
            }
            else
            {
                $msg= "New password and retype password not matched";
                header("location:User_Profile.php?msg=".$msg);
            }
        }
        else
        {
                $msg= "New password and retype password Required";
                header("location:User_Profile.php?msg=".$msg);
        }

?>