<?php
    //echo "update category page";
    include('partials/admin-header.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
            //check whether the id is set or not
            if(isset($_GET['category_id'])){
                //get the id and all other details
                //echo "getting the data";

                $category_id = $_GET['category_id'];

                //create sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE category_id=$category_id";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count == 1){
                    //get all data
                    $row = mysqli_fetch_assoc($res);
                    $category_name = $row['category_name'];
                    $current_category_image = $row['category_image_name'];
                    $category_featured = $row['category_featured'];
                    $category_active = $row['category_active'];
                }
                else{
                    //redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else{
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="category_name" value="<?php echo $category_name ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_category_image != ""){
                                //display the category image
                                ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_category_image ?>" width="150px">

                                <?php
                            }
                            else{
                                //display message that image is not added yet
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="new_category_image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($category_featured=="Yes"){echo "checked";} ?> type="radio" name="category_featured" value="Yes"> Yes
                        <input <?php if($category_featured=="No"){echo "checked";} ?> type="radio" name="category_featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($category_active=="Yes"){echo "checked";} ?> type="radio" name="category_active" value="Yes"> Yes
                        <input <?php if($category_active=="No"){echo "checked";} ?> type="radio" name="category_active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_category_image" value="<?php echo $current_category_image ?>">
                        <input type="hidden" name="category_id" value="<?php echo $category_id ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-green">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                //echo "clicked";
                //1. get all the values from our form
                $category_id = $_POST['category_id'];
                $category_name = $_POST['category_name'];
                $current_category_image = $_POST['current_category_image'];
                $category_featured = $_POST['category_featured'];
                $category_active = $_POST['category_active'];

                //2. updating new image if selected

                //check whether the image is selected or not
                if(isset($_FILES['new_category_image']['name'])){
                    //get the image details
                    $category_image_name = $_FILES['new_category_image']['name'];

                    //check whether the image is available or not
                    if($category_image_name != ""){
                        //image available
                        //upload the new image

                        //A. auto rename our image so if the same image is uploaded, it is not replaced
                        //get the extension of our image (jpg, png, gif, etc) e.g. specialfood1.jpg
                        $ext = end(explode('.', $category_image_name));

                        //rename the image
                        $category_image_name = "food_category_".rand(000, 999).'.'.$ext; //food_category_834.jpg


                        $category_source_path = $_FILES['new_category_image']['tmp_name'];

                        $category_destination_path = "../images/category/".$category_image_name;

                        //finally upload the image
                        $upload = move_uploaded_file($category_source_path, $category_destination_path);

                        //check whether the image is uploaded or not
                        //and if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload == false){
                            //set message
                            $_SESSION['upload_category_image'] = "<div class='error'>Failed to Upload Image.</div>";
                            //redirect to add category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //stop the process
                            die();
                        }

                        //B. remove the current image if available
                        if($current_category_image != ""){
                            $remove_category_path = "../images/category/".$current_category_image;
                            $remove_category_image = unlink($remove_category_path);
    
                            //check whether the image is removed or not
                            //if failed to remove then display message and stop the process
                            if($remove_category_image == false){
                                //failed to remove image
                                $_SESSION['failed_remove_category'] = "<div class='error'>Failed to Remove Current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die(); //stop the process
                            }
                        }

                    }
                    else{
                        $category_image_name = $current_category_image;
                    }
                }
                else{
                    $category_image_name = $current_category_image;
                }

                //3. update database
                $sql2 = "UPDATE tbl_category SET 
                category_name = '$category_name', 
                category_image_name = '$category_image_name', 
                category_featured = '$category_featured', 
                category_active = '$category_active' 
                WHERE category_id = $category_id
                ";

                //execute query
                $res2 = mysqli_query($conn, $sql2);

                //4. redirect to manage category with message
                //check whether query executed or not
                if($res2 == true){
                    //category updated
                    $_SESSION['update_category'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed to update category
                    $_SESSION['update_category'] = "<div class='error'>Failed to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/admin-footer.php'); ?>