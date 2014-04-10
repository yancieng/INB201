<?php
	include '../inc/dbconnect.php';

	// get data from previous form: staffID, firstName, lastName, [staff]title (number)
	$staffID = $_POST['staffID'];
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$title = $_POST['staffTitle'];

	// if required fields are blank, redirect to patientview.php with error
	if (
		(($firstName == '')
		|| ($lastName == '')
		|| ($title == ''))
	) {
		$_SESSION['stafferror'] = "ALL required fields need to be filled. Don't just delete data like that.";
		header ("Location: staffview.php?staff={$staffID}");
	} else {
		$sql = "UPDATE staff
				SET firstName = '{$firstName}',
					lastName = '{$lastName}',
					title = '{$title}'
				WHERE staffID = '{$staffID}'";

		if (mysql_query($sql)) {		
			// redirect to the staffview.php page with success message
			$_SESSION['staffsuccess'] = "Staff {$lastName}, {$firstName} was updated successfully.";
			header ("Location: staffview.php?staff={$staffID}");
		} else {
			// kick back with error message: sql
			$_SESSION['stafferror'] = "There was an error in updating the data.";
			header ("Location: staffview.php?staff={$staffID}");
		}
	}
?>