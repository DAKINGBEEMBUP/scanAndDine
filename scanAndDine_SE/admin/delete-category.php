<?php
    //include constants file
    include('../config/constants.php');

    //echo "Delete Page";

    //check whether the category id and image name value is set or not
    if(isset($_GET['category_id']) AND isset($_GET['category_image_name'])){
        //get the value and delete
        //echo "get value and delete";

        $category_id = $_GET['category_id'];
        $category_image_name = $_GET['category_image_name'];

        //remove the physical image file if available
        if($category_image_name != ""){
            //image is available, so remove it
            $category_path = "../images/category/".$category_image_name;

            //remove the image, unlink returns boolean value 
            $remove_category = unlink($category_path);

            //if failed to remove image then add an error message and stop the process
            if($remove_category == false){
                //set the session message 
                $_SESSION['remove_category'] = "<div class='error'>Failed to Remove Category Image</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process 
                die();
            }
        }

        //delete data from database
        //sql query to delete data from the database
        $sql = "DELETE FROM tbl_category WHERE category_id = $category_id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the data is deleted from database or not
        if($res == true){
            //set success message and redirect
            $_SESSION['delete_category'] = "<div class='success'>Category Deleted Successfully.</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            //set failed message and redirect
            $_SESSION['delete_category'] = "<div class='error'>Failed to Delete Category.</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>