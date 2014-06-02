<?php
	include '../inc/dbconnect.php';

	// depending on $table..
	$table = mysql_escape_string($_POST['table']);
	$conditionID = mysql_escape_string($_POST['conditionID']);

	if ($table == 'Condition') {
		// get info from form
		$condition = mysql_escape_string($_POST['condition']);
		$conditionDate = mysql_escape_string($_POST['conditionDate']);
		$medication = mysql_escape_string($_POST['medication']);

		// update condition part of table
		$sql = "UPDATE conditions
				SET `condition` = '{$condition}',
					conditionDate = '{$conditionDate}',
					medication = '{$medication}'
				WHERE conditionID = {$conditionID}";

	} else if ($table == 'Allergy') {
		// get info from form
		$allergy = mysql_escape_string($_POST['allergy']);
		$allergyDate = mysql_escape_string($_POST['allergyDate']);
		$allergySeverity = mysql_escape_string($_POST['allergySeverity']);

		// update allergy part of table
		$sql = "UPDATE conditions
				SET allergy = '{$allergy}',
					allergyDate = '{$allergyDate}',
					allergySeverity = '{$allergySeverity}'
				WHERE conditionID = {$conditionID}";
	}
	
	if (mysql_query($sql)) {		
		// redirect to the caedit.php page with success message
		$_SESSION['success'] = "{$table} '{$conditionID}' was edited successfully.";
		header ("Location: caedit.php?table={$table}&ID={$conditionID}");
	} else {
		// kick back with error message: sql
		$_SESSION['error'] = "There was an error in editing the data.";
		header ("Location: caedit.php?table={$table}");
	}
?>