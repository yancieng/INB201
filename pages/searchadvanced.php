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
	// get parameter and value from form
	$parameter = mysql_escape_string($_GET['parameter']);
	$value = mysql_escape_string($_GET['value']);

	// if "Please Select" is not selected, show search results
	if ($parameter != "Please Select") {
		
		// else ifs / switches for each parameter (DOB, Height, Weight, Blood Type)
		switch ($parameter) {
			case "DOB":
				$sql = "SELECT patientID, firstName, lastName
						FROM patients
						WHERE DOB LIKE '%{$value}%'";
				break;

			case "Height":
				$sql = "SELECT patientID, firstName, lastName
						FROM patients INNER JOIN checkups USING (patientID)
						WHERE height LIKE '%{$value}%'";
				break;

			case "Weight":
				$sql = "SELECT patientID, firstName, lastName
						FROM patients INNER JOIN checkups USING (patientID)
						WHERE weight LIKE '%{$value}%'";
				break;

			case "Blood Type":
				$sql = "SELECT patientID, firstName, lastName
						FROM patients INNER JOIN checkups USING (patientID)
						WHERE bloodType LIKE '%{$value}%'";
				break;

			default:
				$sql = "SELECT patientID
						FROM patients
						WHERE patientID = 0";
				break;
		}

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
	} else {
		echo "<p>There were no results</p>";
	}	

?>


<?php
	include '../inc/footer.php';
?> 