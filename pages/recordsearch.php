<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';
	// if user is not admin, redirect to home page
	include '../inc/adminCheck.php';

	$pageTitle = "Record Search";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='recordsmenu.php'>Records Menu</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2b");</script>

<!-- Record Search: shows all matches in all columns of all tables for search term -->
<div id="records">
<?php
	// get search term from form:
	$search = mysql_escape_string($_GET['search']);
	echo "<p>Searching all tables for '{$search}':</p>";

	// keep count of how many tables have results (for 0 check at end)
	$tables = 0;

	// beds
	$sql = "SELECT bedNumber, patientID
			FROM beds
			WHERE bedNumber LIKE '%{$search}%'
			OR patientID LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'beds'";

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
	}

	// checkups
	$sql = "SELECT checkupID, temperature, bloodPressure, pulse, eyeSightLeft, eyeSightRight, bloodSugar, height, weight, bloodType, timestamp, patientID
			FROM checkups
			WHERE checkupID LIKE '%{$search}%'
			OR temperature LIKE '%{$search}%'
			OR bloodPressure LIKE '%{$search}%'
			OR pulse LIKE '%{$search}%'
			OR eyeSightLeft LIKE '%{$search}%'
			OR eyeSightRight LIKE '%{$search}%'
			OR bloodSugar LIKE '%{$search}%'
			OR height LIKE '%{$search}%'
			OR weight LIKE '%{$search}%'
			OR bloodType LIKE '%{$search}%'
			OR timestamp LIKE '%{$search}%'
			OR patientID LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'checkups'";

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
	}

	// conditions
	$sql = "SELECT conditionID, `condition`, conditionDate, medication, allergy, allergyDate, allergySeverity, timestamp, patientID
			FROM conditions
			WHERE conditionID LIKE '%{$search}%'
			OR `condition` LIKE '%{$search}%'
			OR conditionDate LIKE '%{$search}%'
			OR medication LIKE '%{$search}%'
			OR allergy LIKE '%{$search}%'
			OR allergyDate LIKE '%{$search}%'
			OR allergySeverity LIKE '%{$search}%'
			OR timestamp LIKE '%{$search}%'
			OR patientID LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'conditions'";

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
	}

	// guardians
	$sql = "SELECT guardianID, firstName, lastName, title, contactNumber, email, address, photo
			FROM guardians
			WHERE guardianID LIKE '%{$search}%'
			OR firstName LIKE '%{$search}%'
			OR lastName LIKE '%{$search}%'
			OR title LIKE '%{$search}%'
			OR contactNumber LIKE '%{$search}%'
			OR email LIKE '%{$search}%'
			OR address LIKE '%{$search}%'
			OR photo LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'guardians'";

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
	}

	// notes
	$sql = "SELECT noteID, datetimeWritten, note, image, staffID
			FROM notes
			WHERE noteID LIKE '%{$search}%'
			OR datetimeWritten LIKE '%{$search}%'
			OR note LIKE '%{$search}%'
			OR image LIKE '%{$search}%'
			OR staffID LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'notes'";

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
	}

	// observations
	$sql = "SELECT observationID, timestamp, observationTitle, observation, patientID, staffID
			FROM observations
			WHERE observationID LIKE '%{$search}%'
			OR timestamp LIKE '%{$search}%'
			OR observationTitle LIKE '%{$search}%'
			OR observation LIKE '%{$search}%'
			OR patientID LIKE '%{$search}%'
			OR staffID LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'observations'";

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
	}

	// patients
	$sql = "SELECT patientID, firstName, lastName, DOB, photo
			FROM patients
			WHERE patientID LIKE '%{$search}%'
			OR firstName LIKE '%{$search}%'
			OR lastName LIKE '%{$search}%'
			OR DOB LIKE '%{$search}%'
			OR photo LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'patients'";

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
	}

	// patients_guardians
	$sql = "SELECT patientID, guardianID, relation
			FROM patients_guardians
			WHERE patientID LIKE '%{$search}%'
			OR guardianID LIKE '%{$search}%'
			OR relation LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'patients_guardians'";

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
	}

	// payments
	$sql = "SELECT paymentID, admissionDate, releaseDate, cost, paymentMethod, rebuff, patientID
			FROM payments
			WHERE paymentID LIKE '%{$search}%'
			OR admissionDate LIKE '%{$search}%'
			OR releaseDate LIKE '%{$search}%'
			OR cost LIKE '%{$search}%'
			OR paymentMethod LIKE '%{$search}%'
			OR rebuff LIKE '%{$search}%'
			OR patientID LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'payments'";

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
	}

	// schedules
	$sql = "SELECT scheduleID, details, room, startTime, endTime, patientID
			FROM schedules
			WHERE scheduleID LIKE '%{$search}%'
			OR details LIKE '%{$search}%'
			OR room LIKE '%{$search}%'
			OR startTime LIKE '%{$search}%'
			OR endTime LIKE '%{$search}%'
			OR patientID LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'schedules'";

		// display in table form
		echo "
		<table>
			<tr>
				<th>scheduleID</th>
				<th>details</th>
				<th>room</th>
				<th>startTime</th>
				<th>endTime</th>
				<th>patientID</th>

				<th></th>
				<th></th>
			</tr>
		";
		while ($row = mysql_fetch_array($result)) {
			echo "
			<tr>
				<td>{$row['scheduleID']}</td>
				<td>{$row['details']}</td>
				<td>{$row['room']}</td>
				<td>{$row['startTime']}</td>
				<td>{$row['endTime']}</td>
				<td>{$row['patientID']}</td>
				<td><a href='recordedit.php?table=schedules&column=scheduleID&ID={$row['scheduleID']}'>Edit</td>
				<td><a href='recorddelete.php?table=schedules&column=scheduleID&ID={$row['scheduleID']}'>Delete</td>
			</tr>
			";
		}
		echo "</table>";
	}

	// staff
	$sql = "SELECT staffID, firstName, lastName, titles.title, password, specialties, photo
			FROM staff INNER JOIN titles ON staff.title = titles.titleID
			WHERE staffID LIKE '%{$search}%'
			OR firstName LIKE '%{$search}%'
			OR lastName LIKE '%{$search}%'
			OR titles.title LIKE '%{$search}%'
			OR password LIKE '%{$search}%'
			OR specialties LIKE '%{$search}%'
			OR photo LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'staff'";

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
	}

	// titles
	$sql = "SELECT titleID, title
			FROM titles
			WHERE titleID LIKE '%{$search}%'
			OR title LIKE '%{$search}%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0) {
		// add 1 to tables counter
		$tables++;

		// display number of results
		echo "Displaying {$count} result(s) in 'titles'";

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
	}

	// "No Results" check
	if ($tables == 0) {
		echo "There were no results.";
	}
?>
</div>

<?php
	include '../inc/footer.php';
?> 