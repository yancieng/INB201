<?php
	include '../inc/dbconnect.php';

	// get info from form: allergy, severity, patientID, add current date
	$allergy = mysql_escape_string($_POST['allergy']);
	$severity = mysql_escape_string($_POST['severity']);
	$patientID = $_POST['patientID'];
	$date = date("Y-m-d");

	// if required fields are blank, redirect to patientupdate.php with error
	if (
		(($allergy == '')
		|| ($severity == ''))
	) {
		$_SESSION['patienterror'] = "All required fields need to be filled.";
		header ("Location: patientupdate.php?patient={$patientID}");
	}
	
	// insert into database
	$sql = "INSERT INTO conditions (allergy, allergyDate, allergySeverity, patientID)
			VALUES ('{$allergy}', '{$date}', '{$severity}', '{$patientID}')";

	if (mysql_query($sql)) {		
			// redirect to the patientupdate.php page with success message
			$_SESSION['patientsuccess'] = "Allergy was added successfully.";
			header ("Location: patientupdate.php?patient={$patientID}");
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in adding the data.";
			header ("Location: patientupdate.php?patient={$patientID}");
		}
?>