<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}
	// needs a check for admin only

	$pageTitle = "Staff Manager";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<script type="text/javascript">
	function active() {

		// var no = "m#"; //The coresponding active panal (the menu) of this page
		// change this number for each different page, or is there a better way?

		document.getElementById(no).className = ' active';
		document.getElementById(no).href = "#" ;
		document.getElementById(no).style.cursor = "default";
	}

</script>

<!-- Content goes below -->
<!-- Staff Manager: Page has a search function (ID or Name or Title or All), as well as an Add New Staff Member link -->

<!-- Search Form -->
<div id="staffsearch">
	<form action="staffsearch.php" method="get">
		<div>
			<label for="staffID">StaffID: </label>
			<input type="text" name="staffID" />
		</div>
		<!-- OR -->
		<p>OR</p>
		<div>
			<label for="name">Name: </label>
			<input type="text" name="name" />
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
			<button type="submit">Search</button>
		</div>
	</form>
</div>

<!-- Show All Staff Link -->
<div id="showstaff">
	<p><a href="staffsearch.php?showall=1">Show All Staff</a></p>
</div>

<!-- Add Staff Link -->
<div id="addstaff">
	<p><a href="staffadd.php">Add A Staff Member</a></p>
</div>

<?php
	include '../inc/footer.php';
?> 