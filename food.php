<?php include('partials-front/header.php') ?>

<?php
    if(isset($_POST['add_to_cart'])){
        //echo "masuk";
        if(isset($_SESSION['shopping_cart'])){
            $item_array_id = array_column($_SESSION['shopping_cart'], "menu_id");
            if(!in_array($_GET['menu_id'], $item_array_id)){
                $count = count($_SESSION['shopping_cart']);
                $item_array = array(
                    'menu_id' => $_GET['menu_id'],
                    'menu_name' => $_POST['hidden_name'],
                    'menu_price' => $_POST['hidden_price'],
                    'menu_quantity' => $_POST['quantity']
                );
                $_SESSION['shopping_cart'][$count+1] = $item_array;
                // header('location:'.SITEURL.'food.php');
                echo '<script>window.location="food.php"</script>';
            }
            else{
                $count = count($_SESSION['shopping_cart']);
                $item_array = array(
                    'menu_id' => $_GET['menu_id'],
                    'menu_name' => $_POST['hidden_name'],
                    'menu_price' => $_POST['hidden_price'],
                    'menu_quantity' => $_POST['quantity']
                );
                // $_SESSION['shopping_cart'][$count-1] = $item_array;
                echo '<script>alert("Item already added")</script>';
                echo '<script>window.location="food.php"</script>';
            }
        }
        else{
            $item_array = array(
                'menu_id' => $_GET['menu_id'],
                'menu_name' => $_POST['hidden_name'],
                'menu_price' => $_POST['hidden_price'],
                'menu_quantity' => $_POST['quantity']
            );
            $_SESSION['shopping_cart'][0] = $item_array;
            // header('location:'.SITEURL.'food.php');
        }
    }
?>

    <!-- food menu section starts here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //display active foods
                $sql = "SELECT * FROM tbl_menu WHERE menu_active='Yes'";

                $res = mysqli_query($conn, $sql);
                //$res = mysqli_query($con, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0){
                    //foods available
                    while($row=mysqli_fetch_assoc($res)){
                        $menu_id = $row['menu_id'];
                        $menu_name = $row['menu_name'];
                        $menu_description = $row['menu_description'];
                        $menu_price = $row['menu_price'];
                        $menu_image_name = $row['menu_image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //check image availability
                                    if($menu_image_name==""){
                                        //image not available
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else{
                                        //image available
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/menu/<?php echo $menu_image_name ?>" alt="" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <form action="<?php echo SITEURL; ?>food.php?action=add&menu_id=<?php echo $menu_id ?>" method="POST">
                                    <!-- menu name -->
                                    <h4><?php echo $menu_name ?></h4>
                                    <!-- menu price -->
                                    <p class="food-price">$<?php echo $menu_price ?></p>
                                    <p class="food-detail">
                                        <!-- menu description -->
                                        <?php echo $menu_description ?>
                                    </p>
                                    <br>

                                    <!-- <a href="#" class="btn btn-primary">Order Now</a> -->
                                    <input type="text" name="quantity" value="1">

                                    <!-- <input type="hidden" name="hidden_id" value="<?php //echo $menu_id ?>"> -->
                                    <input type="hidden" name="hidden_name" value="<?php echo $menu_name ?>">
                                    <input type="hidden" name="hidden_price" value="<?php echo $menu_price ?>">

                                    <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary"> 
                                </form>
                            </div>

                        </div>

                        <?php
                    }
                }
                else{
                    //food not available
                    echo "<div class='error'>Food Not Found.</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
        
    </section>
    <!-- food menu section ends here -->

    <div class="table-cart">
        <div class="container">
            <table>
                <tr>
                    <th width="40%">Item Name</th>
                    <th width="10%">Quantity</th>
                    <th width="20%">Price</th>
                    <th width="15%">Total</th>
                </tr>
                <?php
                    $transaction_id = $_SESSION['transaction_id'];
                    if(!empty($_SESSION['shopping_cart'])){
                        $total = 0;
                        foreach($_SESSION['shopping_cart'] as $keys => $values){

                            $menu_id = $values['menu_id'];
                            $quantity = $values['menu_quantity'];

                            $sql3 = "SELECT * FROM tbl_transaction_det WHERE menu_id=$menu_id";
                            $res3 = mysqli_query($conn, $sql3);
                            $count3 = mysqli_num_rows($res3);
                            if($count3 != 1){

                                $sql2 = "INSERT INTO tbl_transaction_det SET
                                transaction_id = $transaction_id,
                                menu_id = '$menu_id',
                                quantity = '$quantity'
                                ";

                                //3. execute query and save in database
                                $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());

                                //4. check whether the (query is executed) data is inserted or not and display appropriate message
                                if($res2==TRUE){
                                }
                                else{
                                    echo '<script>alert("Failed to Place Order!")</script>';
                                    echo '<script>window.location="food.php"</script>';
                                }

                                }

                            ?>
                            <tr>
                                <td><?php echo $values['menu_name']; ?></td>
                                <td><?php echo $values['menu_quantity']; ?></td>
                                <td>$ <?php echo $values['menu_price']; ?></td>
                                <td>$ <?php echo number_format($values['menu_quantity'] * $values['menu_price'], 2); ?></td>
                            </tr>
                            <?php

                                $total = $total + ($values['menu_quantity'] * $values['menu_price']);
                        }
                        ?>

                        <tr>
                            <td colspan="3" align="right">Total</td>
                            <td align="right">$ <?php echo number_format($total, 2); ?></td>
                        </tr>

                        <?php
                    }
                ?>
          </table>
          <br><br><br><br><br><br>
        </div>
    </div>

<?php include('partials-front/footer.php') ?>
