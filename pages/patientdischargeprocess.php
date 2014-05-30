<?php
	include '../inc/dbconnect.php';

	// get info from form: paymentID, releaseDate, cost, paymentMethod, rebuff
	$paymentID = mysql_escape_string($_POST['paymentID']);
	$releaseDate = mysql_escape_string($_POST['releaseDate']);
	$cost = mysql_escape_string($_POST['cost']);
	$paymentMethod = mysql_escape_string($_POST['paymentMethod']);
	$rebuff = mysql_escape_string($_POST['rebuff']);

	// if required fields are blank (or unselected), redirect to patientadd.php with error
	if ((($paymentID == '')
		|| ($paymentID == 'Please Select')
		|| ($releaseDate == '')
		|| ($cost == '')
		|| ($paymentMethod == '')
		|| ($rebuff == ''))) {
		$_SESSION['error'] = 'You need to fill out ALL required fields.';
		header ("Location: patientdischarge.php");
	} else {
		// sql to update information in database
		$sql = "UPDATE payments
				SET releaseDate = '{$releaseDate}',
					cost = '{$cost}',
					paymentMethod = '{$paymentMethod}',
					rebuff = '{$rebuff}'
				WHERE paymentID = {$paymentID}";

		if (mysql_query($sql)) {
			// get patient's ID
			$sql = "SELECT patientID
					FROM payments
					WHERE paymentID = {$paymentID}";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);

			// redirect to the patientview.php page with success message
			$_SESSION['success'] = "Patient {$row['patientID']} was discharged successfully.";
			header ("Location: patientdischarge.php");
		} else {
			// kick back with error message: sql
			$_SESSION['error'] = "There was an error in discharging the patient.";
			header ("Location: patientdischarge.php");
		}
	}
?>