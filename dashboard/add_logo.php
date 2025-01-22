<?php
session_start();
include('db_connection.php');

$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['cimage']['name'];
    $temp = $_FILES['cimage']['tmp_name'];
    $createddate = date('Y-m-d');

    if ($image != '') {
        $obUser = $_SESSION['user'];
        $createdby = $obUser[2];
        $query = "UPDATE tbl_users SET logo='$image' WHERE uid='$createdby'";
        $row = UpdateQuery($query);

        if ($row == 1) {
            // Upload image to the folder
            move_uploaded_file($temp, "../shop_logo/" . $image);
            $message = "Vendor Shop Logo updated successfully!";
            $messageType = "success";
        } else {
            $message = "Vendor Shop Logo not updated. Please try again.";
            $messageType = "error";
        }
    } else {
        $message = "Please select your shop image.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Logo Update</title>
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
    </style>
</head>
<body>
    <!-- Display the message if set -->
    <?php if ($message != ""): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- Your other page content can go here -->
</body>
</html>
