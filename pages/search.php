<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Search Results";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='patientsfinder.php'>Patients Finder</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<script type="text/javascript">
	function active() {

		var no = "m2"; //The coresponding active panal (the menu) of this page
		// change this number for each different page, or is there a better way?

		document.getElementById(no).className = ' active';
		document.getElementById(no).href = "patientsfinder.php" ;
		document.getElementById(no).style.cursor = "pointer";
	}

</script>

<!-- Content goes below -->
<h1>Search Results</h1>
<?php
	// if no results, show message
	if (isset($_SESSION['searcherror'])) {
		echo "<p id='error'>" . $_SESSION['searcherror'] . "</p>";
		unset($_SESSION['searcherror']);
	} else {
		// show search results
		if (isset($_GET['name'])) {
			$sql = "SELECT patientID, firstName, lastName
					FROM patients
					WHERE firstName LIKE '%{$_GET['name']}%'
					OR lastName LIKE '%{$_GET['name']}%'
					ORDER BY lastName ASC";
		} else if (isset($_GET['phone'])) {
			$sql = "SELECT patientID, firstName, lastName
					FROM patients
					WHERE contactNumber LIKE '%{$_GET['phone']}%'
					ORDER BY lastName ASC";
		}
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		if ($count != 0) {
			while ($row = mysql_fetch_assoc($result)) {
				echo "<li><a href='patientview.php?patient={$row['patientID']}'>{$row['lastName']}, {$row['firstName']}</a></li>";
			}
		} else {
			echo "There were no results.";
		}
	}
?>


<?php
	include '../inc/footer.php';
?> 