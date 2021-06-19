<?php include('partials/admin-header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add_category'])){
                echo $_SESSION['add_category'];
                unset($_SESSION['add_category']);
            }
            if(isset($_SESSION['upload_category_image'])){
                echo $_SESSION['upload_category_image'];
                unset($_SESSION['upload_category_image']);
            }
        ?>

        <br><br>

        <!-- add category form starts here -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" name="category_name" placeholder="Category Name">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="category_image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="category_featured" value="Yes"> Yes
                        <input type="radio" name="category_featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="category_active" value="Yes"> Yes
                        <input type="radio" name="category_active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-green">
                    </td>
                </tr>
            </table>
        </form>
        <!-- add category form ends here -->

        <?php 
            //check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                //echo "clicked";

                //1. get the value from category form
                $category_name = $_POST['category_name'];

                //for radio input, we need to check whether the button is selected or not
                if(isset($_POST['category_featured'])){
                    //get the value from form
                    $category_featured = $_POST['category_featured'];
                }
                else{
                    //set the default value
                    $category_featured = "No";
                }

                //for radio input, we need to check whether the button is selected or not
                if(isset($_POST['category_active'])){
                    //get the value from form
                    $category_active = $_POST['category_active'];
                }
                else{
                    //set the default value
                    $category_active = "No";
                }

                //check whether the image is selected or not and set the value for image name accordingly
                //print_r($_FILES['category_image']);

                //die(); //break the code here 

                if(isset($_FILES['category_image']['name'])){
                    //upload the image
                    //to upload image we need image name, source path and destination path path
                    $category_image_name = $_FILES['category_image']['name'];

                    //upload image only if image is selected
                    if($category_image_name != ""){
                        
                        //auto rename our image so if the same image is uploaded, it is not replaced
                        //get the extension of our image (jpg, png, gif, etc) e.g. specialfood1.jpg
                        $ext = end(explode('.', $category_image_name));

                        //rename the image
                        $category_image_name = "food_category_".rand(000, 999).'.'.$ext; //food_category_834.jpg


                        $category_source_path = $_FILES['category_image']['tmp_name'];

                        $category_destination_path = "../images/category/".$category_image_name;

                        //finally upload the image
                        $upload = move_uploaded_file($category_source_path, $category_destination_path);

                        //check whether the image is uploaded or not
                        //and if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload == false){
                            //set message
                            $_SESSION['upload_category_image'] = "<div class='error'>Failed to Upload Image.</div>";
                            //redirect to add category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else{
                    //don't upload image and set the image_name value as blank
                    $category_image_name = "";
                }

                //2. create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET 
                category_name = '$category_name', 
                category_image_name = '$category_image_name',
                category_featured = '$category_featured', 
                category_active = '$category_active'
                ";

                //3. execute the query and save in database
                $res = mysqli_query($conn, $sql);

                //4. check whether the query executed or not and data added or not
                if($res == true){
                    //query executed and category added
                    $_SESSION['add_category'] = "<div class='success'>Category Added Successfully.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed to add category
                    $_SESSION['add_category'] = "<div class='error'>Failed to Add Category.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/admin-footer.php'); ?>