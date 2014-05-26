<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';
	// if user is not admin, redirect to home page
	include '../inc/adminCheck.php';

	$pageTitle = "Records Menu";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2b");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Content goes below -->
<!-- Records Menu: Page that has links to delete records from database tables (admin only) -->
<!-- Page needs search functionality: does search for any column in any table that matches -->

<div class="leftContent">
	<!-- Record Search -->
	<div class="box">
		<section class="boxTitle">
			<p>Record Search</p>
		</section>
		<section class="boxContent">
			<form action="recordsearch.php" method="get">
				<div>
					<label for="search">Search: </label>
					<input class="textInput" type="text" name="search" required />
				</div>
				<div>
					<button type="submit" class="submit">Search Database</button>
				</div>
			</form>
		</section>
	</div>

	<!-- Records Menu -->
	<div class="box">
		<section class="boxTitle">
			<p>Records Menu</p>
		</section>
		<section class="boxContent">
			<p>Select below which database table to view records from:</p>
			<ul>
				<li><a href="records.php?table=beds">beds</a></li>
				<li><a href="records.php?table=checkups">checkups</a></li>
				<li><a href="records.php?table=conditions">conditions</a></li>
				<li><a href="records.php?table=guardians">guardians</a></li>
				<li><a href="records.php?table=notes">notes</a></li>
				<li><a href="records.php?table=observations">observations</a></li>
				<li><a href="records.php?table=patients">patients</a></li>
				<li><a href="records.php?table=patients_guardians">patients_guardians</a></li>
				<li><a href="records.php?table=payments">payments</a></li>
				<li><a href="records.php?table=schedules">schedules</a></li>
				<li><a href="records.php?table=staff">staff</a></li>
				<li><a href="records.php?table=titles">titles</a></li>
			</ul>
		</section>
	</div>

</div>



<?php
	include '../inc/footer.php';
?> 