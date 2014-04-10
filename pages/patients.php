<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}
	$pageTitle = "Patients";
	include '../inc/panel.php';
?>

<section>
	<div class="container">
		<div class="login">
			<!-- List of patients - integrate search function? sort by lastName -->
			<h1>Patient List</h1>
			<p><ul>
			<?php
				$sql = "SELECT patientID, firstName, lastName
						FROM patients
						ORDER BY lastName ASC";
				$result = mysql_query($sql);
				$row = mysql_num_rows($result);

				while ($row = mysql_fetch_assoc($result)) {
					echo "<li><a href='patientview.php?patient={$row['patientID']}'>{$row['lastName']}, {$row['firstName']}</a></li>";
				}
			?>
			</ul></p>
		</div>
	</div>
</section>

 