<?php
	if (!isset($_SESSION['user'])) {
			$_SESSION['loginerror'] = "You must be logged in to access this resource.";
			header("Location: login.php");
	}
?>