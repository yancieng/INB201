<?php
	include 'dbconnect.php';
?>

<!DOCTYPE html>

<html>
	<head>
		<link href="../css/mystyle.css" rel="stylesheet" type="text/css"/>
		<title><?php echo $pageTitle; ?> - Townsville Children's Hospital</title>
	</head>

	<body>
		<div id="main">
		<div id="header">
		<div id="crest">
			<img src="../images/crest3.png" alt="Crest of Queensland" height="25" width="143">
		</div>
		<div id="menu" >
			<a href="#.html">Homepage</a>
			<a href="#.html">About</a>
			<a href="#.html">Contact Us</a>
			<?php
				if (isset($_SESSION['user']))
				{
					echo "<a href='logout.php'>Logout</a>";
				}
			?>
		</div>
		<div id="title">
			<h2>Townsville Children's Hospital</h2>
		</div>
		</div>