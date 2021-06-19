    <?php include('partials-front/header.php') ?>

    <?php
        if(isset($_SESSION['reservation'])){ //checking whether the session is set or not
            // echo $_SESSION['reservation']; //displaying session message
            //unset($_SESSION['reservation']); //removing session message
        }
    ?>

    <!-- categories section starts here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
              //create sql query to display categories from database
              //you can limit the number of categories
              $sql = "SELECT * FROM tbl_category WHERE category_active='Yes' AND category_featured='Yes' LIMIT 6";
              
              //execute the query
              $res = mysqli_query($conn, $sql);

              //count the rows
              $count = mysqli_num_rows($res);

              if($count > 0){
                  //categories available
                  while($row=mysqli_fetch_assoc($res)){
                      //get the values (id, name, image name)
                      $category_id = $row['category_id'];
                      $category_name = $row['category_name'];
                      $category_image_name = $row['category_image_name'];
                      ?>

                      <a href="#">
                        <div class="box-3 float-container">
                            <?php
                            //check whether image is available or not
                                if($category_image_name == ""){
                                    //display message
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else{
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $category_image_name ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                            <h3 class="float-text text-white"><?php echo $category_name ?></h3>
                        </div>
                      </a>

                      <?php
                  }
              }
              else{
                  //categories not available
                  echo "<div class='error'>Category Not Added.</div>";
              }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- categories section ends here -->

    <!-- food-menu section starts here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //getting foods from database that are active and featured
                $sql2 = "SELECT * FROM tbl_menu WHERE menu_active='Yes' AND menu_featured='Yes' LIMIT 6";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0){
                    //food available
                    while($row2=mysqli_fetch_assoc($res2)){
                        //get all values
                        $menu_id = $row2['menu_id'];
                        $menu_name = $row2['menu_name'];
                        $menu_price = $row2['menu_price'];
                        $menu_description = $row2['menu_description'];
                        $menu_image_name = $row2['menu_image_name'];
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
                                <h4><?php echo $menu_name ?></h4>
                                <p class="food-price">$<?php echo $menu_price ?></p>
                                <p class="food-detail">
                                    <?php echo $menu_description ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else{
                    //food not available
                    echo "<div class='error'>Food Not Available.</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- food menu section ends here -->

    

    <?php include('partials-front/footer.php') ?>