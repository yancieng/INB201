<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Admit Existing Patient";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2b");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Admit Existing Patient Page: form with just a dropdown box for existing patients that aren't already admitted? -->

<div class="leftContent">
	<?php
		// if success or error in patientadmitprocess, show message
		if (isset($_SESSION['success'])) {
			echo "<p id='success'>" . $_SESSION['success'] . "</p>";
			unset($_SESSION['success']);
		}
		if (isset($_SESSION['error'])) {
			echo "<p id='error'>" . $_SESSION['error'] . "</p>";
			unset($_SESSION['error']);
		}
	?>
	<div class="box">
		<section class="boxTitle">
			<p>Admit Existing Patient</p>
		</section>
		<section class="boxContent">
			<!-- Patient Form -->
			<form action="patientadmitprocess.php" method="post">
				<div>
					<label for="patientID">Patient: </label>
					<select name="patientID">
						<option>Please Select</option>
						<?php
						// sql for getting all non-currently-admitted patients
						// should show non-admitted, as well as previously released patients, but not previously released that have been readmitted
						$sql = "SELECT patientID, firstName, lastName
								FROM patients LEFT JOIN payments USING (patientID)
								WHERE (payments.patientID IS NULL OR releaseDate IS NOT NULL)
								OR (admissionDate IS NOT NULL AND releaseDate IS NOT NULL)
								ORDER BY patientID DESC";
						$result = mysql_query($sql);

						while ($row = mysql_fetch_array($result)) {
							echo "<option value='{$row['patientID']}'>{$row['patientID']} - {$row['lastName']}, {$row['firstName']}</option>";
						}
						?>
					</select>
				</div>
				<div>
					<label for="admissionDate">Admission Date: </label>
					<input class="textInput" type="text" name="admissionDate" value="<?php echo date("Y-m-d"); ?>" required />
				<div>
					<button type="submit" class="submit">Add Information to Database</button>
				</div>
			</form>
		</section>
	</div>
</div>


<?php
	include '../inc/footer.php';
?> 