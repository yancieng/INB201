<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Bed/Room Assign";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m1");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Content goes below -->
<!-- Bed/Room Assign: this page is used to assign/unassign patient's room or bed number
	Page requires:
		Two forms:
			One to assign unassigned beds to existing patients
			One to unassign beds that patients don't need anymore

	Also consider adding this functionality to the patientupdate.php page for receptionists
-->

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
	<!-- Assign to patient -->
	<div class="box">
		<section class="boxTitle">
			<p>Assign Bed/Room to Unassigned Patient</p>
		</section>
		<section class="boxContent">
			<form action="bedassignprocess.php?process=assign" method="post">
				<div>
					<label for="bedNumber">Bed/Room Number: </label>
					<select name="bedNumber">
						<?php
						// sql for getting currently unassigned beds
						$sql = "SELECT bedNumber
								FROM beds
								WHERE patientID IS NULL
								OR patientID = ''";
						$result = mysql_query($sql);

						while ($row = mysql_fetch_array($result)) {
							echo "<option>{$row['bedNumber']}</option>";
						}
						?>
					</select>
				</div>
				<div>
					<label for="patientID">Patient ID: </label>
					<select name="patientID">
						<?php
						// sql for getting currently unassigned patients
						$sql = "SELECT patients.patientID
								FROM beds RIGHT JOIN patients USING (patientID)
								WHERE beds.patientID IS NULL
								OR beds.patientID = ''
								ORDER BY patientID DESC";
						$result = mysql_query($sql);

						while ($row = mysql_fetch_array($result)) {
							echo "<option>{$row['patientID']}</option>";
						}
						?>
					</select>
				</div>
				<div>
					<button type="submit" class="submit">Assign Bed/Room</button>
				</div>
			</form>
		</section>
	</div>

	<!-- Unassign bed -->
	<div class="box">
		<section class="boxTitle">
			<p>Unassign Bed/Room</p>
		</section>
		<section class="boxContent">
			<form action="bedassignprocess.php?process=unassign" method="post">
				<div>
					<label for="bedNumber">Bed/Room Number: </label>
					<select name="bedNumber">
						<?php
						// sql for getting current assigned beds, with current patientID
						$sql = "SELECT bedNumber, patientID
								FROM beds
								WHERE patientID IS NOT NULL
								ORDER BY bedNumber ASC";
						$result = mysql_query($sql);

						while ($row = mysql_fetch_array($result)) {
							echo "<option value='{$row['bedNumber']}'>{$row['bedNumber']} - {$row['patientID']}</option>";
						}
						?>
					</select>
				</div>
				<div>
					<button type="submit" class="submit">Unassign Bed/Room</button>
				</div>
			</form>
		</section>
	</div>

</div>


<?php
	include '../inc/footer.php';
?> 