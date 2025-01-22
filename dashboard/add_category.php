<?php
session_start();
include('db_connection.php');
ini_set('upload_max_filesize', '50MB');

$message = "";
$messageType = "";
$rows = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cname = $_POST['cname'];
    $image = $_FILES['cimage']['name'];
    $temp = $_FILES['cimage']['tmp_name'];
    $createddate = date('Y-m-d');

    if ($image != '') {
        $obUser = $_SESSION['user'];
        $createdby = $obUser[2];
        $query = "INSERT INTO tbl_category VALUES (null, '$cname', '$image', $createdby, '$createddate')";
        $row = InsertQuery($query);

        if ($row == 1) {
            // Upload image to the folder
            move_uploaded_file($temp, "category/" . $image);

            // Fetch updated category list
            $rows = ExecuteQuery("SELECT * FROM tbl_category WHERE createdby='$createdby'");

            $message = "Category added successfully!";
            $messageType = "success";
        } else {
            $message = "Category not added. Please try again.";
            $messageType = "error";
        }
    } else {
        $message = "Please upload an image.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <style>
        .message {
            padding: 10px 20px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }
        .message.success {
            background-color: #4CAF50; /* Green for success */
            color: white;
        }
        .message.error {
            background-color: #f44336; /* Red for error */
            color: white;
        }
        .img-circle {
            border-radius: 50%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Display the message if set -->
    <?php if ($message != ""): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- Display the category list if categories are available -->
    <?php if (!empty($rows)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($cell = mysqli_fetch_array($rows)): ?>
                    <?php $cat = $cell[0] . ',' . $cell[1]; ?>
                    <tr>
                        <td><?php echo $cell[0]; ?></td>
                        <td><?php echo $cell[1]; ?></td>
                        <td>
                            <img src="category/<?php echo $cell[2]; ?>" class="img-circle" width="50" height="50" 
                                 data-toggle="modal" data-target="#update_pre" id="btnimage" 
                                 title="category/<?php echo $cell[2]; ?>" 
                                 onClick="CallImagePreview(this.title)">
                        </td>
                        <td><?php echo $cell[4]; ?></td>
                        <td>
                            <button type="button" onClick="Update(this.title)" id="btnUpdateClick" 
                                    title="<?php echo $cat; ?>" class="btn btn-add btn-xs">
                                <i class="fa fa-pencil"></i>
                            </button> 
                            <button type="button" id="btnDeleteClick" title="<?php echo $cell[0]; ?>" 
                                    onClick="Delete(this.title)" class="btn btn-danger btn-xs" 
                                    data-toggle="modal" data-target="#delt">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Your other page content can go here -->
</body>
</html>
