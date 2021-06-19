<?php include('partials/admin-header.php'); ?>

<div class="main_content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $admin_id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_admin_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_admin_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_admin_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="admin_id" value="<?php echo $admin_id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-green">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php 
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //echo "clicked";

        //1. get the data from form
        $admin_id = $_POST['admin_id'];
        $current_admin_password = md5($_POST['current_admin_password']);
        $new_admin_password = md5($_POST['new_admin_password']);
        $confirm_admin_password = md5($_POST['confirm_admin_password']);

        //2. check whether the user with current id and current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE admin_id=$admin_id AND admin_password='$current_admin_password'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        if($res==true){
            //check whether data is available or not
            $count = mysqli_num_rows($res);

            if($count == 1){
                //user exists and password can be changed
                //echo "User Found";

                //3. check whether the new password and confirm password match or not
                if($new_admin_password == $confirm_admin_password){
                    //update password
                    //echo "Password match";

                    //create another sql query
                    $sql2 = "UPDATE tbl_admin SET 
                    admin_password = '$new_admin_password' 
                    WHERE admin_id = $admin_id
                    ";

                    //execute query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether the query executed or not
                    if($res2 == true){
                        //display success message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";

                        //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        //display error message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";

                        //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else{
                    //redirect to manage admin page with error message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password does not Match.</div>";

                    //redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else{
                //user does not exist, set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";

                //redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        

        //4. change password if all above is true
    }
?>

<?php include('partials/admin-footer.php'); ?>