    <?php include('partials-front/header.php') ?>
    
    <!-- categories section starts here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //display all the categories that are active
                $sql = "SELECT * FROM tbl_category WHERE category_active='Yes'";


                //execute the query
                $res = mysqli_query($conn, $sql);

                //count the rows
                $count = mysqli_num_rows($res);

                //check whether categories are available
                if($count>0){
                    //categories are available
                    while($row=mysqli_fetch_assoc($res)){
                        //get the values
                        $category_id = $row['category_id'];
                        $category_name = $row['category_name'];
                        $category_image_name = $row['category_image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-food.php?category_id=<?php echo $category_id ?>">
                        <div class="box-3 float-container">
                            <div class="inner-box-3">
                                <div class="box-front">
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
                                </div>
                                
                                <div class="box-behind">
                                    <h3 class="float-text text-white"><?php echo $category_name ?></h3>
                                </div>

                            </div>
                        </div>
                        </a>

                        <?php
                    }
                }
                else{
                    echo "<div class='error'>Category Not Found.</div>";
                }
            ?>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- categories section ends here -->

    <?php include('partials-front/footer.php') ?>