<?php
	include '../inc/dbconnect.php';

	// get data from previous form: staffID, firstName, lastName, specialties, photo (checked later)
	$staffID = $_POST['staffID'];
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$specialties = mysql_escape_string($_POST['specialties']);
	
	// if optional fields are blank, make them NULL
	if ($specialties == '') {
		$specialties = NULL;
	}

	// if required fields are blank, redirect to patientview.php with error
	if (
		(($firstName == '')
		|| ($lastName == ''))
	) {
		$_SESSION['stafferror'] = "All required fields need to be filled.";
		header ("Location: profile.php");
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
		$photo = "<img src=\"{$target}\" alt=\"Profile Picture\">";

		// if photo is not an allowed extension, kickback with error
		if (((($_FILES['photo']['type'] == 'image/gif')
			|| ($_FILES['photo']['type'] == 'image/jpeg')
			|| ($_FILES['photo']['type'] == 'image/jpg')
			|| ($_FILES['photo']['type'] == 'image/png'))
			&& 
			in_array($extension, $allowedExts))
		) {
			$sql = "UPDATE staff
					SET firstName = '{$firstName}',
						lastName = '{$lastName}',
						specialties = " . ($specialties == NULL ? 'NULL' : "'{$specialties}'") . ",
						photo = '{$photo}'
					WHERE staffID = '{$staffID}'";
		} else {
			$_SESSION['stafferror'] = "The file you uploaded is not valid. Photos must be in either .gif, .jpg, or .png format.";
			header ("Location: profile.php");
		}
	} else {
		$sql = "UPDATE staff
				SET firstName = '{$firstName}',
					lastName = '{$lastName}',
					specialties = " . ($specialties == NULL ? 'NULL' : "'{$specialties}'") . "
				WHERE staffID = '{$staffID}'";
	}

	if (mysql_query($sql)) {
		// move photo (if exists)
		if (isset($_FILES['photo'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], $target);
		}

		// redirect to the staffview.php page with success message
		$_SESSION['staffsuccess'] = "Your information was updated successfully.";
		header ("Location: profile.php");
	} else {
		// kick back with error message: sql
		$_SESSION['stafferror'] = "There was an error in updating the data.";
		header ("Location: profile.php");
	}
?>