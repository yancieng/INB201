<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Profile";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m1");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Profile page. Used to change personal information, photo, password
	Photo to the left
	StaffID
	Name
	Title
	Specialties
-->

<div class="leftContent">
	<?php
	// sql to get staff info
	$sql = "SELECT staffID, firstName, lastName, titles.title, password, specialties, photo
			FROM staff INNER JOIN titles ON staff.title = titles.titleID
			WHERE staffID = {$_SESSION['user']}";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);

	echo "
	<div class='box' id='staffInfo'>
		<section class='boxTitle'>
			<p>Your Information</p>
		</section>
		<section class='boxContent'>
			<div>
				{$row['photo']}
			</div>
			<div>
				<p>
				StaffID: {$row['staffID']}<br />
				Name: {$row['firstName']} {$row['lastName']}<br />
				Title: {$row['title']}<br />
				Specialties: {$row['specialties']}<br />
				</p>
			</div>
		</section>
	</div>";

	// if information has been updated, show message
	if (isset($_SESSION['staffsuccess'])) {
		echo "<p id='success'>" . $_SESSION['staffsuccess'] . "</p>";
		unset($_SESSION['staffsuccess']);
	}
	// if editing fails, show message
	if (isset($_SESSION['stafferror'])) {
		echo "<p id='error'>" . $_SESSION['stafferror'] . "</p>";
		unset($_SESSION['stafferror']);
	}

	echo "
	<div class='box'>
		<section class='boxTitle'>
			<p>Edit Information</p>
		</section>
		<section class='boxContent'>
			<form action='profileupdateprocess.php' method='post' enctype='multipart/form-data'>
				<div>
					<label for='firstName'>First Name: </label>
					<input class='textInput' type='text' name='firstName' value='{$row['firstName']}' required />
				</div>
				<div>
					<label for='lastName'>Last Name: </label>
					<input class='textInput' type='text' name='lastName' value='{$row['lastName']}' required />
				</div>
				<div>
					<label for='specialties'>Specialties: </label>
					<input class='textInput' type='text' name='specialties' value='{$row['specialties']}' />
				</div>
				<div>
					<label for='photo'>Photo: </label>
					<input type='file' name='photo' accept='image/*' />
				</div>
				<div>
					<input type='hidden' name='staffID' value='{$row['staffID']}' />
					<button type='submit' class='submit'>Update Information</button>
				</div>
			</form>
		</section>
	</div>";

	// if password change succeeds, show message
	if (isset($_SESSION['passwordsuccess'])) {
		echo "<p id='success'>" . $_SESSION['passwordsuccess'] . "</p>";
		unset($_SESSION['passwordsuccess']);
	}
	// if password change fails, show message
	if (isset($_SESSION['passworderror'])) {
		echo "<p id='error'>" . $_SESSION['passworderror'] . "</p>";
		unset($_SESSION['passworderror']);
	}

	echo "
	<div class='box'>
		<section class='boxTitle'>
			<p>Change Password</p>
		</section>
		<section class='boxContent'>
			<form action='changepasswordprocess.php' method='post'>
				<div>
					<label for='currentpassword'>Current: </label>
					<input class='textInput' type='password' name='currentpassword' required />
				</div>
				<div>
					<label for='newpassword'>New: </label>
					<input class='textInput' type='password' name='newpassword' required />
				</div>
				<div>
					<label for='newpasswordconfirm'>Confirm: </label>
					<input class='textInput' type='password' name='newpasswordconfirm' required />
				</div>
				<div>
					<button type='submit' class='submit'>Change Password</button>
				</div>
			</form>
		</section>
	</div>";
	?>
</div>

<?php
	include '../inc/footer.php';
?> 