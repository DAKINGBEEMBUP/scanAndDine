<?php include('partials/admin-header.php'); ?>
<?php
    //check whether id is set or not
    if(isset($_GET['menu_id'])){
        //get all the details

        $menu_id = $_GET['menu_id'];

        //sql query to get the selected food
        $sql2 = "SELECT * FROM tbl_menu WHERE menu_id=$menu_id";

        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //get the individual values for the selected menu item
        $menu_name = $row2['menu_name'];
        $menu_description = $row2['menu_description'];
        $menu_price = $row2['menu_price'];
        $current_image_menu = $row2['menu_image_name'];
        $current_category_menu = $row2['category_id'];
        $menu_featured = $row2['menu_featured'];
        $menu_active = $row2['menu_active'];
    }
    else{
        //redirect to manage food
        header('location:'.SITEURL.'admin/manage-menu.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Menu</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" name="menu_name" value="<?php echo $menu_name ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="menu_description" cols="30" rows="5"><?php echo $menu_description ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="menu_price" value="<?php echo $menu_price ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image_menu == ""){

                                //image not available
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else{
                                //image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/menu/<?php echo $current_image_menu; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="menu_image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="menu_category">

                            <?php
                                //query to get active categories
                                $sql = "SELECT * FROM tbl_category WHERE category_active = 'Yes'";

                                //execute the query
                                $res = mysqli_query($conn, $sql);

                                //count rows
                                $count = mysqli_num_rows($res);

                                //check whether category available or not
                                if($count>0){
                                    //category available
                                    while($row = mysqli_fetch_assoc($res)){
                                        $category_name = $row['category_name'];
                                        $category_id = $row['category_id'];
                                        
                                        //echo "<option value='$category_id'>$category_name</option>";
                                        ?>
                                            <option <?php if($current_category_menu==$category_id){echo "selected";} ?> value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
                                        <?php
                                    }
                                }
                                else{
                                    //category not available
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($menu_featured=="Yes"){echo "checked";} ?> type="radio" name="menu_featured" value="Yes"> Yes
                        <input <?php if($menu_featured=="No"){echo "checked";} ?> type="radio" name="menu_featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($menu_active=="Yes"){echo "checked";} ?> type="radio" name="menu_active" value="Yes"> Yes
                        <input <?php if($menu_active=="No"){echo "checked";} ?> type="radio" name="menu_active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Menu" class="btn-green">
                    </td>
                </tr>

            </table>
        </form>

        <?php

            if(isset($_POST['submit'])){
                //1. get all the details from the form
                // $menu_id = $_POST['menu_id'];
                $menu_name = $_POST['menu_name'];
                $menu_description = $_POST['menu_description'];
                $menu_price = $_POST['menu_price'];
                // $current_image_menu = $_POST['current_image_menu'];
                $menu_category = $_POST['menu_category'];
                
                $menu_featured = $_POST['menu_featured'];
                $menu_active = $_POST['menu_active'];

                
                //2. upload the image if selected
                //check whether upload button is clicked or not
                if(isset($_FILES['menu_image']['name'])){
                    //upload button clicked
                    $image_name_menu = $_FILES['menu_image']['name']; //new image name

                    //check whether the file is available or not
                    if($image_name_menu != ""){
                        //image is available

                        //A. uploading new image
                        //rename the image
                        $exploded = explode('.', $image_name_menu);
                        $ext_menu = end($exploded); //get the extension of the image
                        
                        $image_name_menu = "food_menu_".rand(0000,9999).'.'.$ext_menu; //this will rename the image

                        //get the source and destination path
                        $src_path_menu = $_FILES['menu_image']['tmp_name']; //source path
                        $dest_path_menu = "../images/menu/".$image_name_menu; //destination path

                        //upload the image
                        $upload_menu = move_uploaded_file($src_path_menu, $dest_path_menu);

                        //check whether the image is uploaded or not
                        if($upload_menu == false){
                            //failed to upload
                            $_SESSION['upload_menu_image'] = "<div class='error'>Failed to Upload New Image.</div>";
                            //redirect
                            header('location:'.SITEURL.'admin/manage-menu.php');
                            //stop the process
                            die();
                        }

                        //3. remove the image if new image is uploaded and current image exists
                        //B. remove current image if available
                        if($current_image_menu != ""){
                            //current image is available 
                            //remove the image

                            $remove_path_menu = "../images/menu/".$current_image_menu;

                            $remove_menu = unlink($remove_path_menu);

                            //check whether the image is removed or not
                            if($remove_menu == false){
                                //failed to remove current image
                                $_SESSION['remove_failed_menu'] = "<div class='error'>Failed to Remove Current Image.</div>";
                                //redirect to manage food
                                header('location:'.SITEURL.'admin/manage-menu.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else{
                        $image_name_menu = $current_image_menu;
                    }
                }
                else{
                    $image_name_menu = $current_image_menu;
                }

                $sql3 = "UPDATE tbl_menu
                        SET menu_name = '".$menu_name."',
                            menu_description = '".$menu_description."',
                            menu_price = ".$menu_price.",
                            menu_image_name = '".$image_name_menu."',
                            category_id = ".$category_id.",
                            menu_featured = '".$menu_featured."',
                            menu_active = '".$menu_active."'
                        WHERE menu_id = ".$menu_id;
                //execute query
                $res3 = mysqli_query($conn, $sql3);

                //check whether the query is executed or not
                if($res3==true){
                    //query executed and food updated
                    $_SESSION['update_menu'] = "<div class='success'>Menu Updated Successfully.</div>";
                }
                else{
                    //failed to update menu
                    $_SESSION['update_menu'] = "<div class='error'>Failed to Update Menu.</div>";
                }

                //redirect to manage food with session message
                header('location:'.SITEURL.'admin/manage-menu.php');
            }
        ?>
    </div>
</div>

<?php include('partials/admin-footer.php'); ?>