<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Staff {$_GET['staff']}";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='staff.php'>Staff</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<section>
	<div class="container">
		<?php
			// if staff has just been added, show message
			if (isset($_SESSION['staffsuccess'])) {
				echo "<p id='success'>" . $_SESSION['staffsuccess'] . "</p>";
				unset($_SESSION['staffsuccess']);
			}
			// if editing fails, show message
			if (isset($_SESSION['stafferror'])) {
				echo "<p id='error'>" . $_SESSION['stafferror'] . "</p>";
				unset($_SESSION['stafferror']);
			}
		?>
		<div class="login">
			<!-- Full staff info page. Can edit info if authorised (admin) -->
			<h1>Staff <?php echo $_GET['staff']; ?></h1>
			<?php
				$sql = "SELECT staffID, firstName, lastName, title
						FROM staff
						WHERE staffID = {$_GET['staff']}";
				$result = mysql_query($sql);
				$row = mysql_num_rows($result);

				while ($row = mysql_fetch_assoc($result)) {
					echo "<div id='staff'>";
						echo "<form action='staffupdateprocess.php' method='post'>";
							echo "<div>";
								echo "<label for='firstName'>*First Name: </label>";
								echo "<input type='text' name='firstName' id='firstName' value='{$row['firstName']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='lastName'>*Last Name: </label>";
								echo "<input type='text' name='lastName' id='lastName' value='{$row['lastName']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='staffTitle'>*Title: </label>";
								echo "<select name='staffTitle' id='staffTitle'>";
									// if statements for default selection
									if ($row['title'] == 1) {
										echo "<option value='1' selected='selected'>Doctor</option>";
									} else {
										echo "<option value='1'>Doctor</option>";
									}
									if ($row['title'] == 2) {
										echo "<option value='2' selected='selected'>Nurse</option>";
									} else {
										echo "<option value='2'>Nurse</option>";
									}
									if ($row['title'] == 3) {
										echo "<option value='3' selected='selected'>Medical Technician</option>";
									} else {
										echo "<option value='3'>Medical Technician</option>";
									}
									if ($row['title'] == 4) {
										echo "<option value='4' selected='selected'>Receptionist</option>";
									} else {
										echo "<option value='4'>Receptionist</option>";
									}
									if ($row['title'] == 5) {
										echo "<option value='5' selected='selected'>Administrator</option>";
									} else {
										echo "<option value='5'>Administrator</option>";
									}
								echo "</select>";
							echo "</div>";
							echo "<div>";
								// hidden field with staffID
								echo "<input type='hidden' name='staffID' value='{$row['staffID']}' />";
								echo "<button type='submit' class='submit'>Update Information</button>";
							echo "</div>";
						echo "</form>";
					echo "</div>";
				}
			?>
		</div>
	</div>
</section>

 