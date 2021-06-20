	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<title>Document</title>
			<link rel="stylesheet" href="./style/reservation.css" />
			<script src="reservation.js" defer></script>
			<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js%22%3E"></script>
			<script src="http://ajax.aspnetcdn.com/ajax/mvc/3.0/jquery.validate.unobtrusive.min.js%22%3E"></script>
		</head>
		<body>
			<header></header>
			<?php
				session_start();
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
					<hr class="line1" />
					<hr class="line2" />
					<div class="book-form">
						<h2>Reservation For Member</h2>
						<form name="reservationForm" id="formID" method="get" action = "reserve.php">
							<div class="first-row">
								<div class="label">
									<label for="people"><img src="./asset/people.png" alt="" /></label>
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
									<input id="button" type="submit" value="Book Now" />
								</div>
							</div>
						</form>
					</div>
					<hr class="line3" />
					<hr class="line4" />
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
		</body>
	</html>
