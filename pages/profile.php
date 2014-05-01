<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Profile";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<script type="text/javascript">
	function active() {

		var no = "m1"; //The coresponding active panal (the menu) of this page
		// change this number for each different page, or is there a better way?

		document.getElementById(no).className = ' active';
		document.getElementById(no).href = "home.php" ;
		document.getElementById(no).style.cursor = "pointer";
	}

</script>

<!-- Content goes below -->
<!-- Profile page. Used to change personal information, photo, password -->

<!-- Layout
	Photo to the left
	StaffID
	Name
	Title
	Specialties
-->

<?php
	// sql to get staff info
	$sql = "SELECT staffID, firstName, lastName, titles.title, password, specialties, photo
			FROM staff INNER JOIN titles ON staff.title = titles.titleID
			WHERE staffID = {$_SESSION['user']}";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);

	echo "<div id='staffInfo'>
		<h2>Your Information</h2>
		<div>
			{$row['photo']}
		</div>
		<div>
			<ul>
				<li>StaffID: {$row['staffID']}</li>
				<li>Name: {$row['firstName']} {$row['lastName']}</li>
				<li>Title: {$row['title']}</li>
				<li>Specialties: {$row['specialties']}</li>
			</ul>
		</div>
	</div>";

	echo "<div id='staffEdit'>
		<h2>Edit Information</h2>";
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
		echo "<form action='profileupdateprocess.php' method='post'>
			<div>
				<label for='firstName'>First Name: </label>
				<input type='text' name='firstName' value='{$row['firstName']}' />
			</div>
			<div>
				<label for='lastName'>Last Name: </label>
				<input type='text' name='lastName' value='{$row['lastName']}' />
			</div>
			<div>
				<label for='specialties'>Specialties: </label>
				<input type='text' name='specialties' value='{$row['specialties']}' />
			</div>
			<div>
				<label for='photo'>Photo: </label>
				<input type='file' name='photo' />
			</div>
			<div>
				<input type='hidden' name='staffID' value='{$row['staffID']}' />
				<button type='submit'>Update Information</button>
			</div>
		</form>
	</div>";

	echo "<div id='changepassword'>
		<h2>Change Password</h2>";
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
		echo "<form action='changepasswordprocess.php' method='post'>
			<div>
				<label for='currentpassword'>Current: </label>
				<input type='password' name='currentpassword' id='currentpassword' required />
			</div>
			<div>
				<label for='newpassword'>New: </label>
				<input type='password' name='newpassword' id='newpassword' required />
			</div>
			<div>
				<label for='newpasswordconfirm'>Confirm: </label>
				<input type='password' name='newpasswordconfirm' id='newpasswordconfirm' required />
			</div>
			<div>
				<button type='submit' class='submit'>Change Password</button>
			</div>
		</form>
	</div>";
?>

<?php
	include '../inc/footer.php';
?> 