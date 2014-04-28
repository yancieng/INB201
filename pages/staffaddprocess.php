<?php
	include '../inc/dbconnect.php';

	// get data from previous form: firstName, lastName, title (number), password
	$firstName = mysql_real_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$title = $_POST['staffTitle'];
	$password = mysql_escape_string($_POST['password']);

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

		$sql = "INSERT INTO staff (firstName, lastName, title, password, photo)
				VALUES ('{$firstName}',	'{$lastName}', '{$title}', '{$password}', \"<img src='../images/none.png' alt='Profile picture' />')\";"

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