<?php
	include '../inc/dbconnect.php';

	// get data from previous form: patientID, firstName, lastName, address (patientAddress), DOB, contactNumber, emergencyNumber, caregiverNumber, bloodType, previousNotes
	$patientID = $_POST['patientID'];
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$address = mysql_escape_string($_POST['patientAddress']);
	$DOB = mysql_escape_string($_POST['DOB']);
	$contactNumber = mysql_escape_string($_POST['contactNumber']);
	$emergencyNumber = mysql_escape_string($_POST['emergencyNumber']);
	$caregiverNumber = mysql_escape_string($_POST['caregiverNumber']);
	$bloodType = mysql_escape_string($_POST['bloodType']);
	$previousNotes = mysql_escape_string($_POST['previousNotes']);

	// if optional fields are blank, make them NULL
	if ($emergencyNumber == '') {
		$emergencyNumber = NULL;
	}
	if ($caregiverNumber == '') {
		$caregiverNumber = NULL;
	}
	if ($previousNotes == '') {
		$previousNotes = NULL;
	}

	// if required fields are blank, redirect to patientview.php with error
	if (
		(($firstName == '')
		|| ($lastName == '')
		|| ($address == '')
		|| ($DOB == '')
		|| ($contactNumber == '')
		|| ($bloodType == ''))
	) {
		$_SESSION['patienterror'] = "ALL required fields need to be filled. Don't just delete data like that.";
		header ("Location: patientview.php?patient={$patientID}");
	} else {
		$sql = "UPDATE patients
				SET firstName = '{$firstName}',
					lastName = '{$lastName}',
					address = '{$address}',
					DOB = '{$DOB}',
					contactNumber = '{$contactNumber}',
					emergencyNumber = '{$emergencyNumber}',
					caregiverNumber = '{$caregiverNumber}',
					bloodType = '{$bloodType}',
					previousNotes = '{$previousNotes}'
				WHERE patientID = '{$patientID}'";

		if (mysql_query($sql)) {		
			// redirect to the patientview.php page with success message
			$_SESSION['patientsuccess'] = "Patient {$lastName}, {$firstName} was updated successfully.";
			header ("Location: patientview.php?patient={$patientID}");
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in updating the data.";
			header ("Location: patientview.php?patient={$patientID}");
		}
	}
?>