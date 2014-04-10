<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}
	$pageTitle = "Staff";
	include '../inc/panel.php';
?>

<section>
	<div class="container">
		<div class="login">
			<!-- List of staff - integrate search function? sort by lastName -->
			<h1>Patient List</h1>
			<p><ul>
			<?php
				$sql = "SELECT staffID, firstName, lastName
						FROM staff
						ORDER BY lastName ASC";
				$result = mysql_query($sql);
				$row = mysql_num_rows($result);

				while ($row = mysql_fetch_assoc($result)) {
					echo "<li><a href='staffview.php?staff={$row['staffID']}'>{$row['lastName']}, {$row['firstName']}</a></li>";
				}
			?>
			</ul></p>
		</div>
	</div>
</section>

 