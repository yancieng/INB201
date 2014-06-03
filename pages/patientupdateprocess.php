<?php
	include '../inc/dbconnect.php';

	// get data from previous form: patientID, firstName, lastName, DOB, bedNumber
	$patientID = $_POST['patientID'];
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$DOB = mysql_escape_string($_POST['DOB']);
	$bedNumber = mysql_escape_string($_POST['bedNumber']);

	// if required fields are blank, redirect to patientview.php with error
	if (
		(($firstName == '')
		|| ($lastName == ''))
	) {
		$_SESSION['patienterror'] = "ALL required fields need to be filled. Don't just delete data like that.";
		header ("Location: patientupdate.php?patient={$patientID}");
	}

	if ($_FILES['photo']['name'] != '') {
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
			$sql = "UPDATE patients
				SET firstName = '{$firstName}',
					lastName = '{$lastName}',
					DOB = '{$DOB}',
					photo = '{$photo}'
				WHERE patientID = '{$patientID}'";
		} else {
			$_SESSION['stafferror'] = "The file you uploaded is not valid. Photos must be in either .gif, .jpg, or .png format.";
			header ("Location: profile.php");
		}
	} else {
		// update sql for patient
		$sql = "UPDATE patients
				SET firstName = '{$firstName}',
					lastName = '{$lastName}',
					DOB = '{$DOB}'
				WHERE patientID = '{$patientID}'";
	}

	// update sql for bedNumber: unassign old bed, assign new one
	$bedunassign = "UPDATE beds
					SET patientID = NULL
					WHERE patientID = {$patientID}";
	$bedassign = "UPDATE beds
				  SET patientID = {$patientID}
				  WHERE bedNumber = '{$bedNumber}'";

	if (mysql_query($sql) && mysql_query($bedunassign) && mysql_query($bedassign)) {
		// move photo (if exists)
		if ($_FILES['photo']['name'] != '') {
			move_uploaded_file($_FILES['photo']['tmp_name'], $target);
		}

		// redirect to the patientupdate.php page with success message
		$_SESSION['patientsuccess'] = "Patient {$lastName}, {$firstName} was updated successfully.";
		header ("Location: patientupdate.php?patient={$patientID}");
	} else {
		// kick back with error message: sql
		$_SESSION['patienterror'] = "There was an error in updating the data.";
		header ("Location: patientupdate.php?patient={$patientID}");
	}
?>