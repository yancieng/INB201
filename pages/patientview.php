<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Patient {$_GET['patient']}";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='patientsfinder.php'>Patients Finder</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<script type="text/javascript">
	function active() {

		var no = "m2"; //The coresponding active panal (the menu) of this page
		// change this number for each different page, or is there a better way?

		document.getElementById(no).className = ' active';
		document.getElementById(no).href = "patientsfinder.php" ;
		document.getElementById(no).style.cursor = "pointer";
	}

</script>

<section>
	<div class="container">
		<?php
			// if patient has just been added, show message
			if (isset($_SESSION['patientsuccess'])) {
				echo "<p id='success'>" . $_SESSION['patientsuccess'] . "</p>";
				unset($_SESSION['patientsuccess']);
			}
			// if editing fails, show message
			if (isset($_SESSION['patienterror'])) {
				echo "<p id='error'>" . $_SESSION['patienterror'] . "</p>";
				unset($_SESSION['patienterror']);
			}
		?>
		<div class="login">
			<!-- Full patient info page. Can edit info if authorised (receptionist, etc.) ?? how -->
			<h1>Patient <?php echo $_GET['patient']; ?></h1>
			<!-- Form layout? if authorised, else just show info -->
			<?php
				$sql = "SELECT *
						FROM patients
						WHERE patientID = {$_GET['patient']}";
				$result = mysql_query($sql);
				$row = mysql_num_rows($result);

				while ($row = mysql_fetch_assoc($result)) {
					echo "<div id='patient'>";
						echo "<form action='patientupdateprocess.php' method='post'>";
							echo "<div>";
								echo "<label for='firstName'>First Name: </label>";
								echo "<input type='text' name='firstName' id='firstName' value='{$row['firstName']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='lastName'>Last Name: </label>";
								echo "<input type='text' name='lastName' id='lastName' value='{$row['lastName']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='DOB'>DOB: </label>";
								echo "<input type='text' name='DOB' id='DOB' value='{$row['DOB']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='bloodType'>Blood Type: </label>";
								echo "<select name='bloodType'>
										<option value='{$row['bloodType']}'>Default: {$row['bloodType']}</option>
										<option>O+</option>
										<option>O-</option>
										<option>A+</option>
										<option>A-</option>
										<option>B+</option>
										<option>B-</option>
										<option>AB+</option>
										<option>AB-</option>
									</select>";
							echo "</div>";
							echo "<div>";
								echo "<label for='previousNotes'>Previous Notes: </label>";
								echo "<textarea name='previousNotes' id='previousNotes' cols='32' rows='5'>{$row['previousNotes']}</textarea>";
							echo "</div>";
							echo "<div>";
								// hidden field with patientID
								echo "<input type='hidden' name='patientID' value='{$row['patientID']}' />";
								echo "<button type='submit' class='submit'>Update Information</button>";
							echo "</div>";
						echo "</form>";
					echo "</div>";
				}
			?>
		</div>
	</div>
</section>

 