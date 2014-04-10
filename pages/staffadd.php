<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Add Staff";
	include '../inc/header.php';
?>

<section>
	<div class="container">
		<?php
			// if error in staffaddprocess, show message
			if (isset($_SESSION['stafferror'])) {
				echo "<p id='error'>" . $_SESSION['stafferror'] . "</p>";
				unset($_SESSION['stafferror']);
			}
		?>
		<div class="login">
			<!-- Staff Form -->
			<h1>Add Staff</h1>
			<p>Fields marked with a * are required.</p>
			<div id="staff">
				<form action="staffaddprocess.php" method="post">
					<div>
						<label for="firstName">*First Name: </label>
						<input type="text" name="firstName" id="firstName" required />
					</div>
					<div>
						<label for="lastName">*Last Name: </label>
						<input type="text" name="lastName" id="lastName" required />
					</div>
					<div>
						<label for="staffTitle">*Title: </label>
						<select name="staffTitle" id="staffTitle">
							<option value="1">Doctor</option>
							<option value="2">Nurse</option>
							<option value="3">Medical Technician</option>
							<option value="4">Receptionist</option>
							<option value="5">Administrator</option>
						</select>
					</div>
					<div>
						<label for="password">*Password: </label>
						<input type="password" name="password" id="password" required />
					</div>
					<div>
						<button type="submit" class="submit">Add Information to Database</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php
	include '../inc/footer.php';
?>