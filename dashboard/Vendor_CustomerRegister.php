
<?php
        include('db_connection.php');
        $role_id    = $_POST['rid'];
        $name       = $_POST['user'];
        $email      = $_POST['email'];
        $contact    = $_POST['contact'];
        $username   = $_POST['uname'];
        $password   = $_POST['password'];
        $createddate= date('Y-m-d');
        $address    = $_POST['address'];
        $lat        = $_POST['lat'];
        $lng        = $_POST['lng'];
        
        if(strlen($contact) == 11)
        {
            if(strlen($password) > 7)
            {
                $query = "insert into tbl_users values(null,'$role_id','$name','$email','$contact','$username','$password',null,'active',null,0,'$createddate','$address','$lat','$lng')";
        	    $row = InsertQuery($query);
        	    if ($row == 1)
                {
                    if($role_id == 2)
                    {
                        // customer
                        echo '<img src="customer.gif">';
                        echo "<script>alert('Successfully Registered Customer Account!')</script>";
                        header("location:login.php");
                    }
                    else if($role_id == 3)
                    {
                        // vendor
                        echo '<img src="vendor.gif">';
                        echo "Successfully Registered Vendor Account!";
                        header("refresh: 5; url=login.php");
        
                    }
                    else if($role_id == 4)
                    {
                        // rider
                        echo '<img src="ridericon.gif">';
                        echo "Successfully Registered Rider Account!";
                        header("refresh: 5; url=login.php");
                    }
        
        	    } 
        	    else 
        	    {
                    header("refresh: 2; url=register.php");
        		    echo 'User Already Exist';
        	    }                                
            }
            else
            {
                header("location:http://chotuappgrocery.com/dashboard/register.php?pwd=Password contains at least 8 characters");
            }
        }
        else
        {
            header("location:http://chotuappgrocery.com/dashboard/register.php?msg=Invalid Contact Number");
        }

        
        
        
        


?>