<?php
	include '../inc/dbconnect.php';

	// get info from form: observationTitle, observation, patientID, staffID
	$observationTitle = mysql_escape_string($_POST['observationTitle']);
	$observation = mysql_escape_string($_POST['observation']);
	$patientID = $_POST['patientID'];
	$staffID = $_POST['staffID'];

	// if required fields are blank, redirect to patientupdate.php with error
	if (
		(($observationTitle == '')
		|| ($observation == ''))
	) {
		$_SESSION['patienterror'] = "All required fields need to be filled.";
		header ("Location: patientupdate.php?patient={$patientID}");
	}
	
	// insert into database
	$sql = "INSERT INTO observations (observationTitle, observation, patientID, staffID)
			VALUES ('{$observationTitle}', '{$observation}', '{$patientID}', '{$staffID}')";

	if (mysql_query($sql)) {		
			// redirect to the patientupdate.php page with success message
			$_SESSION['patientsuccess'] = "Observation was added successfully.";
			header ("Location: patientupdate.php?patient={$patientID}");
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in adding the data.";
			header ("Location: patientupdate.php?patient={$patientID}");
		}
?>