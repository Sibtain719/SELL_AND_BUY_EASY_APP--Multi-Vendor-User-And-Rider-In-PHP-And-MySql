<?php
session_start();
    include('db_connection.php');
    //print_r($_POST);
    $id = $_GET['cid'];

    $query = "delete from tbl_category where id='$id'";
    $uid = $_SESSION['user'];

    $row = InsertQuery($query);
    if ($row == 1)
    {

                                            $query =  ExecuteQuery("SELECT * FROM tbl_category where createdby='$uid[2]'");
                                            while ($cell = mysqli_fetch_array($query))
                                            {
                                                echo '<tr>
                                                        <td>' . $cell[0] . '</td>
                                                        <td>' . $cell[1] . '</td>
                                                        <td><img src="category/'.$cell[2].'" class="img-circle" width="50" height="50"></td>
                                                        <td>' . $cell[4] . '</td>

                                                        <td>
                                                            <button type="button" class="btn btn-add btn-xs" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
                                                            <button type="button" id="btnDeleteClick" title="'.$cell[0].'" onClick="Delete(this.title)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delt"><i class="fa fa-trash-o"></i> </button>
                                                        </td>
                                                     </tr>';
                                            }
    }
    else
    {
        echo "Not Deleted";
    }
?>
