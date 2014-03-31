<?php
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