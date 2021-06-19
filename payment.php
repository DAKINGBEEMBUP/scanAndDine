<?php include('partials-front/header.php') ?>
    
    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Your Payment</h1>
            <br />
            <br />
            <br />


            <table class="tbl-full">
                <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Orders</th>
                    <th>Total</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM tbl_transaction WHERE transaction_status='Not Paid'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $idx = 1;

                    if($count > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $total = 0;
                            $user_id = $row['user_id'];
                            $transaction_id = $row['transaction_id'];
                            $transaction_date = $row['transaction_date'];
                            $transaction_time = $row['transaction_time'];
                            $transaction_status = $row['transaction_status'];
                            ?>

                            <?php
                                $sql5 = "SELECT * FROM tbl_user WHERE user_id=$user_id";
                                $res5 = mysqli_query($conn, $sql5);
                                    if($res5==true){
                                    $row5 = mysqli_fetch_assoc($res5);
                                    $user_name = $row5['user_name'];
                                }
                            ?>
                            
                            <tr>
                                <td><?php echo $idx++; ?></td>
                                <td><?php echo $transaction_date; ?></td>
                                <td><?php echo $transaction_time; ?></td>
                                <td>
                                    <?php
                                        $sql2 = "SELECT * FROM tbl_transaction_det WHERE transaction_id=$transaction_id";
                                        $res2 = mysqli_query($conn, $sql2);
                                        $count2 = mysqli_num_rows($res2);
                                        if($count2>0){
                                            while($row2 = mysqli_fetch_assoc($res2)){
                                                $menu_id = $row2['menu_id'];
                                                $quantity = $row2['quantity'];

                                                $sql3 = "SELECT * FROM tbl_menu WHERE menu_id=$menu_id";
                                                $res3 = mysqli_query($conn, $sql3);

                                                if($res3 == true){
                                                    $row3 = mysqli_fetch_assoc($res3);
                                                    $menu_name = $row3['menu_name'];
                                                    $menu_price = $row3['menu_price'];
                                                    $total = $total + ($quantity * $menu_price);
                                                    
                                                    echo $menu_name;
                                                    echo "  x  ";
                                                    echo $quantity;
                                                    echo "<br>";
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                                <td><?php echo number_format($total, 2); ?></td>
                            </tr>

                            
                            <?php
                        }

                    }
                    else{
                        //we don't have data
                        //we will display the message inside table
                        ?>
                        
                        <tr>
                            <td colspan="6"><div class="error">No Current Transaction.</div></td>
                        </tr>

                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- main content section ends here -->

            <!-- main content section starts here -->
            <div class="main-content">
        <div class="wrapper">
           <h1>Choose Payment Method</h1>
           
           <br /><br />


           <form action="" method="POST">
               <table class="tbl-30">
                <tr>
                        <td>Choose one of the payment method below: </td>
                        <td>
                            <input type="radio" name="payment_method" value="GoPay"> GoPay <br>
                            <input type="radio" name="payment_method" value="OVO"> OVO <br>
                            <input type="radio" name="payment_method" value="ShopeePay"> ShopeePay <br>
                            <input type="radio" name="payment_method" value="Bank Transfer"> Bank Transfer <br>
                            <input type="radio" name="payment_method" value="Credit Card"> Credit Card <br>
                            <input type="radio" name="payment_method" value="Cash"> Cash <br>
                        </td>
                </tr>

                <tr>  
                    <td colspan="2">
                        <input type="submit" name="submit" value="Pay" class="btn-green">
                    </td>
                </tr>
            
               </table>
           </form>
           
           <?php 
            //check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                //echo "clicked";

                //for radio input, we need to check whether the button is selected or not
                if(isset($_POST['payment_method'])){
                    //get the value from form
                    $payment_method = $_POST['payment_method'];
                }
                else{
                    //set the default value
                    $payment_method = "Cash";
                }

                //2. create sql query to insert category into database
                $sql4 = "UPDATE tbl_transaction SET 
                payment_method = '$payment_method', 
                transaction_status = 'Paid' WHERE transaction_id=$transaction_id
                ";

                //3. execute the query and save in database
                $res4 = mysqli_query($conn, $sql4);

                //4. check whether the query executed or not and data added or not
                if($res4 == true){
                    //query executed and category added
                    $sql6 = "UPDATE tbl_reservation SET reservation_status = 'Not Active' 
                    WHERE reservation_time=$transaction_time AND reservation_date=$transaction_date 
                    AND reservation_name=$user_name
                    ";
                    $res6 = mysqli_query($conn, $sql6);

                    if(res6==true){
                        unset($_SESSION['transaction_id']);

                        echo '<script>alert("Your Payment is Successfull")</script>';
                        echo '<script>window.location="index.php"</script>';
                    }
                }
                else{
                    //failed to add category
                    echo '<script>alert("Failed to Process Payment!")</script>';
                    echo '<script>window.location="payment.php"</script>';
                }
            }
        ?>

        </div>
    </div>
    <!-- main content section ends here -->

    <?php include('partials-front/footer.php') ?>