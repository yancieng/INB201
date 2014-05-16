<?php
	include '../inc/dbconnect.php';

	// get data from previous form: firstName, lastName, DOB, bloodType, previousNotes
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$DOB = mysql_escape_string($_POST['DOB']);
	$bloodType = $_POST['bloodType'];
	$previousNotes = mysql_escape_string($_POST['previousNotes']);

	// if optional fields are blank, make them NULL
	if ($previousNotes == '') {
		$previousNotes = NULL;
	}

	// if required fields are blank, redirect to patientadd.php with error
	if (
		(($firstName == '')
		|| ($lastName == '')
		|| ($DOB == '')
		|| ($bloodType == ''))
	) {
		$_SESSION['patienterror'] = 'You need to fill out ALL required fields.';
		header ("Location: patientadd.php");
	} else {
		$sql = "INSERT INTO patients (firstName, lastName, DOB)
				VALUES (
					'{$firstName}',
					'{$lastName}',
					'{$DOB}'
				)";

		if (mysql_query($sql)) {		
			$sql = "SELECT *
					FROM patients
					WHERE firstName = '{$firstName}'
					AND lastName = '{$lastName}'
					AND DOB = '{$DOB}'";
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