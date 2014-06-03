<?php
	include '../inc/dbconnect.php';

	// get which process form was used: assign or unassign
	$process = mysql_escape_string($_GET['process']);
	$bedNumber = mysql_escape_string($_POST['bedNumber']);

	// bedNumber check
	if ($bedNumber != '') {
		if ($process == 'assign') {
			// get info from form: bedNumber, patientID
			$patientID = mysql_escape_string($_POST['patientID']);

			// update sql
			$sql = "UPDATE beds
					SET patientID = '{$patientID}'
					WHERE bedNumber = '{$bedNumber}'";
		} else if ($process == 'unassign') {
			// udpate sql
			$sql = "UPDATE beds
					SET patientID = NULL
					WHERE bedNumber = '{$bedNumber}'";
		}

		if (mysql_query($sql)) {		
			// redirect to the bedassign.php page with success message
			$_SESSION['success'] = "Bed {$bedNumber} was {$process}ed succesfully.";
			header ("Location: bedassign.php");
		} else {
			// kick back with error message: sql
			$_SESSION['error'] = "There was an error in updating the data.";
			header ("Location: bedassign.php");
		}
	} else {
		if ($process == 'assign') {
			$_SESSION['error'] = "No beds are available.";
			header ("Location: bedassign.php");
		} else if ($process == 'unassign') {
			$_SESSION['error'] = "No beds are currently booked.";
			header ("Location: bedassign.php");
		}
	}
?>