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
						<label for="DOB">*DOB: </label>
						<input type="text" name="DOB" id="DOB" placeholder="YYYY-MM-DD" required />
					</div>
					<div>
						<label for="bloodType">*Blood Type: </label>
						<select name="bloodType">
							<option>O+</option>
							<option>O-</option>
							<option>A+</option>
							<option>A-</option>
							<option>B+</option>
							<option>B-</option>
							<option>AB+</option>
							<option>AB-</option>
						</select>
					</div>
					<div>
						<label for="previousNotes">Previous Notes: </label>
						<textarea name="previousNotes" id="previousNotes" cols="32" rows="5" placeholder="Any previous notes from other hospitals or doctors go here."></textarea>
					</div>

					<!-- needs to be an area for guardian information or "use guardian already in database" or w/e -->
					<!-- Would have
						Radio buttons: use existing OR new
						if existing, choose from drop down? then load info as a form
						else
							First Name:
							Last Name: 
							Title: (select)
							Relation: 
							Contact Number: 
							E-mail: 
							Address: 
					-->
					<!-- Maybe as its own page? Have a link to add from patient finder? -->

					<div>
						<button type="submit" class="submit">Add Information to Database</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

 