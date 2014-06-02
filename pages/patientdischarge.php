<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Patient Discharge";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2c");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Patient Discharge Page: form with admitted patients, and rest of payments table fields (releaseDate, cost, paymentMethod, rebuff) -->

<div class="leftContent">
	<?php
		// if success or error in patientdischargeprocess, show message
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
			<p>Patient Discharge</p>
		</section>
		<section class="boxContent">
			<!-- Discharge Form -->
			<form action="patientdischargeprocess.php" method="post">
				<div>
					<label for="paymentID">Patient: </label>
					<select name="paymentID">
						<option>Please Select</option>
						<?php
						// sql for getting all admitted patients
						$sql = "SELECT patientID, firstName, lastName, paymentID
								FROM patients LEFT JOIN payments USING (patientID)
								WHERE payments.patientID IS NOT NULL
								AND releaseDate IS NULL
								ORDER BY patientID DESC";
						$result = mysql_query($sql);

						while ($row = mysql_fetch_array($result)) {
							echo "<option value='{$row['paymentID']}'>{$row['patientID']} - {$row['lastName']}, {$row['firstName']}</option>";
						}
						?>
					</select>
				</div>
				<div>
					<label for="releaseDate">Release Date: </label>
					<input class="textInput" type="text" name="releaseDate" value="<?php echo date("Y-m-d"); ?>" required />
				<div>
				<div>
					<label for="cost">Cost: </label>
					<input class="textInput" type="text" name="cost" placeholder="$####.##" required />
				<div>
				<div>
					<label for="paymentMethod">Payment Method: </label>
					<input class="textInput" type="text" name="paymentMethod" placeholder="Cash Payment/MasterCard/etc." required />
				<div>
				<div>
					<label for="rebuff">Rebuff: </label>
					<input class="textInput" type="text" name="rebuff" placeholder="$####.##" required />
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