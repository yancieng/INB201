<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';
	// needs a check for admin only
	include '../inc/adminCheck.php';


	$pageTitle = "Staff Manager";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<script>activePanel("m2a");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Staff Manager: Page has a search function (ID or Name or Title or All), as well as an Add New Staff Member link -->

<!-- Search Form -->
<div class="leftContent">
	<div class="box">
		<section class="boxTitle">
			<p>Staff Finder</p>
		</section>
		<section class="boxContent">
			<form action="staffsearch.php" method="get">
				<div>
					<label for="staffID">StaffID: </label>
					<input type="text" class="textInput" name="staffID" />
				</div>
				<!-- OR -->
				<p>OR</p>
				<div>
					<label for="name">Name: </label>
					<input type="text" class="textInput" name="name" />
				</div>
				<!-- OR -->
				<p>OR</p>
				<div>
					<label for="title">By Title: </label>
					<select name="title">
						<option value="">Choose Title</option>
						<option value="1">Doctor</option>
						<option value="2">Nurse</option>
						<option value="3">Medical Technician</option>
						<option value="4">Receptionist</option>
						<option value="5">Administrator</option>
					</select>
				</div>
				<!-- Submit -->
				<div>
					<button type="submit" class="submit">Search</button>
				</div>
			</form>
		</section>
	</div>

	<!-- Show All Staff Link -->
	<div id="showstaff">
		<p><a href="staffsearch.php?showall=1">Show All Staff</a></p>
	</div>

	<!-- Add Staff Link -->
	<div id="addstaff">
		<p><a href="staffadd.php">Add A Staff Member</a></p>
	</div>
</div>
<?php
	include '../inc/footer.php';
?> 