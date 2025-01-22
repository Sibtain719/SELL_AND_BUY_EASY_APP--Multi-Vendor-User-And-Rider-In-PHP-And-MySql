<?php
    session_start();
    include('db_connection.php');
    $image = $_FILES['cimage']['name'];
    if($image!='')
    {
        $obUser = $_SESSION['user'];
        $createdby = $obUser[2]; // uid
        $username = $obUser[6]; // username
        
        // Rename image
        $temp = explode(".", $_FILES["cimage"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        // end of image renaming
        $query = "update tbl_users set picture='$newfilename' where uid='$createdby'";
        $row = InsertQuery($query);
        if ($row == 1) 
        {
            // uploaded image in folder 
            move_uploaded_file($_FILES["cimage"]["tmp_name"], "Profiles/" . $newfilename);

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
                                            where tbl_users.username='$username'");
            $Obj = mysqli_fetch_array($query1);

            $_SESSION['user'] = $Obj;
            //echo $_SESSION["user"][7];
            header("location:User_Profile.php");
        } 
        else 
        {
            header("location:User_Profile.php");
        }
    }
    else
    {
            header("location:User_Profile.php");
    }
?>
