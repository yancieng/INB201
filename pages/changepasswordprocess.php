<?php
	include '../inc/dbconnect.php';

	// get data from previous form: currentpassword, newpassword, newpasswordconfirm
	$currentpassword = mysql_escape_string($_POST['currentpassword']);
	$newpassword = mysql_escape_string($_POST['newpassword']);
	$newpasswordconfirm = mysql_escape_string($_POST['newpasswordconfirm']);

	// get staffID (used for session)
	$staffID = $_SESSION['user'];

	// sql for checking current password
	$checksql = "SELECT password
			FROM staff
			WHERE staffID = '{$staffID}'";
	$result = mysql_query($checksql);
	$row = mysql_fetch_assoc($result);

	// hash the current password
	$currentpassword = hash('sha256', $currentpassword);

	// check if fields are filled
	if (($currentpassword == '')
		|| ($newpassword == '')
		|| ($newpasswordconfirm == ''))
	{
		// set an error message
		$_SESSION['passworderror'] = 'All fields need to be filled.';
		// redirect back to changepassword.php
		header ("Location: changepassword.php");
	} else if ($currentpassword != $row['password']) {// check if old password matches
		// set an error message
		$_SESSION['passworderror'] = 'Your old password does not match.';
		// redirect back to changepassword.php
		header ("Location: changepassword.php");
	} else if ($newpassword != $newpasswordconfirm) {// check if new passwords match
		// set an error message
		$_SESSION['passworderror'] = 'Your passwords do not match.';
		// redirect back to changepassword.php
		header ("Location: changepassword.php");
	} else {
		// change password in database
		// hash password
		$newhash = hash('sha256', $newpassword);

		$sql = "UPDATE staff
				SET password = '{$newhash}'
				WHERE staffID = '{$staffID}'";

		if (mysql_query($sql)) {
			// set a success message
			$_SESSION['passwordsuccess'] = 'Your password has been changed.';
			// redirect back to changepassword.php
			header ("Location: changepassword.php");
		} else {
			// set an error message
			$_SESSION['passworderror'] = 'Your password could not be updated.';
			// redirect back to changepassword.php
			header ("Location: changepassword.php");
		}
	}
?>