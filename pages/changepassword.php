<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Change Password";
	include '../inc/header.php';
?>

<section>
	<div class="container">
		<?php
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
		?>
		<div class="login">
			<!-- Change Password page -->
			<h1>Change Password</h1
			<div id="changepassword">
				<form action="changepasswordprocess.php" method="post">
					<div>
						<label for="currentpassword">Current Password: </label>
						<input type="password" name="currentpassword" id="currentpassword" required />
					</div>
					<div>
						<label for="newpassword">New Password: </label>
						<input type="password" name="newpassword" id="newpassword" required />
					</div>
					<div>
						<label for="newpasswordconfirm">Password Confirm: </label>
						<input type="password" name="newpasswordconfirm" id="newpasswordconfirm" required />
					</div>
					<div>
						<button type="submit" class="submit">Change Password</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php
	include '../inc/footer.php';
?>