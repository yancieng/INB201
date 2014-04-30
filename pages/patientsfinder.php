<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Patients Finder";
	include '../inc/panel.php';
?>

<script type="text/javascript">
	function active() {

		var no = "m2"; //The coresponding active panal (the menu) of this page
		// change this number for each different page, or is there a better way?

		document.getElementById(no).className = ' active';
		document.getElementById(no).href = "#" ;
		document.getElementById(no).style.cursor = "default";
	}

</script>

<!-- Content goes here -->
<!-- This DIV keeps the search fields and 'Top 10 patients' side by side -->
<div id="box0">

	<!-- This DIV is the search criteria -->
	<div id="box1">
		<form action="searchprocess.php" method="get">
			<label for="patientID">Patient ID: </label>
			<input type="text" name="patientID"><br>
			<center>or</center>
			<label for="name">Name: </label>
			<input type="text" name="name"><br>
			<center>or</center>
			<label for="phone">Phone: </label>
			<input type="text" name="phone">
			<br>
			<hr>
			<br>
			<i>Advanced Search:</i><br>
			<select>
				<option value="p1">parameter 1</option>
				<option value="p2">parameter 2</option>
				<option value="p3">parameter 3</option>
				<option value="p4">parameter 4</option>
			</select>
			: <input type="text" name="parameter"><br>
			
			<!-- Tried making the 'search' button float right. Doesn't work -->
			<div id:"button">
			<button type="submit">Search</button>
			</div>
		</form>
		
	</div>

	<!-- This DIV is for the 'Top 10 patients' -->
	<div id="box2">
		Top 10 patients:
		<br>
		
		<!-- This table is for the 'Top 10 patients' -->
		<table>
		<tr>
			<td>1. Yancie Ng</td>
		</tr>
		<tr>
			<td>2.</td>
		</tr>
		<tr>
			<td>3.</td>
		</tr>
		<tr>
			<td>4.</td>
		</tr>
		<tr>
			<td>5.</td>
		</tr>
		<tr>
			<td>6.</td>
		</tr>
		<tr>
			<td>7.</td>
		</tr>
		<tr>
			<td>8.</td>
		</tr>
		<tr>
			<td>9.</td>
		</tr>
		<tr>
			<td>10.</td>
		</tr>
		</table>
	</div>
</div>

<?php
	include '../inc/footer.php';
?>