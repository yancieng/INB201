<?php
	// DB (Database) Connect: Starts/keeps a session active and connects to the database.
	session_start();

	$link = mysql_connect('localhost', 'root', ''); //connect to the server
	if (!$link)
	{
		header ("Location: error.php");
	}
	if (!mysql_select_db('hospital', $link)) //select the MySQL database
	{
		header ("Location: error.php");
	}
?>