<?php include('partials/admin-header.php'); ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order Transactions</h1>
            <br />
            <br />
            <br />


            <table class="tbl-full">
                <tr>
                    <th>No.</th>
                    <th>Transaction ID</th>
                    <th>User Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Orders</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM tbl_transaction";
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
                            
                            <tr>
                                <td><?php echo $idx++; ?></td>
                                <td><?php echo $transaction_id; ?></td>

                                <?php
                                    $sql4 = "SELECT * FROM tbl_user WHERE user_id=$user_id";
                                    $res4 = mysqli_query($conn, $sql4);
                                    if($res4==true){
                                        $row4 = mysqli_fetch_assoc($res4);
                                        $user_name = $row4['user_name'];
                                    }
                                ?>
                                <td><?php echo $user_name; ?></td>
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
                                <td><?php echo $transaction_status; ?></td>
                            </tr>

                            
                            <?php
                        }

                    }
                    else{
                        //we don't have data
                        //we will display the message inside table
                        ?>
                        
                        <tr>
                            <td colspan="8"><div class="error">No Orders Yet.</div></td>
                        </tr>

                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- main content section ends here -->



<?php include('partials/admin-footer.php'); ?>