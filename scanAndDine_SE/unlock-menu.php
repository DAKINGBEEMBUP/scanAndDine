<?php include('partials-front/header.php') ?>

<form action="" method="POST" class="text-center">
    Input Code to Unlock Ordering Feature: <br>
    <input type="text" name="reservation_code" placeholder="Enter Code from Our Staff"> <br><br>
    <input type="submit" name="submit" value="Unlock" class="btn-blue">
    <br><br>
</form>

<?php 
    //process the value from form and save it in database
    //check whether the submit button is clicked or not

    if(isset($_POST['submit'])){

        //echo "clicked";
        //button clicked

        //1. get the data from form
        $reservation_code = $_POST['reservation_code'];
        $user_id = $_SESSION['user_id'];

        //echo $user_id;

        //2. sql query to save the data into database
        $sql = "SELECT * FROM tbl_reservation WHERE reservation_user_id=$user_id AND reservation_status='Active'";

        //3. execute query and save in database
        $res = mysqli_query($conn, $sql);

        //4. check whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE && !isset($_SESSION['transaction_id'])){

            $row = mysqli_fetch_assoc($res);
            $reservation_date = $row['reservation_date'];
            $reservation_time = $row['reservation_time'];

            $sql2 = "INSERT INTO tbl_transaction SET 
            user_id = '$user_id', 
            transaction_date = '$reservation_date', 
            transaction_time = '$reservation_time', 
            payment_method = 'Not Choosen', 
            transaction_status = 'Not Paid'
            ";

            $res2 = mysqli_query($conn, $sql2);

            if(res2 == true){
                $sql3 = "SELECT * FROM tbl_transaction WHERE user_id=$user_id";

                $res3 = mysqli_query($conn, $sql3);

                if($res3 == true){
                    $row3 = mysqli_fetch_assoc($res3);
                    $transaction_id = $row3['transaction_id'];
                    $_SESSION['transaction_id'] = $transaction_id;

                    echo '<script>alert("Your Ordering Feature is Unlocked!")</script>';
                    echo '<script>window.location="food.php"</script>';
                }
            }
            else{
                echo '<script>alert("Failed to Unlock Ordering Feature!")</script>';
                echo '<script>window.location="unlock-menu.php"</script>';
            }
        }
        else if($res == TRUE && isset($_SESSION['transaction_id'])){
            echo '<script>alert("Your Ordering Feature is Unlocked!")</script>';
            echo '<script>window.location="food.php"</script>';
        }
        else{
             echo '<script>alert("Failed to Unlock Ordering Feature!")</script>';
             echo '<script>window.location="unlock-menu.php"</script>';
        }
    }
?>

<?php include('partials-front/footer.php') ?>