<?php
	// add "if already logged in" functionality
	$pageTitle = 'Login';
	include '../inc/header.php';
?>

<div  id="content">
	<div class="container">
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
			<!-- If incorrect username/password, display message -->
			<?php
				if(isset($_SESSION['loginerror']))
				{
				echo "<p id='error'>" . $_SESSION['loginerror'] . "</p>";
				unset($_SESSION['loginerror']);
				}
			?>
			<p>Forgot your password? <a href="#">Click here to reset it</a>.</p>
		</div>
	</div>
</div>

<?php
	include '../inc/footer.php';
?>