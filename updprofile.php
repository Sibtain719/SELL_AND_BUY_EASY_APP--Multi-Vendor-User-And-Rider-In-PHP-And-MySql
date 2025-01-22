<?php
    session_start();
    include('dashboard/db_connection.php');
    define("MAX_SIZE", "100000");
    $name   = $_POST['txtname'];
    $pid    = $_POST['pid'];
   
    if($name!='')
    {
                if($_FILES["profile_image"]["name"]!="")
                {
                    $filename   = $pid;
                    $extension  = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION ); // jpg
                    $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg
                    $source      = $_FILES["profile_image"]["tmp_name"];
                    $destination = "Profiles/{$basename}";
                    
                     if (file_exists($destination)) 
                      {
                           unlink($destination);
                           $Qurey ="update tbl_users set name='$name', picture='$basename' where uid='$pid'";
                            $row = mysqli_query($con,$Qurey);
                            if($row > 0)
                            {
                                move_uploaded_file($source,$destination);
                                
                                $_SESSION['customer'][7] = $basename;
                                $_SESSION['customer'][3] = $name;
                                header("refresh: 3; profile.php");
                            }
                            else
                            {
                                echo 'Profile cant be updated';                
                            }
                      }
                      
                      else
                      {
                            $Qurey ="update tbl_users set name='$name', picture='$basename' where uid='$pid'";
                            $row = mysqli_query($con,$Qurey);
                            if($row > 0)
                            {
                                move_uploaded_file($source,$destination);
                                $_SESSION['customer'][7] = $basename;
                                $_SESSION['customer'][3] = $name;
                                header("refresh: 3; url=profile.php");
                            }
                            else
                            {
                                echo 'Profile cant be updated';                
                            }
                      }
                }
                else
                {
                    $row = UpdateQuery("update tbl_users set name='$name' where uid='$pid'");
                    if($row > 0)
                    {
                            
                                $_SESSION['customer'][3] = $name;
                                header("refresh: 3; url=profile.php");
                                
                    }
                    else
                    {
                        echo 'Name cant be updated';                
                    }
                }
    }
    else
    {
        echo 'Enter Name';
    }
?>
