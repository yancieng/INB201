<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Admit New Patient";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2a");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Content goes below -->
<!-- Admit New Patient Page: adds a new patient to the database, and at the same time, adds admission date to payments -->

<div class="leftContent">
	<?php
		// if error in patientaddprocess, show message
		if (isset($_SESSION['error'])) {
			echo "<p id='error'>" . $_SESSION['error'] . "</p>";
			unset($_SESSION['error']);
		}
	?>
	<div class="box">
		<section class="boxTitle">
			<p>Admit New Patient</p>
		</section>
		<section class="boxContent">
			<!-- Patient Form -->
			<form action="patientaddprocess.php" method="post">
				<div>
					<label for="firstName">First Name: </label>
					<input class="textInput" type="text" name="firstName" required />
				</div>
				<div>
					<label for="lastName">Last Name: </label>
					<input class="textInput" type="text" name="lastName" required />
				</div>
				<div>
					<label for="DOB">DOB: </label>
					<input class="textInput" type="text" name="DOB" placeholder="YYYY-MM-DD" required />
				</div>
				<div>
					<label for="photo">Photo: </label>
					<input type="file" name="photo" accept="image/*" />
				</div>
				<div>
					<label for="admissionDate">Admission Date: </label>
					<input class="textInput" type="text" name="admissionDate" value="<?php echo date("Y-m-d"); ?>" required />
				<div>
					<button type="submit" class="submit">Add Information to Database</button>
				</div>
			</form>
		</section>
	</div>
</div>

<?php
	include '../inc/footer.php';
?> 