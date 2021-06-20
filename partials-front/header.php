<?php
    include('config/constants.php');
    include('login-user-check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan and Dine</title>

    <!-- link the css file -->
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>
<body>
    <!-- navbar section starts here -->
    <section class="navbar">
        <div class="container">
            <div class="logo flex-header">
                <a href="#" title="Logo">
                    <img src="asset/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
                <span>Siang Malam Resto</span>
            </div>


            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>booking.php">Reservation</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>view-food.php">Menu</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>logout-user.php">Logout</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>

        </div>
    </section>


    <!-- navbar section ends here -->