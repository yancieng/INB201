<?php
	include '../inc/dbconnect.php';
	// add "if already logged in" functionality
	if (isset($_SESSION['user'])) {
		header("Location: home.php");
	}
	$pageTitle = "Login";
	include '../inc/header.php';
?>

<section>
	<div class="container">
		<?php
			// if incorrect login credentials, show message
			if (isset($_SESSION['loginerror'])) {
				echo "<p id='error'>" . $_SESSION['loginerror'] . "</p>";
				unset($_SESSION['loginerror']);
			}
			// when logged out, display message
			if (isset($_SESSION['logout'])) {
				echo "<p id='success'>" . $_SESSION['logout'] . "</p>";
				unset($_SESSION['logout']);
			}
		?>
		<div class="login">
			
			<h1>Login</h1>
			<form method="post" action="loginprocess.php">
				<p><input type="text" name="staffID" value="" placeholder="StaffID"></p>
				<p><input type="password" name="password" value="" placeholder="Password"></p>
				<p class="remember_me">
					<label>
						<label>
							<input type="checkbox" name="remember_me" id="remember_me">
							Remember me on this computer
						</label>
					</label>
				</p>
				<p class="submit"><input type="submit" name="commit" value="Login"></p>
			</form>
		</div>

		<div class="login-help">
			<p>Forgot your password? <a href="#">Click here to reset it</a>.</p>
		</div>
	</div>
</section>

<?php
	include '../inc/footer.php';
?>