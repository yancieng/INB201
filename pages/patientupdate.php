<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	// GET patient
	$patient = mysql_escape_string($_GET['patient']);

	$pageTitle = "Updating Patient {$patient}";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='patientsfinder.php'>Patients Finder</a> > <a href='patientview.php?patient={$patient}'>Patient {$patient}</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<?php
	// if patient has just been added, show message
	if (isset($_SESSION['patientsuccess'])) {
		echo "<p id='success'>" . $_SESSION['patientsuccess'] . "</p>";
		unset($_SESSION['patientsuccess']);
	}
	// if editing fails, show message
	if (isset($_SESSION['patienterror'])) {
		echo "<p id='error'>" . $_SESSION['patienterror'] . "</p>";
		unset($_SESSION['patienterror']);
	}
?>

<!-- Page used to update patient info, showing only what each role can edit
	Doctor: checkup update and conditions / allergies
	Nurse: edit, add new observation
	Receptionist: edit patient info, edit / add / assign guardian to patient
	Admin: ??
-->

<div class = "leftContent">
<?php
	// check for user's role
	switch ($_SESSION['title']) {
		case 1: // Doctor

			// Update Checkup
			echo "
			<div class='box'>
				<section class='boxTitle'>
					<p>Patient {$patient} Checkup</p>
				</section>
				<section class='boxContent'>
					<form action='checkupprocess.php' method='post'>
						<div>
							<label for='temperature'>Temperature: </label>
							<input type='text' class='textInput' name='temperature' />°C
						</div>
						<div>
							<label for='bloodPressure'>Blood Pressure: </label>
							<input type='text' class='textInput' name='bloodPressure' />
						</div>
						<div>
							<label for='pulse'>Pulse: </label>
							<input type='text' class='textInput' name='pulse' />
						</div>
						<div>
							<label for='eyeSightLeft'>Eye Sight, Left: </label>
							<input type='text' class='textInput' name='eyeSightLeft' />
						</div>
						<div>
							<label for='eyeSightRight'>Eye Sight, Right: </label>
							<input type='text' class='textInput' name='eyeSightRight' />
						</div>
						<div>
							<label for='bloodSugar'>Blood Sugar: </label>
							<input type='text' class='textInput' name='bloodSugar' />
						</div>
						<div>
							<label for='height'>Height: </label>
							<input type='text' class='textInput' name='height' />
						</div>
						<div>
							<label for='weight'>Weight: </label>
							<input type='text' class='textInput' name='weight' />
						</div>
						<div>
							<label for='bloodType'>Blood Type: </label>
							<select name='bloodType'>
								<option>Select:</option>
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
							<input type='hidden' name='patientID' value='{$patient}' />
							<button type='submit' class='submit'>Update Information</button>
						</div>
					</form>
				</section>
			</div>
			";

			// Add / edit(?) conditions
			echo "
			<div class='box'>
				<section class='boxTitle'>
			</div>
			";

			// Add / edit(?) allergies
			echo "

			";
			break;
		case 2: // Nurse

			// Add new observation
			echo "

			";
			break;
		case 3: // Medical Technician

			// Upload X-ray
			echo "

			";
			break;
		case 4: // Receptionist

			// Patient Info
			echo "
			<div class='box'>
				<section class='boxTitle'>
					<p>Patient {$patient}</p>
				</section>
				<section class='boxContent'>
			";
				$sql = "SELECT *
						FROM patients
						WHERE patientID = {$patient}";
				$result = mysql_query($sql);
				$row = mysql_num_rows($result);

				while ($row = mysql_fetch_assoc($result)) {
					echo "
					<div id='patient'>
						<form action='patientupdateprocess.php' method='post'>
							<div>
								<label for='firstName'>First Name: </label>
								<input type='text' class='textInput' name='firstName' value='{$row['firstName']}' required />
							</div>
							<div>
								<label for='lastName'>Last Name: </label>
								<input type='text' class='textInput' name='lastName' value='{$row['lastName']}' required />
							</div>
							<div>
								<label for='DOB'>DOB: </label>
								<input type='text' class='textInput' name='DOB' value='{$row['DOB']}' required />
							</div>
							<div>
								<input type='hidden' name='patientID' value='{$row['patientID']}' />
								<button type='submit' class='submit'>Update Information</button>
							</div>
						</form>
					</div>";
				}
			echo "
				</section>
			</div>
			";

			// Guardian Info
			echo " 
			<div class='box'>
				<section class='boxTitle'>
					<p>Guardian Info</p>
				</section>
				<section class='boxContent'>
			";
					
				// sql for getting guardian info. if none found, have a form for using existing / adding a new one?
				$sql = "SELECT *
						FROM guardians INNER JOIN patients_guardians USING (guardianID)
						WHERE patientID = {$patient}";
				$result = mysql_query($sql);
				$count = mysql_num_rows($result);

				if ($count > 0) {
					// display info as form
					$row = mysql_fetch_assoc($result);

					echo "
					<form action='guardianupdateprocess.php' method='post'>
						<div>
							<label for='firstName'>First Name: </label>
							<input type='text' class='textInput' name='firstName' value='{$row['firstName']}' required />
						</div>
						<div>
							<label for='lastName'>Last Name: </label>
							<input type='text' class='textInput' name='lastName' value='{$row['lastName']}' required />
						</div>
						<div>
							<label for='title'>Title: </label>
							<select name='title'>
								<option>{$row['title']}</option>
								<option>Mr.</option>
								<option>Mrs.</option>
								<option>Miss</option>
								<option>Ms.</option>
							</select>
						</div>
						<div>
							<label for='relation'>Relation: </label>
							<input type='text' class='textInput' name='relation' value='{$row['relation']}' required />
						</div>
						<div>
							<label for='contactNumber'>Contact Number: </label>
							<input type='text' class='textInput' name='contactNumber' value='{$row['contactNumber']}' required />
						</div>
						<div>
							<label for='email'>Email: </label>
							<input type='text' class='textInput' name='email' value='{$row['email']}' required />
						</div>
						<div>
							<label for='address'>Address: </label>
							<input type='text' class='textInput' name='address' value='{$row['address']}' required />
						</div>
						<div>
							<label for='photo'>Photo: </label>
							<input type='file' name='photo' accept='image/*' />
						</div>
						<div>
							<input type='hidden' name='guardianID' value='{$row['guardianID']}' />
							<input type='hidden' name='patientID' value='{$patient}' />
							<button type='submit' class='submit'>Update Information</button>
						</div>
					</form>
					";
				} else {
					// Ask if they want to "Use Existing"
					$sql = "SELECT guardianID, firstName, lastName
							FROM guardians
							ORDER BY guardianID DESC";
					$result = mysql_query($sql);

					echo "
					<form action='guardianaddprocess.php' method='post'>
						<h2>Use existing</h2>
						<div>
							<label for='existing'>Guardian: </label>
							<select name='existing'>
								<option>Select</option>";
							while ($row = mysql_fetch_array($result)) {
								echo "<option value='{$row['guardianID']}'>{$row['guardianID']} - {$row['lastName']}, {$row['firstName']}</option>";
							}
							echo "</select>
						</div>
						<div>
							<label for='existingRelation'>Relation: </label>
							<input type='text' class='textInput' name='existingRelation' />
						</div>
					";

					// Or, display blank form to add a guardian
					echo "
						<h2>OR, add a new guardian</h2>
						<div>
							<label for='firstName'>First Name: </label>
							<input type='text' class='textInput' name='firstName' />
						</div>
						<div>
							<label for='lastName'>Last Name: </label>
							<input type='text' class='textInput' name='lastName' />
						</div>
						<div>
							<label for='title'>Title: </label>
							<select name='title'>
								<option>Mr.</option>
								<option>Mrs.</option>
								<option>Miss</option>
								<option>Ms.</option>
							</select>
						</div>
						<div>
							<label for='relation'>Relation: </label>
							<input type='text' class='textInput' name='relation' />
						</div>
						<div>
							<label for='contactNumber'>Contact Number: </label>
							<input type='text' class='textInput' name='contactNumber' />
						</div>
						<div>
							<label for='email'>Email: </label>
							<input type='text' class='textInput' name='email' />
						</div>
						<div>
							<label for='address'>Address: </label>
							<input type='text' class='textInput' name='address' />
						</div>
						<div>
							<label for='photo'>Photo: </label>
							<input type='file' name='photo' accept='image/*' />
						</div>
						<div>
							<input type='hidden' name='patientID' value='{$patient}' />
							<button type='submit' class='submit'>Add Guardian</button>
						</div>
					</form>
					";
				}
			echo "
				</section>
			</div>
			";
			break;
		default: // Admin
			echo "

			";
			break;
	}
?>


</div><!-- leftContent -->

<?php
	include '../inc/footer.php';
?>