<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';
	
	$pageTitle = "Home";
	$breadcrumb = $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m1");</script>

<section>
	<div class="container">
		<?php
			// if not authorised to access a certain page, show message
			if (isset($_SESSION['roleerror'])) {
				echo "<p id='error'>" . $_SESSION['roleerror'] . "</p>";
				unset($_SESSION['roleerror']);
			}
		?>
		<?php
			$staffID = $_SESSION['user'];
			$sql = "SELECT *
					FROM staff
					WHERE staffID = '$staffID'";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);

			echo "<h1>Hello, {$row['firstName']}.</h1>";
			echo "<p>Here's an example homepage until we've figured everything out.</p>";
			echo "<ul id='dashboard'>";

			if ($row['title'] == 1) { // Doctor
				echo "<li><a href='notes.php'>Doctor's Notes</a></li>";
				echo "<li><a href='patientsfinder.php'>Patient Histories</a></li>";
				echo "<li><a href='schedule.php'>Schedules</a></li>";
			} else if ($row['title'] == 2) { // Nurse
				echo "<li><a href='patientsfinder.php'>Patient Histories</a></li>";
				echo "<li><a href='schedules.php'>Schedules</a></li>";
			} else if ($row['title'] == 3) { // Medical Technician
				echo "<li><a href='#.html'>X-rays</a></li>";
				echo "<li><a href='#.html'>Test Results</a></li>";
			} else if ($row['title'] == 4) { // Receptionist
				echo "<li><a href='patientadd.php'>Admit New Patient</a></li>";
				echo "<li><a href='patientadmit.php'>Admit Existing Patient</a></li>";
				echo "<li><a href='patientdischarge.php'>Discharge Patient</a></li>";
				echo "<li><a href='patients.php'>Update Patient Information</a></li>";
				echo "<li><a href='bedassign.php'>Assign Bed</a></li>";
				echo "<li><a href='schedule.php'>Schedules</a></li>";
			} else if ($row['title'] == 5) { // Administrator
				echo "<li><a href='staffmanager.php'>Find a Staff Member</a></li>";
				echo "<li><a href='staffadd.php'>Add a Staff Member</a></li>";
				echo "<li><a href='staff.php'>Update Staff Information</a></li>";
				echo "<li><a href='patients.php'>Update Patient Information</a></li>";
				echo "<li><a href='schedule.php'>Schedules</a></li>";
				echo "<li><a href='patientfinder.php'>Search</a></li>";
				echo "<li><a href='recordsmenu.html'>Edit/Delete a Record</a></li>";
			}

			echo "</ul>";
		?>
	</div>
</section>

</div>
</body>
</html>