<?php
    session_start();
    include('db_connection.php');

    //print_r($_POST);
    $AnyData = $_GET['search'];

    $user = $_SESSION['user'];
    $uid = $user[2];

    if($AnyData!='')
    {
          //$rows =  ExecuteQuery("SELECT * FROM tbl_category where id='$AnyData'");
          //$rows =  ExecuteQuery("SELECT * FROM tbl_category where c_name='$AnyData'");
          //$rows =  ExecuteQuery("SELECT * FROM tbl_category where createddate='$AnyData'");
            $rows =  ExecuteQuery("SELECT * FROM tbl_category where createdby='$uid' and c_name like '%$AnyData%'");

            while ($cell = mysqli_fetch_array($rows))
               {
                                                $cat = $cell[0].','.$cell[1];
                                                echo '<tr>
                                                        <td>' . $cell[0] . '</td>
                                                        <td>' . $cell[1] . '</td>
                                                        <td><img src="category/'.$cell[2].'" class="img-circle" width="50" height="50" data-toggle="modal" data-target="#update_pre" id="btnimage" title="category/'.$cell[2].'" onClick="CallImagePreview(this.title)"></td>
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
          $rows =  ExecuteQuery("SELECT * FROM tbl_category where createdby='$uid'");

            while ($cell = mysqli_fetch_array($rows))
               {
                                                $cat = $cell[0].','.$cell[1];
                                                echo '<tr>
                                                        <td>' . $cell[0] . '</td>
                                                        <td>' . $cell[1] . '</td>
                                                        <td><img src="category/'.$cell[2].'" class="img-circle" width="50" height="50" data-toggle="modal" data-target="#update_pre" id="btnimage" title="category/'.$cell[2].'" onClick="CallImagePreview(this.title)"></td>
                                                        <td>' . $cell[4] . '</td>

                                                        <td>
                                                            <button type="button" onClick="Update(this.title)" id="btnUpdateClick" title="'.$cat.'" class="btn btn-add btn-xs"><i class="fa fa-pencil"></i></button>

                                                            <button type="button" id="btnDeleteClick" title="'.$cell[0].'" onClick="Delete(this.title)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delt"><i class="fa fa-trash-o"></i> </button>
                                                        </td>
                                                     </tr>';
                                            }
    }

?>