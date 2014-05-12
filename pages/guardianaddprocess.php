<?php
	include '../inc/dbconnect.php';

	// get data from form: patientID, firstName, lastName, title, relation, contactNumber, email, address, photo
	$patientID = $_POST['patientID'];
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$title = mysql_escape_string($_POST['title']);
	$relation = mysql_escape_string($_POST['relation']);
	$contactNumber = mysql_escape_string($_POST['contactNumber']);
	$email = mysql_escape_string($_POST['email']);
	$address = mysql_escape_string($_POST['address']);

	// if required fields are blank, redirect to patientupdate.php with error
	if (
		(($firstName == '')
		|| ($lastName == '')
		|| ($title == '')
		|| ($relation == '')
		|| ($contactNumber == '')
		|| ($email == '')
		|| ($address == ''))
	) {
		$_SESSION['patienterror'] = "All required fields need to be filled.";
		header ("Location: patientupdate.php?patient={$patientID}");
	}

	if (isset($_FILES['photo'])) {
		$photo = $_FILES['photo']['name'];

		// etc.

	} else {
		// add information to database
		$sql = "INSERT INTO guardians (firstName, lastName, title, contactNumber, email, address)
				VALUES ('{$firstName}', '{$lastName}', '{$title}', '{$contactNumber}', '{$email}', '{$address}')";

		if (mysql_query($sql)) {
			// use resulting guardianID to add patients_guardians row
			$sql = "SELECT guardianID
					FROM guardians
					WHERE firstName = '{$firstName}'
					AND lastName = '{$lastName}'
					AND email = '{$email}'";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);
			$guardianID = $row['guardianID'];

			$sql = "INSERT INTO patients_guardians (patientID, guardianID, relation)
					VALUES ({$patientID}, {$guardianID}, '{$relation}')";

			if (mysql_query($sql)) {
				// redirect to the patientupdate.php page with success message
				$_SESSION['patientsuccess'] = "Guardian {$lastName}, {$firstName} was updated successfully.";
				header ("Location: patientupdate.php?patient={$patientID}");
			} else {
				// kick back with error message: sql
				$_SESSION['patienterror'] = "There was an error in adding the bridging data.";
				header ("Location: patientupdate.php?patient={$patientID}");
			}
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in adding the data.";
			header ("Location: patientupdate.php?patient={$patientID}");
		}
	}
?>