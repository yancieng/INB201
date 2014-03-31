<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = 'You must be logged in to access this resource.';
		header ("Location: login.php");
	}
	$pageTitle = 'Home';
	include '../inc/header.php';
?>

<section>
	<div class="container">
		<div class="login">
			<h1>Yo, <?php echo $_SESSION['name']; ?>.</h1>
			<p>Here's an example homepage until we've figured everything out.</p>
			<p>
			<?php
				$staffID = $_SESSION['user'];
				$sql = "SELECT staffID, title
						FROM staff
						WHERE staffID = '$staffID'";
				$result = mysql_query($sql);
				$count = mysql_num_rows($result);
				$row = mysql_fetch_assoc($result);

				if ($row['title'] == 1) { // Doctor
					echo '<li><a href="#.html">Doctor\'s notes</a>';
				} else if ($row['title'] == 2) { // Nurse
					echo '<li><a href="#.html">Nurses Observations</a>';
				} else if ($row['title'] == 3) { // Medical Technician
					echo '<li><a href="#.html">X-rays</a>';
					echo '<li><a href="#.html">Test Results</a>';
				} else if ($row['title'] == 4) { // Receptionist
					echo '<li><a href="#.html">Add a patient</a>';
					echo '<li><a href="#.html">Update patient info</a>';
				} else if ($row['title'] == 5) { // Administrator
					echo '<li><a href="#.html">Add a staff member</a>';
					echo '<li><a href="#.html">Update staff info</a>';
				}
			?>
			</p>
		</div>
	</div>
</section>

<?php
	include '../inc/footer.php';
?>