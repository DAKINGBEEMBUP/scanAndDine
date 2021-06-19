<?php 
    //include constant.php for SITEURL
    include('../config/constants.php');

    //1. destroy the session 
    session_destroy(); //unsers $_SESSION['admin-user']

    //2. redirect to login page
    header('location:'.SITEURL.'admin/login-admin.php');
?>