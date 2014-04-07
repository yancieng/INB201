<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title><?php echo $pageTitle; ?> - Townsville Children's Hospital</title>
	<link rel="stylesheet" type="text/css" href="../css/mystyle.css" />
	<!--[if lt IE 9]>
    	<script src="../js/html5shiv.js"></script>
	<![endif]-->
</head>

<body>
	<div id="main">
		<header>
			<div id="crest">
				<img src="../images/crest3.png" alt="Crest of Queensland" height="25" width="143">
			</div>
			<div id="menu" >
				<a href="home.php">Homepage</a>
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
		</header>