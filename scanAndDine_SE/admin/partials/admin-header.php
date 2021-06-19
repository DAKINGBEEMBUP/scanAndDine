<?php 
    include('../config/constants.php'); 
    include('login-admin-check.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan and Dine</title>

    <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
    <!-- header section starts here -->
    <div class="header text-center">
        <div class="wrapper">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-reservation.php">Reservation</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-menu.php">Menu</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout-admin.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- header section ends here -->