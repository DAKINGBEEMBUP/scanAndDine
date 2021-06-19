<?php
    //authorization or access control
    //check whether the user is logged in or not

    if(!isset($_SESSION['admin_user'])){
        //if admin user session is not set
        //user is not logged in
        //redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to Access Admin Panel</div>";
        //redirect to login page
        header('location:'.SITEURL.'admin/login-admin.php');
    }
?>