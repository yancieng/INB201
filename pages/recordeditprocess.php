<?php
	include '../inc/dbconnect.php';
	// if user is not admin, redirect to home page
	include '../inc/adminCheck.php';

	// get the table name
	$table = mysql_escape_string($_GET['table']);

	// switch for what table to update
	switch ($table) {
		case "beds":
			// get the info from previous form: bedNumber, patientID
			$bedNumber = mysql_escape_string($_POST['bedNumber']);
			$patientID = mysql_escape_string($_POST['patientID']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE beds
					SET bedNumber = '$bedNumber',
						patientID = $patientID
					WHERE bedNumber = '$bedNumber'";
			
			// ID for success message
			$ID = $bedNumber;
			break;

		case "checkups":
			// get the info from previous form: checkupID, temperature, bloodPressure, pulse, eyeSightLeft, eyeSightRight, bloodSugar, height, weight, bloodType, timestamp, patientID
			$checkupID = mysql_escape_string($_POST['checkupID']);
			$temperature = mysql_escape_string($_POST['temperature']);
			$bloodPressure = mysql_escape_string($_POST['bloodPressure']);
			$pulse = mysql_escape_string($_POST['pulse']);
			$eyeSightLeft = mysql_escape_string($_POST['eyeSightLeft']);
			$eyeSightRight = mysql_escape_string($_POST['eyeSightRight']);
			$bloodSugar = mysql_escape_string($_POST['bloodSugar']);
			$height = mysql_escape_string($_POST['height']);
			$weight = mysql_escape_string($_POST['weight']);
			$bloodType = mysql_escape_string($_POST['bloodType']);
			$timestamp = mysql_escape_string($_POST['timestamp']);
			$patientID = mysql_escape_string($_POST['patientID']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE checkups
					SET checkupID = $checkupID,
						temperature = '$temperature',
						bloodPressure = '$bloodPressure',
						pulse = '$pulse',
						eyeSightLeft = '$eyeSightLeft',
						eyeSightRight = '$eyeSightRight',
						bloodSugar = '$bloodSugar',
						height = '$height',
						weight = '$weight',
						bloodType = '$bloodType',
						timestamp = $timestamp,
						patientID = $patientID
					WHERE checkupID = $checkupID";
			
			// ID for success message
			$ID = $checkupID;
			break;

		case "conditions":
			// get the info from previous form: conditionID, `condition`, conditionDate, medication, allergy, allergyDate, allergySeverity, timestamp, patientID
			$conditionID = mysql_escape_string($_POST['conditionID']);
			$condition = mysql_escape_string($_POST['condition']);
			$conditionDate = mysql_escape_string($_POST['conditionDate']);
			$medication = mysql_escape_string($_POST['medication']);
			$allergy = mysql_escape_string($_POST['allergy']);
			$allergyDate = mysql_escape_string($_POST['allergyDate']);
			$allergySeverity = mysql_escape_string($_POST['allergySeverity']);
			$timestamp = mysql_escape_string($_POST['timestamp']);
			$patientID = mysql_escape_string($_POST['patientID']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE conditions
					SET conditionID = $conditionID,
						`condition` = '$condition',
						conditionDate = '$conditionDate',
						medication = '$medication',
						allergy = '$allergy',
						allergyDate = '$allergyDate',
						allergySeverity = '$allergySeverity',
						timestamp = '$timestamp',
						patientID = $patientID
					WHERE conditionID = $conditionID";
			
			// ID for success message
			$ID = $conditionID;
			break;

		case "guardians":
			// get the info from previous form: guardianID, firstName, lastName, title, contactNumber, email, address, photo
			$guardianID = mysql_escape_string($_POST['guardianID']);
			$firstName = mysql_escape_string($_POST['firstName']);
			$lastName = mysql_escape_string($_POST['lastName']);
			$title = mysql_escape_string($_POST['title']);
			$contactNumber = mysql_escape_string($_POST['contactNumber']);
			$email = mysql_escape_string($_POST['email']);
			$address = mysql_escape_string($_POST['address']);
			$photo = mysql_escape_string($_POST['photo']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE guardians
					SET guardianID = $guardianID,
						firstName = '$firstName',
						lastName = '$lastName',
						title = '$title',
						contactNumber = '$contactNumber',
						email = '$email',
						address = '$address',
						photo = '$photo'
					WHERE guardianID = $guardianID";
			
			// ID for success message
			$ID = $guardianID;
			break;

		case "notes":
			// get the info from previous form: noteID, datetimeWritten, note, image, staffID
			$noteID = mysql_escape_string($_POST['noteID']);
			$datetimeWritten = mysql_escape_string($_POST['datetimeWritten']);
			$note = mysql_escape_string($_POST['note']);
			$image = mysql_escape_string($_POST['image']);
			$staffID = mysql_escape_string($_POST['staffID']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE notes
					SET noteID = $noteID,
						datetimeWritten = '$datetimeWritten',
						note = '$note',
						image = '$image',
						staffID = $staffID
					WHERE noteID = $noteID";
			
			// ID for success message
			$ID = $noteID;
			break;

		case "observations":
			// get the info from previous form: observationID, timestamp, observationTitle, observation, patientID, staffID
			$observationID = mysql_escape_string($_POST['observationID']);
			$timestamp = mysql_escape_string($_POST['timestamp']);
			$observationTitle = mysql_escape_string($_POST['observationTitle']);
			$observation = mysql_escape_string($_POST['observation']);
			$patientID = mysql_escape_string($_POST['patientID']);
			$staffID = mysql_escape_string($_POST['staffID']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE observations
					SET observationID = $observationID,
						timestamp = '$timestamp',
						observationTitle = '$observationTitle',
						observation = '$observation',
						patientID = $patientID,
						staffID = $staffID
					WHERE observationID = $observationID";
			
			// ID for success message
			$ID = $observationID;
			break;
		
		case "patients":
			// get the info from previous form: patientID, firstName, lastName, DOB, photo
			$patientID = mysql_escape_string($_POST['patientID']);
			$firstName = mysql_escape_string($_POST['firstName']);
			$lastName = mysql_escape_string($_POST['lastName']);
			$DOB = mysql_escape_string($_POST['DOB']);
			$photo = mysql_escape_string($_POST['photo']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE patients
					SET patientID = $patientID,
						firstName = '$firstName',
						lastName = '$lastName',
						DOB = '$DOB',
						photo = '$photo'
					WHERE patientID = $patientID";
			
			// ID for success message
			$ID = $patientID;
			break;

		case "patients_guardians":
			// get the info from previous form: patientID, guardianID, relation
			$patientID = mysql_escape_string($_POST['patientID']);
			$guardianID = mysql_escape_string($_POST['guardianID']);
			$relation = mysql_escape_string($_POST['relation']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE patients_guardians
					SET patientID = $patientID,
						guardianID = $guardianID,
						relation = '$relation'
					WHERE patientID = $patientID
					AND guardianID = $guardianID";
			
			// ID for success message
			$ID = $patientID . ' and ' . $guardianID;
			break;

		case "payments":
			// get the info from previous form: paymentID, admissionDate, releaseDate, cost, paymentMethod, rebuff, patientID
			$paymentID = mysql_escape_string($_POST['paymentID']);
			$admissionDate = mysql_escape_string($_POST['admissionDate']);
			$releaseDate = mysql_escape_string($_POST['releaseDate']);
			$cost = mysql_escape_string($_POST['cost']);
			$paymentMethod = mysql_escape_string($_POST['paymentMethod']);
			$rebuff = mysql_escape_string($_POST['rebuff']);
			$patientID = mysql_escape_string($_POST['patientID']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE payments
					SET paymentID = $paymentID,
						admissionDate = '$admissionDate',
						releaseDate = '$releaseDate',
						cost = '$cost',
						paymentMethod = '$paymentMethod',
						rebuff = '$rebuff',
						patientID = $patientID
					WHERE paymentID = $paymentID";
			
			// ID for success message
			$ID = $paymentID;
			break;

		case "schedules":
			// get the info from previous form: scheduleID, scheduledFor, scheduledTime, patientID
			$scheduleID = mysql_escape_string($_POST['scheduleID']);
			$scheduledFor = mysql_escape_string($_POST['scheduledFor']);
			$scheduledTime = mysql_escape_string($_POST['scheduledTime']);
			$patientID = mysql_escape_string($_POST['patientID']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE schedules
					SET scheduleID = $scheduleID,
						scheduledFor = '$scheduledFor',
						scheduledTime = '$scheduledTime',
						patientID = $patientID
					WHERE scheduleID = $scheduleID";
			
			// ID for success message
			$ID = $scheduleID;
			break;

		case "staff":
			// get the info from previous form: staffID, firstName, lastName, titles.title, password, specialties, photo
			$staffID = mysql_escape_string($_POST['staffID']);
			$firstName = mysql_escape_string($_POST['firstName']);
			$lastName = mysql_escape_string($_POST['lastName']);
			$title = mysql_escape_string($_POST['title']);
			$password = mysql_escape_string($_POST['password']);
			$specialties = mysql_escape_string($_POST['specialties']);
			$photo = mysql_escape_string($_POST['photo']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE staff
					SET staffID = $staffID,
						firstName = '$firstName',
						lastName = '$lastName',
						title = '$title',
						password = '$password',
						specialties = '$specialties',
						photo = '$photo'
					WHERE staffID = $staffID";
			
			// ID for success message
			$ID = $staffID;
			break;

		case "titles":
			// get the info from previous form: titleID, title
			$titleID = mysql_escape_string($_POST['titleID']);
			$title = mysql_escape_string($_POST['title']);
			
			// needs a required field check

			// needs a set blank fields to NULL

			// update sql
			$sql = "UPDATE titles
					SET titleID = $titleID,
						title = '$title'
					WHERE titleID = $titleID";
			
			// ID for success message
			$ID = $titleID;
			break;
			
		default:
			// redirect to records menu (should never reach this line)
			header ("Location: recordsmenu.php");
			break;
	}

	if (mysql_query($sql)) {		
		// redirect to the records.php page with success message
		$_SESSION['success'] = "Record '{$ID}' from table '{$table}' was edited successfully.";
		header ("Location: records.php?table={$table}");
	} else {
		// kick back with error message: sql
		$_SESSION['error'] = "There was an error in editing the data.";
		header ("Location: records.php?table={$table}");
	}
?>