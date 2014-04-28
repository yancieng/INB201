<?php
	include '../inc/dbconnect.php';

	// get data from previous form: either patientID, first and last name, or phone number (get all anyway)
	$patientID = mysql_escape_string($_GET['patientID']);
	$name = mysql_escape_string($_GET['name']);
	$phone = mysql_escape_string($_GET['phone']);

	// separate sql queries for each field?
	if ($patientID != "") {
		// sql to see if it a) exists b) there is only one
		$sql = "SELECT patientID
				FROM patients
				WHERE patientID = {$_GET['patientID']}";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		// if there is a result (shouldn't be more than one), redirect to that page
		if ($count == 1) {
			$row = mysql_fetch_assoc($result);
			header ("Location: patientview.php?patient={$patientID}"); // temporary link
		} else {
			// redirect to search.php with error
			$_SESSION['searcherror'] = "There were no results for that patient ID.";
			header ("Location: search.php");
		}
	} else if ($name != "") {
		$sql = "SELECT patientID, firstName, lastName
				FROM patients
				WHERE firstName LIKE '%{$name}%'
				OR lastName LIKE '%{$name}%'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		// if there is only one result, redirect to that page
		if ($count == 1) {
			$row = mysql_fetch_assoc($result);
			header ("Location: patientview.php?patient={$row['patientID']}"); // temporary link
		} else {
			// go to search.php with results (somehow)
			header ("Location: search.php?name={$name}");
		}
	} else if ($phone != "") {
		$sql = "SELECT patientID, contactNumber
				FROM patients
				WHERE contactNumber LIKE '%{$phone}%'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		// if there is only one result, redirect to that page
		if ($count == 1) {
			$row = mysql_fetch_assoc($result);
			header ("Location: patientview.php?patient={$row['patientID']}"); // temporary link
		} else {
			// go to search.php with results (somehow)
			header ("Location: search.php?phone={$phone}");
		}
	}
?>