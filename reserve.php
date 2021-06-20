<?php
    include('config/constants.php');

        //theres data        $reservation_pax = $_GET['People'];
        $reservation_date = $_GET['Date'];
        $reservation_time = $_GET['Time'];
        $reservation_table = $_GET['TableNo'];
        $reservation_code = rand(0000,9999);
        $reservation_name = $_GET['rsv_name'];
        $reservation_phonenum = $_GET['rsv_phonenum'];
        $reservation_status = "Active";

        $user_id = $_GET['user_

        //1. get the data from form
id'];

        //2. sql query to save the data into database
        $sql = "INSERT INTO tbl_reservation SET 
            reservation_pax = $reservation_pax, 
            reservation_date = '$reservation_date',
            reservation_time = '$reservation_time', 
            reservation_table = $reservation_table,
            reservation_code = $reservation_code, 
            reservation_user_id = $user_id,  
            reservation_name = '$reservation_name',
            reservation_phonenum = '$reservation_phonenum', 
            reservation_status = '$reservation_status'
        ";

        //3. execute query and save in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. check whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE){

            $_SESSION['user_id'] = $user_id;

            //START OF DAVIDS CODE
            $msg = "";
            $totalPeople = $_GET['People'];
            $date = $_GET['Date'];
            $time = $_GET['Time'];
            $tableNo = $_GET['TableNo'];

            //Kirim ke database;

            $msg = $totalPeople . "," . $date . "," . $time . "," . $tableNo; 
            // $_SESSION['msgSession'] = $msg;
            
            //Kirim ke database;
            // header("location: reservation2.php?msg=$msg");
            header("location: booking.php?msg=$msg");
            //END OF DAVIDS CODE

            // echo '<script>alert("Your table is booked!")</script>';
            // echo '<script>window.location="index.php"</script>';
        }
        else{
            //failed to insert data
            //echo "failed to insert data";

            //echo '<script>alert("Failed to Book Table!")</script>';
            //echo '<script>window.location="reservation.php"</script>';
        }
    
?>