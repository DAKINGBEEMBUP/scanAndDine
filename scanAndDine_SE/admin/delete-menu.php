<?php

    //include constants page
    include('../config/constants.php');

    //php echo "delete food";
    
    if(isset($_GET['menu_id']) && isset($_GET['menu_image_name'])){
        //process to delete
        //echo "Process to delete";

        //1. get the id and image name
        $menu_id = $_GET['menu_id'];
        $menu_name = $_GET['menu_image_name'];

        //2. remove the image if available
        //check whether the image is available or not and delete only if available
        if($menu_image_name != ""){
            //it has image and need to be removed from the folder
            //get the image path
            $menu_image_path = "../images/menu/".$menu_image_name;

            //remove the image file from folder
            $remove_menu_image = unlink($menu_image_path);

            //check whether the image is removed or not
            if($remove_menu_image == false){
                //failed to remove image
                $_SESSION['upload_menu_image'] = "<div class='error'>Failed to Remove Image File.</div>";
                //redirect to manage menu
                header('location:'.SITEURL.'admin/manage-menu.php');
                //stop the process of deleting food
                die();
            }
        }

        //3. delete menu from the database
        $sql = "DELETE FROM tbl_menu WHERE menu_id = $menu_id";

        //execute query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not and set the session message respectively
        //4. redirect to manage food with session message
        if($res == true){
            //food deleted
            $_SESSION['delete_menu'] = "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-menu.php');
        }
        else{
            $_SESSION['delete_menu'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-menu.php');
        }

        
    }
    else{
        //redirect to manage food page
        //echo "Redirect";

        $_SESSION['unauthorized_menu_delete'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-menu.php');
    }
    
?>