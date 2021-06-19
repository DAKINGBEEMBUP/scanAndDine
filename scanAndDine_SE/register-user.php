<?php include('config/constants.php'); ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
           <h1>Register User</h1>
           
           <br /><br />

           <?php
                if(isset($_SESSION['add_user'])){ //checking whether the session is set or not
                    echo $_SESSION['add_user']; //displaying session message
                    unset($_SESSION['add_user']); //removing session message
                }
           ?>

           <form action="" method="POST">
               <table class="tbl-30">
                   <tr>
                       <td>Full Name: </td>
                       <td><input type="text" name="user_name" placeholder="Enter your name"></td>
                   </tr>

                   <tr>
                       <td>Email: </td>
                       <td><input type="text" name="user_email" placeholder="Enter your email"></td>
                   </tr>

                   <tr>
                       <td>Password: </td>
                       <td><input type="password" name="user_password" placeholder="Enter password"></td>
                   </tr>

                   <tr>
                       <td>Phone Number: </td>
                       <td><input type="text" name="user_phonenum" placeholder="Enter phone number"></td>
                   </tr>

                   <tr>
                       <td colspan="2">
                           <input type="submit" name="submit" value="Register" class="btn-green">
                       </td>
                   </tr>
               </table>
           </form>
        </div>
    </div>
    <!-- main content section ends here -->

<?php 
    //process the value from form and save it in database
    //check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
        //button clicked

        //1. get the data from form
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password = md5($_POST['user_password']); //password encryption with md5
        $user_phonenum = $_POST['user_phonenum'];

        //2. sql query to save the data into database
        $sql = "INSERT INTO tbl_user SET
            user_name = '$user_name',
            user_email = '$user_email',
            user_password = '$user_password',
            user_phonenum = '$user_phonenum'
        ";

        //3. execute query and save in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. check whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //data is inserted successfully
            //echo "data inserted";
            //create a session variable to display message
            $_SESSION['add_user'] = "<div class='success'>Register New Successfull</div>";
            //redirect page to manage admin
            header("location:".SITEURL."login-user.php");
        }
        else{
            //failed to insert data
            //echo "failed to insert data";
            //create a session variable to display message
            $_SESSION['add_user'] = "<div class='success'>Failed to Register</div>";
            //redirect page to add admin
            header("location:".SITEURL.'login-user.php');
        }
    }
?>