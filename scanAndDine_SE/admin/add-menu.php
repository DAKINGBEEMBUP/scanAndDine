<?php include('partials/admin-header.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['upload_menu_image'])){
                echo $_SESSION['upload_menu_image'];
                unset($_SESSION['upload_menu_image']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="menu_name" placeholder="Enter menu item name">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="menu_description" cols="30" rows="5" placeholder="Description of the Menu Item"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="menu_price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="menu_image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="menu_category">

                            <?php 
                                //create php code to display the categories from database
                                //1. create sql to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE category_active='Yes'";

                                //executing the query
                                $res = mysqli_query($conn, $sql);

                                //count the rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //if count is greater than zero, we have categories, else we dont have any categories
                                if($count > 0){
                                    //we have categories
                                    while($row = mysqli_fetch_assoc($res)){
                                        //get the details of categories
                                        //2. display on dropdown
                                        $category_id = $row['category_id'];
                                        $category_name = $row['category_name'];
                                        ?>

                                        <option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>

                                        <?php
                                    }
                                }
                                else{
                                    //we don't have any categories
                                    ?>

                                    <option value="0">No Category Found</option>

                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="menu_featured" value="Yes"> Yes
                        <input type="radio" name="menu_featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="menu_active" value="Yes"> Yes
                        <input type="radio" name="menu_active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-green">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            //check whether the button is clicked or not
            if(isset($_POST['submit'])){
                //echo "button clicked";

                //add the food in database
                //1. get the data from form
                $menu_name = $_POST['menu_name'];
                $menu_description = $_POST['menu_description'];
                $menu_price = $_POST['menu_price'];
                $menu_category = $_POST['menu_category'];

                //check whether radio button for featured and active are checked or not
                if(isset($_POST['menu_featured'])){
                    $menu_featured = $_POST['menu_featured'];
                }
                else{
                    $menu_featured = "No"; //setting the default value
                }

                if(isset($_POST['menu_active'])){
                    $menu_active = $_POST['menu_active'];
                }
                else{
                    $menu_active = "No"; //setting the default value
                }

                //2. upload the image if selected
                //check whether the select image button is clicked or not and upload the image only if the image
                //is selected
                if(isset($_FILES['menu_image']['name'])){
                    //get the details of the selected image
                    $menu_image_name = $_FILES['menu_image']['name'];

                    //check whether the image is selected or not and upload image only if selected
                    if($menu_image_name != ""){
                        //image is selected

                        //A. Rename the image
                        //get the extension of selected image (jpg, gif, png) 
                        $ext = end(explode('.', $menu_image_name));

                        //create new name for menu image
                        $menu_image_name = "food_menu_".rand(0000, 9999).'.'.$ext; //food_menu_834.jpg

                        //B. Upload the image
                        //get the src path and destination path

                        //source path is the current location of the image
                        $menu_source_path = $_FILES['menu_image']['tmp_name'];

                        //destination path for the image to be uploaded
                        $menu_destination_path = "../images/menu/".$menu_image_name;

                        //finally upload the food image
                        $upload_menu_image = move_uploaded_file($menu_source_path, $menu_destination_path);

                        //check whether image uploaded or not
                        if($upload_menu_image == false){
                            //failed to upload image
                            //redirect to add food page with error message
                            $_SESSION['upload_menu_image'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-menu.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else{
                    $menu_image_name = "";
                }

                //3. insert into database
                
                //create sql query to save or add food
                //for numerical value we do not need to pass value inside quotes '' 
                $sql2 = "INSERT INTO tbl_menu SET 
                menu_name = '$menu_name', 
                menu_description = '$menu_description', 
                menu_price = '$menu_price', 
                menu_image_name = '$menu_image_name', 
                category_id = '$menu_category', 
                menu_featured = '$menu_featured', 
                menu_active = '$menu_active'
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                
                //check whether data is inserted or not
                //4. redirect with message to manage menu page
                if($res2 == true){
                    //data inserted successfully
                    $_SESSION['add_menu'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-menu.php');
                }
                else{
                    //failed to insert data
                    $_SESSION['add_menu'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-menu.php');
                }

            }
        ?>

    </div>
</div>
<?php include('partials/admin-footer.php'); ?>