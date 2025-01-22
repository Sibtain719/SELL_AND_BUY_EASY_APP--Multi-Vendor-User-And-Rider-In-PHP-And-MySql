<?php
session_start();
include('db_connection.php');
ini_set('upload_max_filesize', '50MB');

$message = "";
$messageType = ""; // To differentiate between success and error messages
$imagePath = ""; // Variable to store the image path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = $_POST['iname'];
    $image      = $_FILES['iimage']['name'];
    $temp       = $_FILES['iimage']['tmp_name'];
    $qty        = $_POST['qname'];
    $price      = $_POST['pname'];
    $status     = isset($_POST['istatus']) ? $_POST['istatus'] : ''; // Set a default value if not provided
    $cid        = $_POST['cid']; 

    $obUser     = $_SESSION['user'];
    $createdby  = $obUser[2];
    $createddate = date('Y-m-d');

    $query = "INSERT INTO tbl_items VALUES (null, '$cid', '$name', '$price', '$qty', '$image', $createdby, '$createddate', '$status')";
    $row = InsertQuery($query);
   
    if ($row == 1) {
        // Upload image to the folder
        $imagePath = "../item/" . $image;
        move_uploaded_file($temp, $imagePath);
        $message = "Item added successfully!";
        header("location:F_item.php?q=Item Added");
        $message = "Item added successfully!";
        $messageType = "success";
    } else {
        $message = "Item not added. Please try again.";
        $messageType = "error";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SABeasy - F_item</title>
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
        .item-image {
            margin-top: 20px;
            max-width: 200px; /* Set a max width for the displayed image */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Display the message if set -->
    <?php if ($message != ""): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
        <?php if ($imagePath != ""): ?>
            <img src="<?php echo $imagePath; ?>" alt="Item Image" class="item-image">
        <?php endif; ?>
    <?php endif; ?>

    <!-- Your other page content can go here -->
</body>
</html>
