<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}
	$pageTitle = "Home";
	include '../inc/header.php';
?>

<section>
	<div class="container">
		<?php
			// if not authorised to access a certain page, show message
			if (isset($_SESSION['roleerror'])) {
				echo "<p id='error'>" . $_SESSION['roleerror'] . "</p>";
				unset($_SESSION['roleerror']);
			}
		?>
		<div class="login">
			<h1>Yo, <?php echo $_SESSION['name']; ?>.</h1>
			<p>Here's an example homepage until we've figured everything out.</p>
			<p><ul>
			<?php
				$staffID = $_SESSION['user'];
				$sql = "SELECT staffID, title
						FROM staff
						WHERE staffID = '$staffID'";
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);

				if ($row['title'] == 1) { // Doctor
					echo "<li><a href='doctorsnotes.php'>Doctor's Notes</a></li>";
					echo "<li><a href='patients.php'>Patient Histories</a></li>";
					echo "<li><a href='#.html'>Nurses' Observations</a></li>";
					echo "<li><a href='#.html'>Upcoming Surgeries</a></li>";
					echo "<li><a href='#.html'>Schedules</a></li>";
					echo "<li><a href='#.html'>Perscriptions</a></li>";
				} else if ($row['title'] == 2) { // Nurse
					echo "<li><a href='#.html'>Nurses' Observations</a></li>";
					echo "<li><a href='patients.php'>Patient Histories</a></li>";
					echo "<li><a href='#.html'>Upcoming Surgeries</a></li>";
					echo "<li><a href='#.html'>Perscriptions</a></li>";
				} else if ($row['title'] == 3) { // Medical Technician
					echo "<li><a href='#.html'>X-rays</a></li>";
					echo "<li><a href='#.html'>Test Results</a></li>";
				} else if ($row['title'] == 4) { // Receptionist
					echo "<li><a href='patientadd.php'>Add a Patient</a></li>";
					echo "<li><a href='patients.php'>Update Patient Information</a></li>";
					echo "<li><a href='#.html'>Assign Bed</a></li>";
					echo "<li><a href='#.html'>Schedules</a></li>";
					echo "<li><a href='#.html'>Export to PDF</a></li>";
				} else if ($row['title'] == 5) { // Administrator
					echo "<li><a href='staffadd.php'>Add a Staff Member</a></li>";
					echo "<li><a href='staff.php'>Update Staff Information</a></li>";
					echo "<li><a href='patients.php'>Update Patient Information</a></li>";
					echo "<li><a href='#.html'>Schedules</a></li>";
					echo "<li><a href='#.html'>Search</a></li>";
					echo "<li><a href='#.html'>Delete a Record</a></li>";
					echo "<li><a href='#.html'>Generate Report</a></li>";
				}
			?>
			</ul></p>
		</div>
	</div>
</section>

<?php
	include '../inc/footer.php';
?>