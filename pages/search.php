<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Search Results";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='patientsfinder.php'>Patients Finder</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2");</script>


<!-- Content goes below -->
<h1>Search Results</h1>
<?php
	// if no results, show message
	if (isset($_SESSION['searcherror'])) {
		echo "<p id='error'>" . $_SESSION['searcherror'] . "</p>";
		unset($_SESSION['searcherror']);
	} else {
		// show search results
		if (isset($_GET['firstName'])) {
			$sql = "SELECT patientID, firstName, lastName
					FROM patients
					WHERE firstName LIKE '%{$_GET['firstName']}%'
					ORDER BY lastName ASC";
		} else if (isset($_GET['lastName'])) {
			$sql = "SELECT patientID, firstName, lastName
					FROM patients
					WHERE lastName LIKE '%{$_GET['lastName']}%'
					ORDER BY lastName ASC";
		} else {
			$sql = "SELECT patientID
					FROM patients
					WHERE patientID = 0";
		}
		/*else if (isset($_GET['phone'])) {
			$sql = "SELECT patientID, firstName, lastName
					FROM patients
					WHERE contactNumber LIKE '%{$_GET['phone']}%'
					ORDER BY lastName ASC";
		}*/
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		if ($count != 0) {
			echo "<ul>";
			while ($row = mysql_fetch_assoc($result)) {
				echo "<li><a href='patientview.php?patient={$row['patientID']}'>{$row['lastName']}, {$row['firstName']}</a></li>";
			}
			echo "</ul>";
		} else {
			echo "<p>There were no results.</p>";
		}
	}
?>


<?php
	include '../inc/footer.php';
?> 