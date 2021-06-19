<?php include('partials-front/header.php') ?>


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
        
        <div class="text-center">
            <a href="<?php echo SITEURL; ?>unlock-menu.php">Unlock Ordering Feature</a>
        </div>
        
    </div>
    
    </section>
    <!-- food menu section ends here -->


<?php include('partials-front/footer.php') ?>