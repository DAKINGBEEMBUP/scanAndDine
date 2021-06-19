<?php include('partials/admin-header.php'); ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Reservations</h1>
            <br />
            <br />

            <?php 
                // if(isset($_SESSION['add'])){ //checking whether the session is set or not
                //     echo $_SESSION['add']; //displaying session message
                //     unset($_SESSION['add']); //removing session message
                // }
            ?>

            <br />
            <br />
            <br />

            <!-- button to add admin
            <a href="<?php //echo SITEURL; ?>admin/add-admin.php" class="btn-blue">Add Admin</a>
            <br />
            <br />
            <br /> -->

            <table class="tbl-full">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Code</th>
                    <th>Status</th>
                </tr>

                <?php
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_reservation";
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
                                $reservation_name = $rows['reservation_name'];
                                $reservation_phonenum = $rows['reservation_phonenum'];
                                $reservation_date = $rows['reservation_date'];
                                $reservation_time = $rows['reservation_time'];
                                $reservation_code = $rows['reservation_code'];
                                $reservation_status = $rows['reservation_status'];

                                //display the values in our table
                                ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $reservation_name ?></td>
                                    <td><?php echo $reservation_phonenum ?></td>
                                    <td><?php echo $reservation_date ?></td>
                                    <td><?php echo $reservation_time ?></td>
                                    <td><?php echo $reservation_code ?></td>
                                    <td><?php echo $reservation_status ?></td>
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