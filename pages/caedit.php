<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	// get whether this is a condition or allergy update
	$table = mysql_escape_string($_GET['table']);
	// GET patient, via conditionID
	$conditionID = mysql_escape_string($_GET['ID']);
	$sql = "SELECT patientID
			FROM conditions
			WHERE conditionID = {$conditionID}";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$patient = $row['patientID'];

	$pageTitle = "{$table} Update";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='patientsfinder.php'>Patients Finder</a> > <a href='patientview.php?patient={$patient}'>Patient {$patient}</a> > <a href=patientupdate.php?patient={$patient}>Updating Patient {$patient}</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Content goes below -->
<!-- Condition Update Page: just a form like what admins can do with recordedit.php -->
<div class="leftContent">
	<?php
		// success and error messages go here
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
			<p><?php echo $table; ?> Update</p>
		</section>
		<section class="boxContent">
			<form action="caeditprocess.php" method="post">
				<?php
				// sql to get relevant condition/allergy details, depending on $table
				if ($table == 'Condition') {
					$sql = "SELECT `condition`, conditionDate, medication
							FROM conditions
							WHERE conditionID = {$conditionID}";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);

					echo "
					<div>
						<label for='condition'>Condition: </label>
						<input class='textInput' type='text' name='condition' value='{$row['condition']}' required />
					</div>
					<div>
						<label for='conditionDate'>Date: </label>
						<input class='textInput' type='text' name='conditionDate' value='{$row['conditionDate']}' required />
					</div>
					<div>
						<label for='medication'>Medication: </label>
						<input class='textInput' type='text' name='medication' value='{$row['medication']}' required />
					</div>
					";
				} else if ($table == 'Allergy') {
					$sql = "SELECT allergy, allergyDate, allergySeverity
							FROM conditions
							WHERE conditionID = {$conditionID}";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);

					echo "
					<div>
						<label for='allergy'>Allergy: </label>
						<input class='textInput' type='text' name='allergy' value='{$row['allergy']}' required />
					</div>
					<div>
						<label for='allergyDate'>Date: </label>
						<input class='textInput' type='text' name='allergyDate' value='{$row['allergyDate']}' required />
					</div>
					<div>
						<label for='allergySeverity'>Severity: </label>
						<input class='textInput' type='text' name='allergySeverity' value='{$row['allergySeverity']}' required />
					</div>
					";
				}
				?>
				<div>
					<input type="hidden" name="table" value="<?php echo $table; ?>" />
					<input type="hidden" name="conditionID" value="<?php echo $conditionID; ?>" />
					<button type="submit" class="submit">Update <?php echo $table; ?></button>
				</div>
			</form>
		</section>
	</div>
</div>



<?php
	include '../inc/footer.php';
?> 