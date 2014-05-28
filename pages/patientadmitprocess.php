<?php
	include '../inc/dbconnect.php';

	// get info from form: patientID, admissionDate
	$patientID = mysql_escape_string($_POST['patientID']);
	$admissionDate = mysql_escape_string($_POST['admissionDate']);

	// if required fields are blank (or unselected), redirect to patientadd.php with error
	if ((($patientID == '')	|| ($patientID == 'Please Select') || ($admissionDate == ''))) {
		$_SESSION['error'] = 'You need to fill out ALL required fields.';
		header ("Location: patientadmit.php");
	} else {
		// sql to insert admission date into payments
		$sql = "INSERT INTO payments (patientID, admissionDate)
				VALUES ({$patientID}, '{$admissionDate}')";

		if (mysql_query($sql)) {
			// redirect to the patientview.php page with success message
			$_SESSION['success'] = "Patient {$patientID} was admitted successfully.";
			header ("Location: patientadmit.php");
		} else {
			// kick back with error message: sql
			$_SESSION['error'] = "There was an error in admitting the patient.";
			header ("Location: patientadmit.php");
		}

	}
?>