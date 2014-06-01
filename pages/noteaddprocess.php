<?php
	include '../inc/dbconnect.php';

	// get info from form: note, staffID and image (if exists)
	$note = mysql_escape_string($_POST['note']);
	$staffID = mysql_escape_string($_POST['staffID']);

	// if note is blank, return to noteadd with error
	if ($note == '') {
		$_SESSION['error'] = 'You need to fill out a note to add one.';
		header ("Location: noteadd.php");
	}

	// photo checking
	if (isset($_FILES['photo'])) {
		$photo = $_FILES['photo']['name'];

		// photo renaming and location
		$randomDigit = rand(0000,9999);
		$newPhotoName = ($randomDigit . "_" . $photo);
		$target = "../images/" . $newPhotoName;
		$allowedExts = array('jpg', 'jpeg', 'gif', 'png');
		$tmp = explode('.', $_FILES['photo']['name']);
		$extension = end($tmp);

		$photo = '<img src="' . $target . '" alt="Image" />';

		// if photo is not an allowed extension, kickback with error
		if (!
			((($_FILES['photo']['type'] == 'image/gif')
			|| ($_FILES['photo']['type'] == 'image/jpeg')
			|| ($_FILES['photo']['type'] == 'image/jpg')
			|| ($_FILES['photo']['type'] == 'image/png'))
			&& 
			in_array($extension, $allowedExts))
		) {
			$_SESSION['error'] = "The file you uploaded is not valid. Photos must be in either .gif, .jpg, or .png format.";
			header ("Location: staffadd.php");
		} else {
			move_uploaded_file($_FILES['photo']['tmp_name'], $target);
		}
	} else {
		$photo = '<img src="../images/none.png" alt="Image" />';
	}

	// insert sql
	$sql = "INSERT INTO notes (note, image, staffID)
			VALUES ('{$note}', '{$image}', '{$staffID}')";

	if (mysql_query($sql)) {		
		// redirect to the notes.php page with success message
		$_SESSION['success'] = "Note was added successfully.";
		header ("Location: notes.php");
	} else {
		// kick back with error message: sql
		$_SESSION['error'] = "There was an error in adding the data.";
		header ("Location: noteadd.php");
	}
?>