<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Schedule";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m3");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Content goes below -->
<!-- Schedule Page: shows a table of currently scheduled rooms (from now onwards), and has a form for adding a new event -->

<?php
	// if success or error messages are set, display
	if (isset($_SESSION['success'])) {
		echo "<p id='success'>" . $_SESSION['success'] . "</p>";
		unset($_SESSION['success']);
	}
	if (isset($_SESSION['error'])) {
		echo "<p id='error'>" . $_SESSION['error'] . "</p>";
		unset($_SESSION['error']);
	}
?>

<div class="leftContent">
	<div class="box schedule">
		<section class="boxTitle">
			<p>Currently Scheduled Rooms</p>
		</section>
		<section class="boxContent">
			<?php
			// sql to get all schedules, from ones that have not ended yet onwards
			$sql = "SELECT details, room, startTime, endTime, patientID
					FROM schedules
					WHERE endTime > NOW()
					ORDER BY startTime ASC";
			$result = mysql_query($sql);
			$count = mysql_num_rows($result);

			if ($count > 0) {
				// display as table
				echo "
				<table>
					<tr>
						<th>Details</th>
						<th>Room</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Patient ID</th>
					</tr>
				";

				while ($row = mysql_fetch_array($result)) {
					echo "
					<tr>
						<td>{$row['details']}</td>
						<td>{$row['room']}</td>
						<td>{$row['startTime']}</td>
						<td>{$row['endTime']}</td>
						<td>{$row['patientID']}</td>
					</tr>
					";
				}

				echo "
				</table>
				";
			} else {
				echo "<p>No rooms are currently scheduled.</p>";
			}
			?>
		</section>
	</div>

	<div class="box">
		<section class="boxTitle">
			<p>Schedule New Event</p>
		</section>
		<section class="boxContent">
			<form action="scheduleprocess.php" method="post">
				<div>
					<label for="details">Details: </label>
					<input class="textInput" type="text" name="details" required />
				</div>
				<div>
					<label for="room">Room: </label>
					<input class="textInput" type="text" name="room" required />
				</div>
				<div>
					<label for="startTime">Start Time: </label>
					<input class="textInput" type="text" name="startTime" placeholder="YYYY-MM-DD hh:mm:ss" required />
				</div>
				<div>
					<label for="endTime">End Time: </label>
					<input class="textInput" type="text" name="endTime" placeholder="YYYY-MM-DD hh:mm:ss" required />
				</div>
				<div>
					<label for="patientID">Patient ID: </label>
					<select name="patientID">
						<option>Please Select: </option>
						<?php
						// sql to get all registered patients
						$sql = "SELECT patientID, firstName, lastName
								FROM patients";
						$result = mysql_query($sql);

						while ($row = mysql_fetch_array($result)) {
							echo "
							<option value='{$row['patientID']}'>{$row['patientID']} - {$row['lastName']}, {$row['firstName']}</option>
							";
						}
						?>
					</select>
				</div>
				<div>
					<button type="submit" class="submit">Schedule Event</button>
				</div>
			</form>
		</section>
	</div>
</div>

<?php
	include '../inc/footer.php';
?> 