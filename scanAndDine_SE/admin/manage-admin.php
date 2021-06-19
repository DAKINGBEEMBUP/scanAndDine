<?php include('partials/admin-header.php'); ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br />
            <br />

            <?php 
                if(isset($_SESSION['add'])){ //checking whether the session is set or not
                    echo $_SESSION['add']; //displaying session message
                    unset($_SESSION['add']); //removing session message
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);  
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
            ?>

            <br />
            <br />
            <br />

            <!-- button to add admin -->
            <a href="<?php echo SITEURL; ?>admin/add-admin.php" class="btn-blue">Add Admin</a>
            <br />
            <br />
            <br />

            <table class="tbl-full">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_admin";
                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //check whether the query is executed or not
                    if($res == TRUE){
                        //count rows to check whether we have data in database or not
                        $count = mysqli_num_rows($res); //function to get all rows in the database
                        $no = 1 ; //create a variable 

                        //check the num of rows
                        if($count>0){
                            //we have data in database
                            while($rows = mysqli_fetch_assoc($res)){
                                //using while loop to get all the data from database
                                //and while loop will run as long as we have data in database

                                //get individual data
                                $admin_id = $rows['admin_id'];
                                $admin_name = $rows['admin_name'];
                                $admin_email = $rows['admin_email'];
                                $admin_phonenum = $rows['admin_phonenum'];

                                //display the values in our table
                                ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $admin_name ?></td>
                                    <td><?php echo $admin_email ?></td>
                                    <td><?php echo $admin_phonenum ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin-password.php?id=<?php echo $admin_id; ?>" class="btn-blue">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $admin_id; ?>" class="btn-green">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $admin_id; ?>" class="btn-red">Delete Admin</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- main content section ends here -->

<?php include('partials/admin-footer.php'); ?>