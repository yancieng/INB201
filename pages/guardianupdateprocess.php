<?php
	include '../inc/dbconnect.php';

	// get data from form: guardianID, patientID, firstName, lastName, title, relation, contactNumber, email, address, photo
	$guardianID = $_POST['guardianID'];
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
		// update information in database
		$sql = "UPDATE guardians
				SET firstName = '{$firstName}',
					lastName = '{$lastName}',
					title = '{$title}',
					contactNumber = '{$contactNumber}',
					email = '{$email}',
					address = '{$address}'
				WHERE guardianID = {$guardianID}";
		$sql1 = "UPDATE patients_guardians
				SET relation = '{$relation}'
				WHERE guardianID = {$guardianID}
				AND patientID = {$patientID}";

		if (mysql_query($sql) && mysql_query($sql1)) {
			// redirect to the patientupdate.php page with success message
			$_SESSION['patientsuccess'] = "Guardian {$lastName}, {$firstName} was updated successfully.";
			header ("Location: patientupdate.php?patient={$patientID}");
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in updating the data.";
			header ("Location: patientupdate.php?patient={$patientID}");
		}
	}
?>