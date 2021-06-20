<?php
    $msg = "";
    $totalPeople = $_GET['People'];
    $date = $_GET['Date'];
    $time = $_GET['Time'];
    $tableNo = $_GET['TableNo'];

    $msg = $totalPeople . "," . $date . "," . $time . "," . $tableNo; 
    
    header("location: reservation2.php?msg=$msg");
   



?>

