<?php
	include '../inc/dbconnect.php';

	// get information from form: details, room, startTime, endTime, patientID
	$details = mysql_escape_string($_POST['details']);
	$room = mysql_escape_string($_POST['room']);
	$startTime = mysql_escape_string($_POST['startTime']);
	$endTime = mysql_escape_string($_POST['endTime']);
	$patientID = mysql_escape_string($_POST['patientID']);

	// check for any empty fields
	if (($details == '')
		|| ($room == '')
		|| ($startTime == '')
		|| ($endTime == '')
		|| ($patientID == '')) {
		$_SESSION['error'] = 'You need to fill out ALL required fields.';
		header ("Location: schedule.php");
	} else {
		// check for "already booked"
		$sql = "SELECT *
				FROM schedules
				WHERE room = '{$room}'
				AND ((startTime BETWEEN '{$startTime}' AND '{$endTime}')
					OR (endTime BETWEEN '{$startTime}' AND '{$endTime}'))";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		if ($count > 0) {
			// error: already booked
			$_SESSION['error'] = "That room is already booked during that time.";
			header ("Location: schedule.php");
		} else {
			// sql to add scheduled event
			$sql = "INSERT INTO schedules (details, room, startTime, endTime, patientID)
					VALUES ('{$details}', '{$room}', '{$startTime}', '{$endTime}', '{$patientID}')";

			if (mysql_query($sql)) {
				// success message
				$_SESSION['success'] = "Event \"{$details}\" was scheduled successfully.";
				header ("Location: schedule.php");				
			} else {
				// error: sql
				$_SESSION['error'] = "There was an error booking that room. Try again later or contact your system administrator.";
				header ("Location: schedule.php");	
			}
		}
	}
?>