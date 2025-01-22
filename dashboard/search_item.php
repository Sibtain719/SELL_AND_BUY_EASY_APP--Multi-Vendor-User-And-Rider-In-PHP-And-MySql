<?php
    session_start();
    include('db_connection.php');
    //print_r($_POST);
    $AnyData = $_GET['search'];

    $user = $_SESSION['user'];
    $uid = $user[2];

    if($AnyData!='')
    {

            $rows =  ExecuteQuery("SELECT

                                    tbl_items.id,
                                    tbl_items.category_id,
                                    tbl_items.itemname,
                                    tbl_items.price,
                                    tbl_items.qty,
                                    tbl_items.picture,
                                    tbl_items.createdby,
                                    tbl_items.createddate,
                                    tbl_items.status
                                    from tbl_items
                                    where tbl_items.createdby='$uid' and tbl_items.itemname like '%$AnyData%'
                                    ");

                                    if(!$rows){}else
                                    {

                                            while ($cell = mysqli_fetch_array($rows))
                                            {
                                                $cat = $cell[0].','.$cell[1].','.$cell[2].','.$cell[3].','.$cell[4].','.$cell[5].','.$cell[8];
                                                echo '<tr>
                                                                 <td>' . $cell[0] . '</td>
                                                                 <td>' . $cell[1] . '</td>
                                                                 <td>' . $cell[2] . '</td>
                                                                 <td>' . $cell[3] . '</td>
                                                                 <td>' . $cell[4] . '</td>
                                                                 <td>' . $cell[5] . '</td>
                                                                 <td>' . $cell[6] . '</td>
                                                                 <td>' . $cell[7] . '</td>
                                                                 <td>' . $cell[8] . '</td>


                                                                 <td>
                                                     <button type="button" onClick="Update(this.title)" id="btnUpdateClick" title="'.$cat.'" class="btn btn-add btn-xs"><i class="fa fa-pencil"></i></button>

                                                            <button type="button" id="btnDeleteClick" title="'.$cell[0].'" onClick="Delete(this.title)" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </button>
                                                                   </td>
                                                        </tr>';
                                            }
                                        }

    }
    else
    {
                    $rows =  ExecuteQuery("SELECT

                                    tbl_items.id,
                                    tbl_items.category_id,
                                    tbl_items.itemname,
                                    tbl_items.price,
                                    tbl_items.qty,
                                    tbl_items.picture,
                                    tbl_items.createdby,
                                    tbl_items.createddate,
                                    tbl_items.status
                                    from tbl_items
                                    where tbl_items.createdby='$uid'");

                                            while ($cell = mysqli_fetch_array($rows))
                                            {
                                                $cat = $cell[0].','.$cell[1].','.$cell[2].','.$cell[3].','.$cell[4].','.$cell[5].','.$cell[8];
                                                echo '<tr>
                                                                 <td>'.$cell[0]. '</td>
                                                                 <td>'.$cell[1]. '</td>
                                                                 <td>'.$cell[2]. '</td>
                                                                 <td>'.$cell[3]. '</td>
                                                                 <td>'.$cell[4]. '</td>
                                                                 <td>'.$cell[5]. '</td>
                                                                 <td>'.$cell[6]. '</td>
                                                                 <td>'.$cell[7]. '</td>
                                                                 <td>'.$cell[8]. '</td>
                                                                 <td>
                                                                    <button type="button" onClick="Update(this.title)" id="btnUpdateClick" title='.$cat.' class="btn btn-add btn-xs"><i class="fa fa-pencil"></i></button>
                                                                    <button type="button" id="btnDeleteClick" title='.$cell[0].' onClick="Delete(this.title)" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </button>
                                                                 </td>
                                                        </tr>';
                                            }

    }
?>