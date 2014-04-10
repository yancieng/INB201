<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, or is not a doctor, redirect to login.php with error message
	if (isset($_SESSION['user'])) {
		$staffID = $_SESSION['user'];
		$sql = "SELECT staffID, title
				FROM staff
				WHERE staffID = '$staffID'
				AND title = 1";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		if ($count == 0) {
			$_SESSION['roleerror'] = "You are not authorised to access this resource.";
			header ("Location: home.php");
		}
	} else {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Doctor's Notes";
	include '../inc/panel.php';
?>

<section>
	<div class="container">
		<div class="login">
			<h1>Doctor's Notes</h1>
			<!-- Link to add a new note -->
			<h2><a href="#.html">Add a Note</a></h2>
			<!-- List of existing notes, link to view/update -->
			<h2>View/Update</h2>
			<p><ul>
			<?php
				$staffID = $_SESSION['user'];
				$sql = "SELECT noteID, datetimeWritten, patientID, staffID
						FROM notes
						WHERE staffID = '$staffID'";
				$result = mysql_query($sql);
				$row = mysql_num_rows($result);

				while ($row = mysql_fetch_assoc($result)) {
					// Link to notes.php with full note/edit
					// ?? how should this be laid out
					echo "<li><a href='note.php?note={$row['noteID']}'>Patient {$row['patientID']} - {$row['datetimeWritten']}</a></li>";
				}
			?>
			</ul></p>
		</div>
	</div>
</section>

 