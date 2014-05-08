<?php
	include '../inc/dbconnect.php';

	// get data from previous form: either patientID, first and last name, or phone number (get all anyway)
	$patientID = mysql_escape_string($_GET['patientID']);
	$firstName = mysql_escape_string($_GET['firstName']);
	$lastName = mysql_escape_string($_GET['lastName']);
	// $phone = mysql_escape_string($_GET['phone']);

	// check to see if any fields are filled, if not return to patientsfinder.php
	// if (($patientID == "") && ($firstName == "") && ($lastName == "") && ($phone == "")) {
	// 	header ("Location: patientsfinder.php");
	// }

	// separate sql queries for each field?
	if ($patientID != "Patient ID") {
		// sql to see if it a) exists b) there is only one
		$sql = "SELECT patientID
				FROM patients
				WHERE patientID = {$_GET['patientID']}";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		// if there is a result (shouldn't be more than one), redirect to that page
		if ($count == 1) {
			$row = mysql_fetch_assoc($result);
			header ("Location: patientview.php?patient={$row['patientID']}"); // temporary link
		} else {
			// redirect to search.php with error
			$_SESSION['searcherror'] = "There were no results for that patient ID.";
			header ("Location: search.php");
		}
	} else if ($firstName != "First Name" && $lastName != "Last Name") {
		$sql = "SELECT patientID, firstName, lastName
				FROM patients
				WHERE firstName LIKE '%{$firstName}%'
				AND lastName LIKE '%{$lastName}%'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		// if there is only one result, redirect to that page
		if ($count == 1) {
			$row = mysql_fetch_assoc($result);
			header ("Location: patientview.php?patient={$row['patientID']}"); // temporary link
		} else {
			// redirect to search.php with error
			$_SESSION['searcherror'] = "There were no results for that name.";
			header ("Location: search.php");
		}
	} else if ($firstName != "First Name") {
		$sql = "SELECT patientID, firstName, lastName
				FROM patients
				WHERE firstName LIKE '%{$firstName}%'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		// if there is only one result, redirect to that page
		if ($count == 1) {
			$row = mysql_fetch_assoc($result);
			header ("Location: patientview.php?patient={$row['patientID']}"); // temporary link
		} else {
			// go to search.php with results (somehow)
			header ("Location: search.php?firstName={$firstName}");
		}
	} else if ($lastName != "Last Name") {
		$sql = "SELECT patientID, firstName, lastName
				FROM patients
				WHERE lastName LIKE '%{$lastName}%'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		// if there is only one result, redirect to that page
		if ($count == 1) {
			$row = mysql_fetch_assoc($result);
			header ("Location: patientview.php?patient={$row['patientID']}"); // temporary link
		} else {
			// go to search.php with results (somehow)
			header ("Location: search.php?lastName={$lastName}");
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