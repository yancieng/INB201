<?php
	// Admin Check: Used on admin-only pages to ensure that the user is an administrator.
	if ($_SESSION['title'] != 5) {
		header ("Location: home.php");
	}
?>