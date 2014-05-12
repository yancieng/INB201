<?php
	include '../inc/dbconnect.php';

	// get data from previous form: patientID, firstName, lastName, DOB, bloodType, previousNotes
	$patientID = $_POST['patientID'];
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$DOB = mysql_escape_string($_POST['DOB']);

	// if required fields are blank, redirect to patientview.php with error
	if (
		(($firstName == '')
		|| ($lastName == ''))
	) {
		$_SESSION['patienterror'] = "ALL required fields need to be filled. Don't just delete data like that.";
		header ("Location: patientupdate.php?patient={$patientID}");
	} else {
		$sql = "UPDATE patients
				SET firstName = '{$firstName}',
					lastName = '{$lastName}',
					DOB = '{$DOB}'
				WHERE patientID = '{$patientID}'";

		if (mysql_query($sql)) {		
			// redirect to the patientupdate.php page with success message
			$_SESSION['patientsuccess'] = "Patient {$lastName}, {$firstName} was updated successfully.";
			header ("Location: patientupdate.php?patient={$patientID}");
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in updating the data.";
			header ("Location: patientupdate.php?patient={$patientID}");
		}
	}
?>