<?php
session_start();
include('db_connection.php');

   $image_key = $_POST['img_key'];
   $obUser    = $_SESSION['user'];
   $createdby = $obUser[2];

 
 if($image_key=="yes")
 {

    $id = $_POST['cid'];
    $cname = $_POST['cname'];
    $image = $_FILES['cimage']['name'];
    $temp = $_FILES['cimage']['tmp_name'];
    $createddate = date('Y-m-d');
    $query = "update tbl_category set c_name='$cname',picture='$image' where id='$id'";
    if($image!='')
    {
        $row = InsertQuery($query); 
        if ($row == 1) 
        {
            // upload image in folder 
            move_uploaded_file($temp, "category/" . $image);
            echo "Successfully Updated";
              $rows =  ExecuteQuery("SELECT * FROM tbl_category where createdby='$createdby'");
                                            while ($cell = mysqli_fetch_array($rows)) 
                                            {
                                                $cat = $cell[0].','.$cell[1];
                                                echo '<tr>
                                                        <td>' . $cell[0] . '</td>
                                                        <td>' . $cell[1] . '</td>
                                                        <td><img src="category/'.$cell[2].'" class="img-circle" width="50" height="50"></td>
                                                        <td>' . $cell[4] . '</td>
                                                        
                                                        <td>
                                                            <button type="button" onClick="Update(this.title)" id="btnUpdateClick" title="'.$cat.'" class="btn btn-add btn-xs"><i class="fa fa-pencil"></i></button> 

                                                            <button type="button" id="btnDeleteClick" title="'.$cell[0].'" onClick="Delete(this.title)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delt"><i class="fa fa-trash-o"></i> </button>
                                                        </td>
                                                     </tr>';
                                            }


        } 
        else 
        {
            echo "Not Added";
        }
    }
    else
    {
            echo "Please Upload Image";
    }
 }
 else
 {
    $id = $_POST['cid'];
    $cname = $_POST['cname'];
    $query = "update tbl_category set c_name='$cname' where id='$id'";
        $row = InsertQuery($query);
        if ($row == 1) 
        {
            // upload image in folder 
             $rows =  ExecuteQuery("SELECT * FROM tbl_category where createdby='$createdby'");
              while ($cell = mysqli_fetch_array($rows)) 
                                            {
                                                $cat = $cell[0].','.$cell[1];
                                                echo '<tr>
                                                        <td>' . $cell[0] . '</td>
                                                        <td>' . $cell[1] . '</td>
                                                        <td><img src="category/'.$cell[2].'" class="img-circle" width="50" height="50"></td>
                                                        <td>' . $cell[4] . '</td>
                                                        
                                                        <td>
                                                            <button type="button" onClick="Update(this.title)" id="btnUpdateClick" title="'.$cat.'" class="btn btn-add btn-xs"><i class="fa fa-pencil"></i></button> 

                                                            <button type="button" id="btnDeleteClick" title="'.$cell[0].'" onClick="Delete(this.title)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delt"><i class="fa fa-trash-o"></i> </button>
                                                        </td>
                                                     </tr>';
                                            }



        } 
        else 
        {
            echo "Not Added";
        }
 }


?>
