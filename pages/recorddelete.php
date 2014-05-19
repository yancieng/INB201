<?php
	include '../inc/dbconnect.php';
	// check for admin
	// if user is not admin, redirect to home page
	include '../inc/adminCheck.php';


	// get the table name and ID(s) needed for deletion SQL
	$table = mysql_escape_string($_GET['table']);
	$column = mysql_escape_string($_GET['column']);
	$ID = mysql_escape_string($_GET['ID']);


	if (isset($_GET['ID2'])) {
		$column2 = mysql_escape_string($_GET['column2']);
		$ID2 = mysql_escape_string($_GET['ID2']);

		// sql for record deletion
		$sql = "DELETE FROM {$table}
				WHERE {$column} = {$ID}
				AND {$column2} = {$ID2}";
	} else {
		// sql for record deletion
		$sql = "DELETE FROM {$table}
				WHERE {$column} = {$ID}";
	}

	if (mysql_query($sql)) {		
		// redirect to the records.php page with success message
		$_SESSION['success'] = "Record '{$ID}' from table '{$table}' was deleted successfully.";
		header ("Location: records.php?table={$table}");
	} else {
		// kick back with error message: sql
		$_SESSION['error'] = "There was an error in deleting the data.";
		header ("Location: records.php?table={$table}");
	}
?>