<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            if(isset($_SESSION['add_user'])){
                echo $_SESSION['add_user'];
                unset($_SESSION['add_user']);
            }
        ?>
        <br><br>

        <!-- login form starts here -->
        <form action="" method="POST" class="text-center">
            Email: <br>
            <input type="text" name="user_email" placeholder="Enter Email"> <br><br>
            Password: <br>
            <input type="password" name="user_password" placeholder="Enter Password"> <br><br>

            <a href="<?php echo SITEURL; ?>register-user.php">Register</a><br><br>
            <a href="<?php echo SITEURL; ?>admin/login-admin.php">Login as Admin</a><br><br><br>

            <input type="submit" name="submit" value="Login" class="btn-blue">
            <br><br>
        </form>
        <!-- login form ends here -->
        
    </div>
</body>
</html>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //process for login
        //1. get the data from login form
        $user_email = $_POST['user_email'];
        $user_password = md5($_POST['user_password']);

        //2. SQL to check whether the user with email and password exists or not
        $sql = "SELECT * FROM tbl_user WHERE user_email='$user_email' AND user_password='$user_password'";

        //3. execute the query
        $res = mysqli_query($conn, $sql);

        //4. count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1){
            //user available and login success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";

            //to check whether admin user is logged in or not and will be unset when admin user has log out
            $_SESSION['user_email'] = $user_email;

            //redirect to home page/dashboard
            header('location:'.SITEURL);
        }
        else{
            //user not available and login fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password is Wrong.</div>";
            //redirect to home page/dashboard
            header('location:'.SITEURL.'login-user.php');
        }
    }
?>