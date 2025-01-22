<?php
    session_start();
    include('db_connection.php');

    $phone   = $_POST['phone'];
    $user = $_SESSION['user'];

        // Update Phone now
        $query1 = "update tbl_users set contact='$phone' where username='$user[6]'";
        $isFound1 = ExecuteQuery($query1);
        if($isFound1 == 1)
        {
            // Update Password now
            $query1 =  mysqli_query($con,"SELECT
            tbl_role.rid,
            tbl_role.name,
            tbl_users.uid,
            tbl_users.name,
            tbl_users.email,
            tbl_users.contact,
                                            tbl_users.username,
                                            tbl_users.picture,
                                            tbl_users.status,
                                            tbl_users.createddate,
                                            tbl_users.address

                                            from tbl_role
                                            INNER JOIN tbl_users on tbl_users.role_id = tbl_role.rid
                                            where tbl_users.username='$user[6]'");
            $Obj = mysqli_fetch_array($query1);

            $_SESSION['user'] = $Obj;
            //echo $_SESSION["user"][7];
            header("location:User_Profile.php");
        }
        else
        {
            echo "Phone not updated";
        }

?>