<?php include('partials/admin-header.php'); ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Menu</h1>
            <br><br>

            <!-- button to add food/menu -->
            <a href="<?php echo SITEURL; ?>admin/add-menu.php" class="btn-blue">Add Menu</a>
            <br />
            <br />
            <br />

            <?php
                if(isset($_SESSION['add_menu'])){
                    echo $_SESSION['add_menu'];
                    unset($_SESSION['add_menu']);
                }
                if(isset($_SESSION['delete_menu'])){
                    echo $_SESSION['delete_menu'];
                    unset($_SESSION['delete_menu']);
                }
                if(isset($_SESSION['upload_menu_image'])){
                    echo $_SESSION['upload_menu_image'];
                    unset($_SESSION['upload_menu_image']);
                }
                if(isset($_SESSION['unauthorized_menu_delete'])){
                    echo $_SESSION['unauthorized_menu_delete'];
                    unset($_SESSION['unauthorized_menu_delete']);
                }
                if(isset($_SESSION['update_menu'])){
                    echo $_SESSION['update_menu'];
                    unset($_SESSION['update_menu']);
                }
                if(isset($_SESSION['remove_failed_menu'])){
                    echo $_SESSION['remove_failed_menu'];
                    unset($_SESSION['remove_failed_menu']);
                }
            ?>

            <table class="tbl-full">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //create a sql query to get all food 
                    $sql = "SELECT * FROM tbl_menu";

                    //execute query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check whether we have food or not
                    $count = mysqli_num_rows($res);

                    //create index / serial number
                    $idx = 1;

                    if($count > 0){
                        //we have menu items/foods in the database
                        //get the foods from database and display
                        while($row = mysqli_fetch_assoc($res)){
                            //get the values from individual columns
                            $menu_id = $row['menu_id'];
                            $menu_name = $row['menu_name'];
                            $menu_price = $row['menu_price'];
                            $menu_image_name = $row['menu_image_name'];
                            $menu_featured = $row['menu_featured'];
                            $menu_active = $row['menu_active'];
                            ?>

                            <tr>
                                <td><?php echo $idx++; ?></td>
                                <td><?php echo $menu_name ?></td>
                                <td><?php echo $menu_price ?></td>
                                <td>
                                    <?php 
                                        //check whether we have image or not
                                        if($menu_image_name==""){
                                            //display error message, there is no image
                                            echo "<div class='error'>Image Not Added.</div>";
                                        }
                                        else{
                                            //we have image, display image
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/menu/<?php echo $menu_image_name; ?>" width="150px">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $menu_featured ?></td>
                                <td><?php echo $menu_active ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-menu.php?menu_id=<?php echo $menu_id ?>" class="btn-green">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-menu.php?menu_id=<?php echo $menu_id ?>&menu_image_name=<?php echo $menu_image_name ?>" class="btn-red">Delete Food</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else{
                        //food not added in database
                        echo "<tr><td colspan='7' class='error'>Food Not Added Yet.</td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- main content section ends here -->

<?php include('partials/admin-footer.php'); ?>