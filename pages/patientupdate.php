<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Updating Patient {$_GET['patient']}";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='patientsfinder.php'>Patients Finder</a> > <a href='patientview.php?patient={$_GET['patient']}'>Patient {$_GET['patient']}</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2");</script>

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

<!-- Page used to update patient info and guardian -->

<!-- Patient Info -->
<div class="box">
	<section class="boxTitle">
		<p>Patient <?php echo $_GET['patient']; ?></p>
	</section>
	<section class="boxContent">
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
							echo "<input type='text' name='firstName' value='{$row['firstName']}' required />";
						echo "</div>";
						echo "<div>";
							echo "<label for='lastName'>Last Name: </label>";
							echo "<input type='text' name='lastName' value='{$row['lastName']}' required />";
						echo "</div>";
						echo "<div>";
							echo "<label for='DOB'>DOB: </label>";
							echo "<input type='text' name='DOB' value='{$row['DOB']}' required />";
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
	</section>
</div>

<!-- Guardian Info -->
<div class="box">
	<section class="boxTitle">
		<p>Guardian Info</p>
	</section>
	<section class="boxContent">
		<?php
			// sql for getting guardian info. if none found, have a form for using existing / adding a new one?
			$sql = "SELECT *
					FROM guardians INNER JOIN patients_guardians USING (guardianID)
					WHERE patientID = {$_GET['patient']}";
			$result = mysql_query($sql);
			$count = mysql_num_rows($result);

			if ($count > 0) {
				// display info as form
				$row = mysql_fetch_assoc($result);

				echo "
				<form action='guardianupdateprocess.php' method='post'>
					<div>
						<label for='firstName'>First Name: </label>
						<input type='text' name='firstName' value='{$row['firstName']}' required />
					</div>
					<div>
						<label for='lastName'>Last Name: </label>
						<input type='text' name='lastName' value='{$row['lastName']}' required />
					</div>
					<div>
						<label for='title'>Title: </label>
						<select name='title'>
							<option>{$row['title']}</option>
							<option>Mr.</option>
							<option>Mrs.</option>
							<option>Miss</option>
							<option>Ms.</option>
						</select>
					</div>
					<div>
						<label for='relation'>Relation: </label>
						<input type='text' name='relation' value='{$row['relation']}' required />
					</div>
					<div>
						<label for='contactNumber'>Contact Number: </label>
						<input type='text' name='contactNumber' value='{$row['contactNumber']}' required />
					</div>
					<div>
						<label for='email'>Email: </label>
						<input type='text' name='email' value='{$row['email']}' required />
					</div>
					<div>
						<label for='address'>Address: </label>
						<input type='text' name='address' value='{$row['address']}' required />
					</div>
					<div>
						<label for='photo'>Photo: </label>
						<input type='file' name='photo' accept='image/*' />
					</div>
					<div>
						<input type='hidden' name='guardianID' value='{$row['guardianID']}' />
						<input type='hidden' name='patientID' value='{$_GET['patient']}' />
						<button type='submit' class='submit'>Update Information</button>
					</div>
				</form>
				";
			} else {
				// display blank form to add a guardian?
				echo "
				<form action='guardianaddprocess.php' method='post'>
					<div>
						<label for='firstName'>First Name: </label>
						<input type='text' name='firstName' required />
					</div>
					<div>
						<label for='lastName'>Last Name: </label>
						<input type='text' name='lastName' required />
					</div>
					<div>
						<label for='title'>Title: </label>
						<select name='title'>
							<option>Mr.</option>
							<option>Mrs.</option>
							<option>Miss</option>
							<option>Ms.</option>
						</select>
					</div>
					<div>
						<label for='relation'>Relation: </label>
						<input type='text' name='relation' required />
					</div>
					<div>
						<label for='contactNumber'>Contact Number: </label>
						<input type='text' name='contactNumber' required />
					</div>
					<div>
						<label for='email'>Email: </label>
						<input type='text' name='email' required />
					</div>
					<div>
						<label for='address'>Address: </label>
						<input type='text' name='address' required />
					</div>
					<div>
						<label for='photo'>Photo: </label>
						<input type='file' name='photo' accept='image/*' />
					</div>
					<div>
						<input type='hidden' name='patientID' value='{$_GET['patient']}' />
						<button type='submit' class='submit'>Add Guardian</button>
					</div>
				</form>
				";
			}
		?>
	</section>
</div>

<?php
	include '../inc/footer.php';
?>