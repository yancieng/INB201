<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Add Staff";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='staffmanager.php'>Staff Manager</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<script>activePanel("m2a");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 


<div class="leftContent">
	<?php
	// if error in staffaddprocess, show message
	if (isset($_SESSION['stafferror'])) {
		echo "<p id='error'>" . $_SESSION['stafferror'] . "</p>";
		unset($_SESSION['stafferror']);
	}
	?>
	<div class="box">
		<!-- Staff Form -->
		<section class="boxTitle">
			<p>Add Staff</p>
		</section>
		<section class="boxContent">
			<p>Fields marked with a * are required.</p>
			<form action="staffaddprocess.php" method="post" enctype="multipart/form-data">
				<div>
					<label for="firstName">*First Name: </label>
					<input type="text" class="textInput" name="firstName" required />
				</div>
				<div>
					<label for="lastName">*Last Name: </label>
					<input type="text" class="textInput" name="lastName" required />
				</div>
				<div>
					<label for="staffTitle">*Title: </label>
					<select name="staffTitle" >
						<option value="1">Doctor</option>
						<option value="2">Nurse</option>
						<option value="3">Medical Technician</option>
						<option value="4">Receptionist</option>
						<option value="5">Administrator</option>
					</select>
				</div>
				<div>
					<label for="password">*Password: </label>
					<input type="password" class="textInput" name="password" required />
				</div>
				<div>
					<label for="specialties">Specialties: </label>
					<input type="text" class="textInput" name="specialties" />
				</div>
				<div>
					<label for="photo">Photo: </label>
					<input type="file" name="photo" accept="image/*" />
				</div>
				<div>
					<button type="submit" class="submit">Add Information to Database</button>
				</div>
			</form>
		</section>
	</div>
</div>

 