<?php include('partials-front/header.php') ?>

    <?php
        $user_email = $_SESSION['user_email'];

        $sql2 = "SELECT * FROM tbl_user WHERE user_email='$user_email'";

        $res2 = mysqli_query($conn, $sql2);

        if($res2==true){
            $count2 = mysqli_num_rows($res2);

            if($count2 == 1){
                $row2 = mysqli_fetch_assoc($res2);

                $user_id = $row2['user_id'];
                $user_name = $row2['user_name'];
                $user_phonenum = $row2['user_phonenum'];
            }
        }
    ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
           <h1>Book a Table</h1>
           
           <br /><br />

           <?php
                if(isset($_SESSION['reservation'])){ //checking whether the session is set or not
                    // echo $_SESSION['reservation']; //displaying session message
                    //unset($_SESSION['reservation']); //removing session message
                }
           ?>

           <form action="" method="POST">
               <table class="tbl-30">
                   <tr>
                       <td>Choose date: </td>
                       <td><input type="date" name="rsv_date"></td>
                   </tr>

                   <tr>
                       <td>Choose time: </td>
                       <td><input type="time" name="rsv_time"></td>
                   </tr>

                   <tr>
                       <td>Choose table: </td>
                       <td><input type="text" name="rsv_table"></td>
                   </tr>

                   <tr>
                       <td colspan="2">
                            <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                            <input type="hidden" name="rsv_name" value="<?php echo $user_name ?>">
                            <input type="hidden" name="rsv_phonenum" value="<?php echo $user_phonenum ?>">
                           <input type="submit" name="submit" value="Book Table" class="btn-green">
                       </td>
                   </tr>
               </table>
           </form>
        </div>
    </div>
    <!-- main content section ends here -->

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Your Reservations</h1>
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
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>

                <?php
                    //query to get all admin
                    $sql3 = "SELECT * FROM tbl_reservation WHERE reservation_user_id=$user_id";
                    //execute the query
                    $res3 = mysqli_query($conn, $sql3);

                    //check whether the query is executed or not
                    if($res3 == TRUE){
                        //count rows to check whether we have data in database or not
                        $count3 = mysqli_num_rows($res3); //function to get all rows in the database
                        $no3 = 1 ; //create a variable 

                        //check the num of rows
                        if($count3>0){
                            //we have data in database
                            while($rows3 = mysqli_fetch_assoc($res3)){
                                //using while loop to get all the data from database
                                //and while loop will run as long as we have data in database

                                //get individual data
                                $reservation_id = $rows3['reservation_id'];
                                $reservation_date = $rows3['reservation_date'];
                                $reservation_time = $rows3['reservation_time'];

                                //display the values in our table
                                ?>

                                <tr>
                                    <td><?php echo $no3++; ?></td>
                                    <td><?php echo $reservation_date ?></td>
                                    <td><?php echo $reservation_time ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>delete-reservation.php?reservation_id=<?php echo $reservation_id; ?>" class="btn-blue">Delete</a>
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

<?php 
    //process the value from form and save it in database
    //check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
        //button clicked

        //1. get the data from form
        $reservation_date = $_POST['rsv_date'];
        $reservation_time = $_POST['rsv_time'];
        $reservation_table = $_POST['rsv_table'];
        $reservation_code = rand(0000,9999);
        $reservation_name = $_POST['rsv_name'];
        $reservation_phonenum = $_POST['rsv_phonenum'];
        $reservation_status = "Active";

        $user_id = $_POST['user_id'];

        //2. sql query to save the data into database
        $sql = "INSERT INTO tbl_reservation SET
            reservation_date = '$reservation_date',
            reservation_time = '$reservation_time', 
            reservation_table = $reservation_table,
            reservation_code = $reservation_code, 
            reservation_user_id = $user_id,  
            reservation_name = '$reservation_name',
            reservation_phonenum = '$reservation_phonenum', 
            reservation_status = '$reservation_status'
        ";

        //3. execute query and save in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. check whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //data is inserted successfully
            //echo "data inserted";
            //create a session variable to display message
            //$_SESSION['reservation'] = "<div class='success'>Your Table is Booked!</div>";
            //redirect page to manage admin
            //header("location:".SITEURL);

            $_SESSION['user_id'] = $user_id;

            echo '<script>alert("Your table is booked!")</script>';
            echo '<script>window.location="index.php"</script>';
        }
        else{
            //failed to insert data
            //echo "failed to insert data";
            //create a session variable to display message
            //$_SESSION['add_user'] = "<div class='success'>Fail to Book Your Table</div>";
            //redirect page to add admin
            //header("location:".SITEURL.'reservation.php');

            echo '<script>alert("Failed to Book Table!")</script>';
            echo '<script>window.location="reservation.php"</script>';
        }
    }
?>

<?php include('partials-front/footer.php') ?>