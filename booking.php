<?php
    include('config/constants.php');
    include('login-user-check.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Scan and Dine</title>
		<link rel="stylesheet" href="./style/reservation.css" />
        
        <!-- link the css file -->
		<link rel="stylesheet" href="style/reservation.css" />
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="style/admin.css">

		<script src="js/reservation.js" defer></script>
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js%22%3E"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/mvc/3.0/jquery.validate.unobtrusive.min.js%22%3E"></script>
	</head>
	<body>
		<!-- navbar section starts here -->
		<section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="asset/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <!-- aslinya reservation.php -->
                        <a href="<?php echo SITEURL; ?>booking.php">Reservation</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>view-food.php">Menu</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>logout-user.php">Logout</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>

        </div>
    </section>


    <!-- navbar section ends here -->

		<?php
			//session_start();
		?>

	<?php
        $user_email = $_SESSION['user_email'];

        $sql2 = "SELECT * FROM tbl_user WHERE user_email='$user_email'";

        $res2 = mysqli_query($conn, $sql2);

        if($res2==true){
            $count2 = mysqli_num_rows($res2);

            if($count2 == 1){
                $row2 = mysqli_fetch_assoc($res2);

                $user_id = $row2['user_id'];
                $user_name = $row2['user_name'];
                $user_phonenum = $row2['user_phonenum'];
            }
        }
    ?>

		<main>
			<div class="left-reserve">
				<div class="first-row">
					<div class="first table">
						<h3>Table 1</h3>
						<div class="meja"><p>2</p></div>
					</div>
					<div class="second table">
						<h3>Table 2</h3>
						<div class="meja"><p>4</p></div>
					</div>
					<div class="third table">
						<h3>Table 3</h3>
						<div class="meja"><p>2</p></div>
					</div>
				</div>
				<div class="second-row">
					<div class="fourth table">
						<h3>Table 4</h3>
						<div class="meja"><p>2</p></div>
					</div>
					<div class="fifth table">
						<h3>Table 5</h3>
						<div class="meja"><p>4</p></div>
					</div>
					<div class="sixth table">
						<h3>Table 6</h3>
						<div class="meja"><p>2</p></div>
					</div>
				</div>
				<div class="third-row">
					<div class="seventh table">
						<h3>Table 7</h3>
						<div class="meja"><p>6</p></div>
					</div>
					<div class="eigth table">
						<h3>Table 8</h3>
						<div class="meja"><p>6</p></div>
					</div>
				</div>
			</div>
			<div class="right-reserve">
				<!-- <hr class="line1" /> -->
				<!-- <hr class="line2" /> -->
				<div class="book-form">
					<h2>Reservation For Member</h2>
					<form name="reservationForm" id="formID" method="get" action = "reserve.php">
						<div class="first-row">
							<div class="label">
								<label for="people"><img src="asset/people.png" alt="" /></label>
							</div>
							<div class="input">
								<select name="People" id="people">
									<option value="">Choose One</option>
									<option value="1">1 Person</option>
									<option value="2">2 Person</option>
									<option value="3">3 Person</option>
									<option value="4">4 Person</option>
									<option value="5">5 Person</option>
									<option value="6">6 Person</option>
									<option value="7">7 Person</option>
									<option value="8">8 Person</option>
								</select>
							</div>
						</div>

						<div class="second-row">
							<div class="label">
								<label for="date">DATE</label>
							</div>
							<div class="input">
								<input type="date" name="Date" id="date" />
							</div>
						</div>

						<div class="third-row">
							<div class="label">
								<label for="time">TIME</label>
							</div>
							<div class="input">
								<input type="time" name="Time" id="time" />
							</div>
						</div>

						<div class="fourth-row">
							<div class="label">
								<label for="tableNo">TABLE NO.</label>
							</div>
							<div class="input">
								<select name="TableNo" id="tableNo">
									<option value="">Choose One</option>
									<option value="1">Table 1</option>
									<option value="2">Table 2</option>
									<option value="3">Table 3</option>
									<option value="4">Table 4</option>
									<option value="5">Table 5</option>
									<option value="6">Table 6</option>
									<option value="7">Table 7</option>
									<option value="8">Table 8</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="inputSubmit">
								<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                            	<input type="hidden" name="rsv_name" value="<?php echo $user_name ?>">
                            	<input type="hidden" name="rsv_phonenum" value="<?php echo $user_phonenum ?>">
								<input id="button" type="submit" value="Book Now" />
							</div>
						</div>
					</form>
				</div>
				<!-- <hr class="line3" /> -->
				<!-- <hr class="line4" /> -->
			</div>
			<?php
					$totalPeople ="";
					$date = "";
					$time = "";
					$tableNo ="";
					if(isset($_GET['msg'])){
						echo "<script> document.querySelector('.bg-modal').style.display = 'flex'; </script>";

						$msg = $_GET['msg'];
						$msgArr = explode(",", $msg);
						$totalPeople = $msgArr[0];
						$date = $msgArr[1];
						$time = $msgArr[2];
						$tableNo = $msgArr[3];
					}
			?>
			<div class="bg-modal">
				<div class="modal-content">
					<div class="close">+</div>	
					<div class="design"></div>
					<div class="confirmation">
						<p>Your Reservation is Booked</p>
						<div class="a">
							<!-- <?php
								echo  $totalPeople;
							?> -->
						</div>
						<div class="b">
							<?php
							    $day = date('l' , strtotime($date));
								echo 'Date: ' . $day . ', '  . $date;
							?>
						</div>
						<div class="c">
							<?php
								$newTime = date('H:i A', strtotime($time));
								echo 'Time: ' .  $newTime;
							?>
						</div>
						<div class="d">
							<?php
								echo 'Table #'.$tableNo.' for '.$totalPeople.' Person';
							?>
						</div>
					</div>				
				</div>
			</div>
			<?php
				if(isset($_GET['msg'])){
					echo "<script> document.querySelector('.bg-modal').style.display = 'flex'; </script>";
				}
			?>
		</main>

		<!-- main content section starts here -->
		<div class="main-content">
        <div class="wrapper">
            <h1>Manage Your Reservations</h1>
            <br />
            <br />


            <table class="tbl-full">
                <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>

                <?php
                    //query to get all admin
                    $sql3 = "SELECT * FROM tbl_reservation WHERE reservation_user_id=$user_id";
                    //execute the query
                    $res3 = mysqli_query($conn, $sql3);

                    //check whether the query is executed or not
                    if($res3 == TRUE){
                        //count rows to check whether we have data in database or not
                        $count3 = mysqli_num_rows($res3); //function to get all rows in the database
                        $no3 = 1 ; //create a variable 

                        //check the num of rows
                        if($count3>0){
                            //we have data in database
                            while($rows3 = mysqli_fetch_assoc($res3)){
                                //using while loop to get all the data from database
                                //and while loop will run as long as we have data in database

                                //get individual data
                                $reservation_id = $rows3['reservation_id'];
                                $reservation_date = $rows3['reservation_date'];
                                $reservation_time = $rows3['reservation_time'];

                                //display the values in our table
                                ?>

                                <tr>
                                    <td><?php echo $no3++; ?></td>
                                    <td><?php echo $reservation_date ?></td>
                                    <td><?php echo $reservation_time ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>delete-reservation.php?reservation_id=<?php echo $reservation_id; ?>" class="btn-blue">Delete</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- main content section ends here -->
	</body>
</html>