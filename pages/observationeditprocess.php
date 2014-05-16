<?php
	include '../inc/dbconnect.php';

	// get info from form: observationID, observationTitle, observation, patientID
	$observationID = $_POST['observationID'];
	$observationTitle = mysql_escape_string($_POST['observationTitle']);
	$observation = mysql_escape_string($_POST['observation']);
	$patientID = $_POST['patientID'];

	// if required fields are blank, redirect to patientupdate.php with error
	if (
		(($observationTitle == '')
		|| ($observation == ''))
	) {
		$_SESSION['patienterror'] = "All required fields need to be filled.";
		header ("Location: patientupdate.php?patient={$patientID}");
	}
	
	// update info
	$sql = "UPDATE observations
			SET observationTitle = '{$observationTitle}',
				observation = '{$observation}'
			WHERE observationID = {$observationID}";

	if (mysql_query($sql)) {		
			// redirect to the patientupdate.php page with success message
			$_SESSION['patientsuccess'] = "Observation was edited successfully.";
			header ("Location: patientupdate.php?patient={$patientID}");
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in editing the data.";
			header ("Location: patientupdate.php?patient={$patientID}");
		}
?>