<?php
	session_start();
	include '../inc/dbconnect.php';

	$staffID = mysql_real_escape_string($_POST['staffID']);
	$password = mysql_real_escape_string($_POST['password']);

	// hash the password
	$password = hash('sha256', $password);	

	$sql = "SELECT *
			FROM staff
			WHERE staffID = '$staffID'
			AND password = '$password'";

	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	$row = mysql_fetch_assoc($result);

	if ($count == 1)
	{
		// set session, redirect to home page
		$_SESSION['user'] = $row['staffID'];
		$_SESSION['name'] = $row['firstName'];
		$_SESSION['lname'] = $row['lastName'];
		$_SESSION['title'] = $row['title'];
		$_SESSION['spec'] = $row['specialties'];
		$_SESSION['photo'] = $row['photo'];
		header("Location: home.php");
	}
	else
	{
		// redirect to login page with an error message
		$_SESSION['loginerror'] = 'Incorrect Username or Password.';
		header("Location: login.php");
	}
?>