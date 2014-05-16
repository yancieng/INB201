<?php
	include '../inc/dbconnect.php';

	// get info from form: temperature, bloodPressure, pulse, eyeSightLeft, eyeSightRight, bloodSugar, height, weight, bloodType, patientID
	$temperature = mysql_escape_string($_POST['temperature']);
	$bloodPressure = mysql_escape_string($_POST['bloodPressure']);
	$pulse = mysql_escape_string($_POST['pulse']);
	$eyeSightLeft = mysql_escape_string($_POST['eyeSightLeft']);
	$eyeSightRight = mysql_escape_string($_POST['eyeSightRight']);
	$bloodSugar = mysql_escape_string($_POST['bloodSugar']);
	$height = mysql_escape_string($_POST['height']);
	$weight = mysql_escape_string($_POST['weight']);
	$bloodType = mysql_escape_string($_POST['bloodType']);
	$patientID = $_POST['patientID'];

	// if any fields are blank, make them NULL
	if ($temperature == '') {
		$temperature = NULL;
	}
	if ($bloodPressure == '') {
		$bloodPressure = NULL;
	}
	if ($pulse == '') {
		$pulse = NULL;
	}
	if ($eyeSightLeft == '') {
		$eyeSightLeft = NULL;
	}
	if ($eyeSightRight == '') {
		$eyeSightRight = NULL;
	}
	if ($bloodSugar == '') {
		$bloodSugar = NULL;
	}
	if ($height == '') {
		$height = NULL;
	}
	if ($weight == '') {
		$weight = NULL;
	}
	if ($bloodType == '') {
		$bloodType = NULL;
	}

	// no input checking at the moment

	// insert info into database
	$sql = "INSERT INTO checkups (temperature, bloodPressure, pulse, eyeSightLeft, eyeSightRight, bloodSugar, height, weight, bloodType, patientID)
			VALUES ('{$temperature}', '{$bloodPressure}', '{$pulse}', '{$eyeSightLeft}', '{$eyeSightRight}', '{$bloodSugar}', '{$height}', '{$weight}', '{$bloodType}', {$patientID})";

	if (mysql_query($sql)) {		
			// redirect to the patientupdate.php page with success message
			$_SESSION['patientsuccess'] = "Checkup was processed successfully.";
			header ("Location: patientupdate.php?patient={$patientID}");
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in processing the data.";
			header ("Location: patientupdate.php?patient={$patientID}");
		}
?>