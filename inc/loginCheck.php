<?php
	// Login Check: Used to ensure that a valid staff member is logged in when using the site.
	if (!isset($_SESSION['user'])) {
			$_SESSION['loginerror'] = "You must be logged in to access this resource.";
			header("Location: login.php");
	}
?>