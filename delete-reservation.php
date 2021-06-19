<?php 
    //include constant.php file here since the admin-header.php is not used
    include('config/constants.php');

    //1.get the ID of admin to be deleted
    echo $reservation_id = $_GET['reservation_id'];

    //2. create sql query to delete admin
    $sql = "DELETE FROM tbl_reservation WHERE reservation_id=$reservation_id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully or not
    if($res==true){
        //query executed successfull and admin deleted
        //echo "admin deleted";

        //create session variable to display message
        // $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        // redirect to manage admin page
        // header('location:'.SITEURL.'admin/manage-admin.php');

        echo '<script>alert("Your reservation is deleted!")</script>';
        echo '<script>window.location="reservation.php"</script>';
    }
    else{
        //failed to delete admin
        // echo "failed to delete admin";

        echo '<script>alert("Failed to delete reservation!")</script>';
        echo '<script>window.location="reservation.php"</script>';
    }
    
    //3. redirect to manage admin page with message (success or error)
?>