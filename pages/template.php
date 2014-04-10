<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	// $pageTitle = "Untitled Page";
	include '../inc/panel.php';
?>

<section>
	<div class="container">
		<div class="login">
			<!-- stuff goes here -->
		</div>
	</div>
</section>

 