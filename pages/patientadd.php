<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Add a Patient";
	include '../inc/panel.php';
?>

<section>
	<div class="container">
		<?php
			// if error in patientaddprocess, show message
			if (isset($_SESSION['patienterror'])) {
				echo "<p id='error'>" . $_SESSION['patienterror'] . "</p>";
				unset($_SESSION['patienterror']);
			}
		?>
		<div class="login">
			<!-- Patient Form -->
			<h1>Add a Patient</h1>
			<p>Fields marked with a * are required.</p>
			<div id="patient">
				<form action="patientaddprocess.php" method="post">
					<div>
						<label for="firstName">*First Name: </label>
						<input type="text" name="firstName" id="firstName" required />
					</div>
					<div>
						<label for="lastName">*Last Name: </label>
						<input type="text" name="lastName" id="lastName" required />
					</div>
					<div>
						<label for="patientAddress">*Address: </label>
						<input type="text" name="patientAddress" id="patientAddress" required />
					</div>
					<div>
						<label for="DOB">*DOB: </label>
						<input type="text" name="DOB" id="DOB" placeholder="YYYY-MM-DD" required />
					</div>
					<div>
						<label for="contactNumber">*Contact Number: </label>
						<input type="text" name="contactNumber" id="contactNumber" required />
					</div>
					<div>
						<label for="emergencyNumber">Emergency Number: </label>
						<input type="text" name="emergencyNumber" id="emergencyNumber" />
					</div>
					<div>
						<label for="caregiverNumber">Caregiver Number: </label>
						<input type="text" name="caregiverNumber" id="caregiverNumber" />
					</div>
					<div>
						<label for="bloodType">*Blood Type: </label>
						<input type="text" name="bloodType" id="bloodType" required />
					</div>
					<div>
						<label for="previousNotes">Previous Notes: </label>
						<textarea name="previousNotes" id="previousNotes" cols="32" rows="5" placeholder="Any previous notes from other hospitals or doctors go here."></textarea>
					</div>
					<div>
						<button type="submit" class="submit">Add Information to Database</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

 