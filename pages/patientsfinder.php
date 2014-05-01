<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Patients Finder";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
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
			<!--<center>or</center>
			<label for="phone">Phone: </label>
			<input type="text" name="phone">-->
			<br>
			<hr>
			<br>
			<!-- Advanced Search: parameters for uhh, DOB, what else -->
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
		<table id="topTen">
			<?php
			// Top 10 Patients

			// Normally, this would be the last 10 patients that have had a checkup?
			// But for now, it'll just be the last 10 patients registered in the system

			$sql = "SELECT patientID, firstName, lastName
					FROM patients
					ORDER BY patientID DESC";
			$result = mysql_query($sql);

			for ($i = 1; $i <= 10; $i++) {
				$row = mysql_fetch_assoc($result);
				echo "<tr>";
					echo "<td>" . $i . ". <a href='patientview.php?patient={$row['patientID']}'>{$row['lastName']}, {$row['firstName']}</a></td>";
				echo "</tr>";
			}
			?>
		</table>
	</div>
</div>

<?php
	include '../inc/footer.php';
?>