<?php
	include '../inc/dbconnect.php';

	// get data from previous form: firstName, lastName, DOB, admissionDate (photo is optional and done later)
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$DOB = mysql_escape_string($_POST['DOB']);
	$admissionDate = mysql_escape_string($_POST['admissionDate']);

	// if required fields are blank, redirect to patientadd.php with error
	if ((($firstName == '')
		|| ($lastName == '')
		|| ($DOB == '')
		|| ($admissionDate == ''))) {
		$_SESSION['error'] = 'You need to fill out ALL required fields.';
		header ("Location: patientadd.php");
	} else {
		// check for photo
		if ($_FILES['photo']['name'] != '') {
			$photo = $_FILES['photo']['name'];

			// photo renaming and location
			$randomDigit = rand(0000,9999);
			$newPhotoName = ($randomDigit . "_" . $photo);
			$target = "../images/" . $newPhotoName;
			$allowedExts = array('jpg', 'jpeg', 'gif', 'png');
			$tmp = explode('.', $_FILES['photo']['name']);
			$extension = end($tmp);

			// photo database entry
			$photo = "<img src=\"{$target}\" alt=\"Patient Picture\">";

			// if photo is not an allowed extension, kickback with error
			if (((($_FILES['photo']['type'] == 'image/gif')
				|| ($_FILES['photo']['type'] == 'image/jpeg')
				|| ($_FILES['photo']['type'] == 'image/jpg')
				|| ($_FILES['photo']['type'] == 'image/png'))
				&& 
				in_array($extension, $allowedExts))) {
				// sql to enter patient info + photo
				$sql = "INSERT INTO patients (firstName, lastName, DOB, photo)
						VALUES ('{$firstName}',	'{$lastName}', '{$DOB}', '{$photo}')";
			} else {
			$_SESSION['error'] = "The file you uploaded is not valid. Photos must be in either .gif, .jpg, or .png format.";
			header ("Location: patientadd.php");
			}
		} else {
			// sql to enter just patient info (no photo)
			$sql = "INSERT INTO patients (firstName, lastName, DOB)
					VALUES ('{$firstName}',	'{$lastName}', '{$DOB}')";
		}

		if (mysql_query($sql)) {
			// move photo (if exists)
			if ($_FILES['photo']['name'] != '') {
				move_uploaded_file($_FILES['photo']['tmp_name'], $target);
			}
			
			// get patient's ID
			$sql = "SELECT *
					FROM patients
					WHERE firstName = '{$firstName}'
					AND lastName = '{$lastName}'
					AND DOB = '{$DOB}'";
			$result = mysql_query($sql);

			while($row = mysql_fetch_assoc($result)) {
				// add admission date to payments
				$sql = "INSERT INTO payments (patientID, admissionDate)
						VALUES ({$row['patientID']}, '{$admissionDate}')";

				if (mysql_query($sql)) {
					// redirect to the patientview.php page with success message
					$_SESSION['success'] = "Patient {$row['lastName']}, {$row['firstName']} was added successfully.";
					header ("Location: patientview.php?patient={$row['patientID']}");
				} else {
					// kick back with error message: sql
					$_SESSION['error'] = "There was an error in admitting the patient. Patient information has been added, however.";
					header ("Location: patientadd.php");
				}
			}
		} else {
			// kick back with error message: sql
			$_SESSION['error'] = "There was an error in processing the data.";
			header ("Location: patientadd.php");
		}
	}
?>