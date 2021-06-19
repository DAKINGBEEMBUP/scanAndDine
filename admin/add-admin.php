<?php include('partials/admin-header.php'); ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
           <h1>Add Admin</h1>
           
           <br /><br />

           <?php
                if(isset($_SESSION['add'])){ //checking whether the session is set or not
                    echo $_SESSION['add']; //displaying session message
                    unset($_SESSION['add']); //removing session message
                }
           ?>

           <form action="" method="POST">
               <table class="tbl-30">
                   <tr>
                       <td>Full Name: </td>
                       <td><input type="text" name="admin_name" placeholder="Enter your name"></td>
                   </tr>

                   <tr>
                       <td>Email: </td>
                       <td><input type="text" name="admin_email" placeholder="Enter your email"></td>
                   </tr>

                   <tr>
                       <td>Password: </td>
                       <td><input type="password" name="admin_password" placeholder="Enter password"></td>
                   </tr>

                   <tr>
                       <td>Phone Number: </td>
                       <td><input type="text" name="admin_phonenum" placeholder="Enter phone number"></td>
                   </tr>

                   <tr>
                       <td colspan="2">
                           <input type="submit" name="submit" value="Add Admin" class="btn-green">
                       </td>
                   </tr>
               </table>
           </form>
        </div>
    </div>
    <!-- main content section ends here -->

<?php include('partials/admin-footer.php'); ?>

<?php 
    //process the value from form and save it in database
    //check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
        //button clicked

        //1. get the data from form
        $admin_name = $_POST['admin_name'];
        $admin_email = $_POST['admin_email'];
        $admin_password = md5($_POST['admin_password']); //password encryption with md5
        $admin_phonenum = $_POST['admin_phonenum'];

        //2. sql query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            admin_name = '$admin_name',
            admin_email = '$admin_email',
            admin_password = '$admin_password',
            admin_phonenum = '$admin_phonenum'
        ";

        //3. execute query and save in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. check whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //data is inserted successfully
            //echo "data inserted";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //failed to insert data
            //echo "failed to insert data";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Failed to Add Admin</div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>