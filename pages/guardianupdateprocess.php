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

		// photo renaming and location
		$randomDigit = rand(0000,9999);
		$newPhotoName = ($randomDigit . "_" . $photo);
		$target = "../images/" . $newPhotoName;
		$allowedExts = array('jpg', 'jpeg', 'gif', 'png');
		$tmp = explode('.', $_FILES['photo']['name']);
		$extension = end($tmp);

		// photo name for database
		$photo = "<img src=\"{$target}\" alt=\"Patient Picture\">";

		// if photo is not an allowed extension, kickback with error
		if (((($_FILES['photo']['type'] == 'image/gif')
			|| ($_FILES['photo']['type'] == 'image/jpeg')
			|| ($_FILES['photo']['type'] == 'image/jpg')
			|| ($_FILES['photo']['type'] == 'image/png'))
			&& 
			in_array($extension, $allowedExts))
		) {
			$sql = "UPDATE guardians
				SET firstName = '{$firstName}',
					lastName = '{$lastName}',
					title = '{$title}',
					contactNumber = '{$contactNumber}',
					email = '{$email}',
					address = '{$address}',
					photo = '{$photo}'
				WHERE guardianID = {$guardianID}";
		} else {
			$_SESSION['stafferror'] = "The file you uploaded is not valid. Photos must be in either .gif, .jpg, or .png format.";
			header ("Location: profile.php");
		}		
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
	}

	$sql1 = "UPDATE patients_guardians
			SET relation = '{$relation}'
			WHERE guardianID = {$guardianID}
			AND patientID = {$patientID}";

	if (mysql_query($sql) && mysql_query($sql1)) {
		// move photo (if exists)
		if (isset($_FILES['photo'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], $target);
		}

		// redirect to the patientupdate.php page with success message
		$_SESSION['patientsuccess'] = "Guardian {$lastName}, {$firstName} was updated successfully.";
		header ("Location: patientupdate.php?patient={$patientID}");
	} else {
		// kick back with error message: sql
		$_SESSION['patienterror'] = "There was an error in updating the data.";
		header ("Location: patientupdate.php?patient={$patientID}");
	}
?>