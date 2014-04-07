<?php
	include '../inc/dbconnect.php';

	// get data from previous form: firstName, lastName, address (patientAddress), DOB, contactNumber, emergencyNumber, caregiverNumber, bloodType, previousNotes
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

	// if required fields are blank, redirect to patientadd.php with error
	if (
		(($firstName == '')
		|| ($lastName == '')
		|| ($address == '')
		|| ($DOB == '')
		|| ($contactNumber == '')
		|| ($bloodType == ''))
	) {
		$_SESSION['patienterror'] = 'You need to fill out ALL required fields.';
		header ("Location: patientadd.php");
	} else {
		$sql = "INSERT INTO patients (firstName, lastName, address, DOB, contactNumber, emergencyNumber, caregiverNumber, bloodType, previousNotes)
				VALUES (
					'{$firstName}',
					'{$lastName}',
					'{$address}',
					'{$DOB}',
					'{$contactNumber}',
					'{$emergencyNumber}',
					'{$caregiverNumber}',
					'{$bloodType}',
					'{$previousNotes}'
				)";

		if (mysql_query($sql)) {		
			$sql = "SELECT *
					FROM patients
					WHERE firstName = '{$firstName}'
					AND lastName = '{$lastName}'
					AND contactNumber = '{$contactNumber}'";
			$result = mysql_query($sql);
			$row = mysql_num_rows($result);

			while($row = mysql_fetch_assoc($result)) {
				// redirect to the patientview.php page with success message
				$_SESSION['patientsuccess'] = "Patient {$row['lastName']}, {$row['firstName']} was added successfully.";
				header ("Location: patientview.php?patient={$row['patientID']}");
			}
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in processing the data.";
			header ("Location: patientadd.php");
		}
	}
?>