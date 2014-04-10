<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, or is not a doctor, redirect to login.php with error message
	if (isset($_SESSION['user'])) {
		$staffID = $_SESSION['user'];
		$sql = "SELECT staffID, title
				FROM staff
				WHERE staffID = '$staffID'
				AND title = 1";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		if ($count == 0) {
			$_SESSION['roleerror'] = "You are not authorised to access this resource.";
			header ("Location: home.php");
		}
	} else {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Note {$_GET['note']}";
	include '../inc/panel.php';
?>

<section>
	<div class="container">
		<div class="login">
			<!-- stuff goes here -->
			<h1>Under construction</h1>
		</div>
	</div>
</section>

 