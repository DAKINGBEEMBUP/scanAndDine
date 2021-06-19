<?php include('partials/admin-header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br /><br />

        <?php
            //1. get the id of the selected admin
            $admin_id = $_GET['id'];

            //2. create sql query to get the details
            $sql = "SELECT * FROM tbl_admin WHERE admin_id=$admin_id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //check whether the query is executed or not
            if($res == TRUE){
                //check whether the data is available or not
                $count = mysqli_num_rows($res);

                //check whether we have admin data or not
                if($count==1){
                    //get the details
                    //echo "admin available";
                    $row = mysqli_fetch_assoc($res);

                    $admin_name = $row['admin_name'];
                    $admin_email = $row['admin_email'];
                    $admin_phonenum = $row['admin_phonenum'];

                }
                else{
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="admin_name" value="<?php echo $admin_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="admin_email" value="<?php echo $admin_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Phone Number: </td>
                    <td><input type="text" name="admin_phonenum" value="<?php echo $admin_phonenum; ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="admin_id" value="<?php echo $admin_id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-green">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php 
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //get all the values from form to update
        $admin_id = $_POST['admin_id'];
        $admin_name = $_POST['admin_name'];
        $admin_email = $_POST['admin_email'];
        $admin_phonenum = $_POST['admin_phonenum'];

        //create a sql query to update admin 
        $sql = "UPDATE tbl_admin SET 
        admin_name = '$admin_name', 
        admin_email = '$admin_email', 
        admin_phonenum = '$admin_phonenum' 
        WHERE admin_id = '$admin_id'
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed successfully or not
        if($res==true){
            //query executed and admin updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            //failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/admin-footer.php'); ?>