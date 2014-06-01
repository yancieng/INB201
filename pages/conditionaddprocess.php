<?php
	include '../inc/dbconnect.php';

	// get info from form: condition, medication, patientID, add current date
	$condition = mysql_escape_string($_POST['condition']);
	$medication = mysql_escape_string($_POST['medication']);
	$patientID = $_POST['patientID'];
	$date = date("Y-m-d");

	// if required fields are blank, redirect to patientupdate.php with error
	if (
		(($condition == '')
		|| ($medication == ''))
	) {
		$_SESSION['patienterror'] = "All required fields need to be filled.";
		header ("Location: patientupdate.php?patient={$patientID}");
	}
	
	// insert into database
	$sql = "INSERT INTO conditions (`condition`, conditionDate, medication, patientID)
			VALUES ('{$condition}', '{$date}', '{$medication}', '{$patientID}')";

	if (mysql_query($sql)) {		
		// redirect to the patientupdate.php page with success message
		$_SESSION['patientsuccess'] = "Condition was added successfully.";
		header ("Location: patientupdate.php?patient={$patientID}");
	} else {
		// kick back with error message: sql
		$_SESSION['patienterror'] = "There was an error in adding the data.";
		header ("Location: patientupdate.php?patient={$patientID}");
	}
?>