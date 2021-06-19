<?php include('partials/admin-header.php'); ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br />
            <br />
            <br />

            <?php 
                if(isset($_SESSION['add_category'])){
                    echo $_SESSION['add_category'];
                    unset($_SESSION['add_category']);
                }
                if(isset($_SESSION['remove_category'])){
                    echo $_SESSION['remove_category'];
                    unset($_SESSION['remove_category']);
                }
                if(isset($_SESSION['delete_category'])){
                    echo $_SESSION['delete_category'];
                    unset($_SESSION['delete_category']);
                }
                if(isset($_SESSION['no-category-found'])){
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }
                if(isset($_SESSION['update_category'])){
                    echo $_SESSION['update_category'];
                    unset($_SESSION['update_category']);
                }
                if(isset($_SESSION['upload_category_image'])){
                    echo $_SESSION['upload_category_image'];
                    unset($_SESSION['upload_category_image']);
                }
                if(isset($_SESSION['failed_remove_category'])){
                    echo $_SESSION['failed_remove_category'];
                    unset($_SESSION['failed_remove_category']);
                }
            ?>

            <br><br>

            <!-- button to add category -->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-blue">Add Category</a>
            <br />
            <br />
            <br />

            <table class="tbl-full">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //query to get all category from database
                    $sql = "SELECT * FROM tbl_category";

                    //execute query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count = mysqli_num_rows($res);

                    //create index or number variable and assign value as 1
                    $idx = 1;

                    //check whether we have data in database or not
                    if($count > 0){
                        //we have data in database
                        //get the data and display

                        while($row = mysqli_fetch_assoc($res)){
                            $category_id = $row['category_id'];
                            $category_name = $row['category_name'];
                            $category_image_name = $row['category_image_name'];
                            $category_featured = $row['category_featured'];
                            $category_active = $row['category_active'];

                            ?>
                            
                            <tr>
                                <td><?php echo $idx++; ?></td>
                                <td><?php echo $category_name; ?></td>

                                <td>
                                    <?php 
                                        //check whether image name is available or not
                                        if($category_image_name != ""){
                                            //display image
                                            ?>
                                            
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $category_image_name; ?>" width="120px">

                                            <?php
                                        }
                                        else{
                                            //display the message
                                            echo "<div class='error'>Image not Added.</div>";
                                        }
                                    ?>
                                </td>

                                <td><?php echo $category_featured; ?></td>
                                <td><?php echo $category_active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?category_id=<?php echo $category_id; ?>" class="btn-green">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?category_id=<?php echo $category_id; ?>&category_image_name=<?php echo $category_image_name; ?>" class="btn-red">Delete Category</a>
                                </td>
                            </tr>

                            
                            <?php
                        }

                    }
                    else{
                        //we don't have data
                        //we will display the message inside table
                        ?>
                        
                        <tr>
                            <td colspan="6"><div class="error">No Category Added.</div></td>
                        </tr>

                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- main content section ends here -->

<?php include('partials/admin-footer.php'); ?>