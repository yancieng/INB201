<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';
	// if user is not admin, redirect to home page
	include '../inc/adminCheck.php';


	// get the table chosen
	$table = mysql_escape_string($_GET['table']);

	$pageTitle = "Records: " . $table;
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='recordsmenu.php'>Records Menu</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2b");</script>

<!-- Content goes below -->
<!-- Records: display all records from table in descending order, with delete (and edit?) links for each -->
<div id="records">
<?php
	// if success or error messages are set, display
	if (isset($_SESSION['success'])) {
		echo "<p id='error'>" . $_SESSION['success'] . "</p>";
		unset($_SESSION['success']);
	}
	if (isset($_SESSION['error'])) {
		echo "<p id='error'>" . $_SESSION['error'] . "</p>";
		unset($_SESSION['error']);
	}
?>
<?php
	// switch check for table
	switch ($table) {
		case "beds":
			// sql for what table they chose
			$sql = "SELECT bedNumber, patientID
					FROM beds
					ORDER BY bedNumber ASC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>bedNumber</th>
					<th>patientID</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['bedNumber']}</td>
					<td>{$row['patientID']}</td>
					<td><a href='recordedit.php?table=beds&column=bedNumber&ID={$row['bedNumber']}'>Edit</td>
					<td><a href='recorddelete.php?table=beds&column=bedNumber&ID={$row['bedNumber']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "checkups":
			// sql for what table they chose
			$sql = "SELECT checkupID, temperature, bloodPressure, pulse, eyeSightLeft, eyeSightRight, bloodSugar, height, weight, bloodType, timestamp, patientID
					FROM checkups
					ORDER BY checkupID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>checkupID</th>
					<th>temperature</th>
					<th>bloodPressure</th>
					<th>pulse</th>
					<th>eyeSightLeft</th>
					<th>eyeSightRight</th>
					<th>bloodSugar</th>
					<th>height</th>
					<th>weight</th>
					<th>bloodType</th>
					<th>timestamp</th>
					<th>patientID</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['checkupID']}</td>
					<td>{$row['temperature']}</td>
					<td>{$row['bloodPressure']}</td>
					<td>{$row['pulse']}</td>
					<td>{$row['eyeSightLeft']}</td>
					<td>{$row['eyeSightRight']}</td>
					<td>{$row['bloodSugar']}</td>
					<td>{$row['height']}</td>
					<td>{$row['weight']}</td>
					<td>{$row['bloodType']}</td>
					<td>{$row['timestamp']}</td>
					<td>{$row['patientID']}</td>
					<td><a href='recordedit.php?table=checkups&column=checkupID&ID={$row['checkupID']}'>Edit</td>
					<td><a href='recorddelete.php?table=checkups&column=checkupID&ID={$row['checkupID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "conditions":
			// sql for what table they chose
			$sql = "SELECT conditionID, `condition`, conditionDate, medication, allergy, allergyDate, allergySeverity, timestamp, patientID
					FROM conditions
					ORDER BY conditionID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>conditionID</th>
					<th>condition</th>
					<th>conditionDate</th>
					<th>medication</th>
					<th>allergy</th>
					<th>allergyDate</th>
					<th>allergySeverity</th>
					<th>timestamp</th>
					<th>patientID</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['conditionID']}</td>
					<td>{$row['condition']}</td>
					<td>{$row['conditionDate']}</td>
					<td>{$row['medication']}</td>
					<td>{$row['allergy']}</td>
					<td>{$row['allergyDate']}</td>
					<td>{$row['allergySeverity']}</td>
					<td>{$row['timestamp']}</td>
					<td>{$row['patientID']}</td>
					<td><a href='recordedit.php?table=conditions&column=conditionID&ID={$row['conditionID']}'>Edit</td>
					<td><a href='recorddelete.php?table=conditions&column=conditionID&ID={$row['conditionID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "guardians":
			// sql for what table they chose
			$sql = "SELECT guardianID, firstName, lastName, title, contactNumber, email, address, photo
					FROM guardians
					ORDER BY guardianID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>guardianID</th>
					<th>firstName</th>
					<th>lastName</th>
					<th>title</th>
					<th>contactNumber</th>
					<th>email</th>
					<th>address</th>
					<th>photo</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['guardianID']}</td>
					<td>{$row['firstName']}</td>
					<td>{$row['lastName']}</td>
					<td>{$row['title']}</td>
					<td>{$row['contactNumber']}</td>
					<td>{$row['email']}</td>
					<td>{$row['address']}</td>
					<td>{$row['photo']}</td>
					<td><a href='recordedit.php?table=guardians&column=guardianID&ID={$row['guardianID']}'>Edit</td>
					<td><a href='recorddelete.php?table=guardians&column=guardianID&ID={$row['guardianID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "notes":
			// sql for what table they chose
			$sql = "SELECT noteID, datetimeWritten, note, image, staffID
					FROM notes
					ORDER BY noteID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>noteID</th>
					<th>datetimeWritten</th>
					<th>note</th>
					<th>image</th>
					<th>staffID</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['noteID']}</td>
					<td>{$row['datetimeWritten']}</td>
					<td>{$row['note']}</td>
					<td>{$row['image']}</td>
					<td>{$row['staffID']}</td>
					<td><a href='recordedit.php?table=notes&column=noteID&ID={$row['noteID']}'>Edit</td>
					<td><a href='recorddelete.php?table=notes&column=noteID&ID={$row['noteID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "observations":
			// sql for what table they chose
			$sql = "SELECT observationID, timestamp, observationTitle, observation, patientID, staffID
					FROM observations
					ORDER BY observationID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>observationID</th>
					<th>timestamp</th>
					<th>observationTitle</th>
					<th>observation</th>
					<th>patientID</th>
					<th>staffID</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['observationID']}</td>
					<td>{$row['timestamp']}</td>
					<td>{$row['observationTitle']}</td>
					<td>{$row['observation']}</td>
					<td>{$row['patientID']}</td>
					<td>{$row['staffID']}</td>
					<td><a href='recordedit.php?table=observations&column=observationID&ID={$row['observationID']}'>Edit</td>
					<td><a href='recorddelete.php?table=observations&column=observationID&ID={$row['observationID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;
		
		case "patients":
			// sql for what table they chose
			$sql = "SELECT patientID, firstName, lastName, DOB, photo
					FROM patients
					ORDER BY patientID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>patientID</th>
					<th>firstName</th>
					<th>lastName</th>
					<th>DOB</th>
					<th>photo</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['patientID']}</td>
					<td>{$row['firstName']}</td>
					<td>{$row['lastName']}</td>
					<td>{$row['DOB']}</td>
					<td>{$row['photo']}</td>
					<td><a href='recordedit.php?table=patients&column=patientID&ID={$row['patientID']}'>Edit</td>
					<td><a href='recorddelete.php?table=patients&column=patientID&ID={$row['patientID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "patients_guardians":
			// sql for what table they chose
			$sql = "SELECT patientID, guardianID, relation
					FROM patients_guardians
					ORDER BY patientID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>patientID</th>
					<th>guardianID</th>
					<th>relation</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['patientID']}</td>
					<td>{$row['guardianID']}</td>
					<td>{$row['relation']}</td>
					<td><a href='recordedit.php?table=patients_guardians&column=patientID&ID={$row['patientID']}&column2=guardianID&ID2={$row['guardianID']}'>Edit</td>
					<td><a href='recorddelete.php?table=patients_guardians&column=patientID&ID={$row['patientID']}&column2=guardianID&ID2={$row['guardianID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "payments":
			// sql for what table they chose
			$sql = "SELECT paymentID, admissionDate, releaseDate, cost, paymentMethod, rebuff, patientID
					FROM payments
					ORDER BY paymentID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>paymentID</th>
					<th>admissionDate</th>
					<th>releaseDate</th>
					<th>cost</th>
					<th>paymentMethod</th>
					<th>rebuff</th>
					<th>patientID</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['paymentID']}</td>
					<td>{$row['admissionDate']}</td>
					<td>{$row['releaseDate']}</td>
					<td>{$row['cost']}</td>
					<td>{$row['paymentMethod']}</td>
					<td>{$row['rebuff']}</td>
					<td>{$row['patientID']}</td>
					<td><a href='recordedit.php?table=payments&column=paymentID&ID={$row['paymentID']}'>Edit</td>
					<td><a href='recorddelete.php?table=payments&column=paymentID&ID={$row['paymentID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "schedules":
			// sql for what table they chose
			$sql = "SELECT scheduleID, scheduledFor, scheduledTime, patientID
					FROM schedules
					ORDER BY scheduleID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>scheduleID</th>
					<th>scheduledFor</th>
					<th>scheduledTime</th>
					<th>patientID</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['scheduleID']}</td>
					<td>{$row['scheduledFor']}</td>
					<td>{$row['scheduledTime']}</td>
					<td>{$row['patientID']}</td>
					<td><a href='recordedit.php?table=schedules&column=scheduleID&ID={$row['scheduleID']}'>Edit</td>
					<td><a href='recorddelete.php?table=schedules&column=scheduleID&ID={$row['scheduleID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "staff":
			// sql for what table they chose
			$sql = "SELECT staffID, firstName, lastName, titles.title, password, specialties, photo
					FROM staff INNER JOIN titles ON staff.title = titles.titleID
					ORDER BY staffID DESC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>staffID</th>
					<th>firstName</th>
					<th>lastName</th>
					<th>title</th>
					<th>password</th>
					<th>specialties</th>
					<th>photo</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['staffID']}</td>
					<td>{$row['firstName']}</td>
					<td>{$row['lastName']}</td>
					<td>{$row['title']}</td>
					<td>{$row['password']}</td>
					<td>{$row['specialties']}</td>
					<td>{$row['photo']}</td>
					<td><a href='recordedit.php?table=staff&column=staffID&ID={$row['staffID']}'>Edit</td>
					<td><a href='recorddelete.php?table=staff&column=staffID&ID={$row['staffID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;

		case "titles":
			// sql for what table they chose
			$sql = "SELECT titleID, title
					FROM titles
					ORDER BY titleID ASC";
			$result = mysql_query($sql);

			// display in table form
			echo "
			<table>
				<tr>
					<th>titleID</th>
					<th>title</th>

					<th></th>
					<th></th>
				</tr>
			";
			while ($row = mysql_fetch_array($result)) {
				echo "
				<tr>
					<td>{$row['titleID']}</td>
					<td>{$row['title']}</td>
					<td><a href='recordedit.php?table=titles&column=titleID&ID={$row['titleID']}'>Edit</td>
					<td><a href='recorddelete.php?table=titles&column=titleID&ID={$row['titleID']}'>Delete</td>
				</tr>
				";
			}
			echo "</table>";
			break;
			
		default:
			echo "No table selected.";
			break;
	}
?>
</div>

<?php
	include '../inc/footer.php';
?> 