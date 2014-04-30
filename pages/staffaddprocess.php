<?php
	include '../inc/dbconnect.php';

	// get data from previous form: firstName, lastName, title (number), password, specialties, photo
	$firstName = mysql_real_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$title = $_POST['staffTitle'];
	$password = mysql_escape_string($_POST['password']);
	$specialties = mysql_escape_string($_POST['specialties']);
	$photo = $_FILES['photo']['name'];

	// if optional fields are blank, make them NULL
	if ($specialties == '') {
		$specialties = NULL;
	}

	// if photo field is blank, set default photo path
	if ($photo == '') {
		$photo = "<img src='../images/none.png' alt='Profile picture' />')";
	} else {
		// photo renaming and location
		$randomDigit = rand(0000,9999);
		$newPhotoName = ($randomDigit . "_" . $photo);
		$target = "../images/" . $newPhotoName;
		$allowedExts = array('jpg', 'jpeg', 'gif', 'png');
		$tmp = explode('.', $_FILES['photo']['name']);
		$extension = end($tmp);

		$photo = $target;

		// if photo is not an allowed extension, kickback with error
		if (!
			((($_FILES['photo']['type'] == 'image/gif')
			|| ($_FILES['photo']['type'] == 'image/jpeg')
			|| ($_FILES['photo']['type'] == 'image/jpg')
			|| ($_FILES['photo']['type'] == 'image/png'))
			&& 
			in_array($extension, $allowedExts))
		) {
			$_SESSION['stafferror'] = "The file you uploaded is not valid. Photos must be in either .gif, .jpg, or .png format.";
			header ("Location: staffadd.php");
		}
	}

	// if required fields are blank, redirect to staffadd.php with error
	if (
		(($firstName == '')
		|| ($lastName == '')
		|| ($title == '')
		|| ($password == ''))
	) {
		$_SESSION['stafferror'] = 'You need to fill out ALL required fields.';
		header ("Location: staffadd.php");
	} else {
		// hash the password
		$password = hash('sha256', $password);	

		$sql = "INSERT INTO staff (firstName, lastName, title, password, specialties, photo)
				VALUES ('{$firstName}',	'{$lastName}', '{$title}', '{$password}', '{$specialties}', '{$photo}';"

		if (mysql_query($sql)) {		
			$sql = "SELECT *
					FROM staff
					WHERE firstName = '{$firstName}'
					AND lastName = '{$lastName}'
					AND password = '{$password}'";
			$result = mysql_query($sql);
			$row = mysql_num_rows($result);

			while($row = mysql_fetch_assoc($result)) {
				// redirect to the staffview.php page with success message
				$_SESSION['staffsuccess'] = "Staff {$row['lastName']}, {$row['firstName']} was added successfully.";
				header ("Location: staffview.php?staff={$row['staffID']}");
			}
		} else {
			// kick back with error message: sql
			$_SESSION['stafferror'] = "There was an error in processing the data.";
			header ("Location: staffadd.php");
		}
	}
?>