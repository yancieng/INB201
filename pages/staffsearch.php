<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	// get staffID if set
	if (isset($_GET['staffID'])) {
		$staffID = mysql_escape_string($_GET['staffID']);
	}

	// search for staffID, then redirect to page or set "No Results"
	if (isset($staffID) && $staffID != '') {
		$sql = "SELECT staffID
				FROM staff
				WHERE staffID = {$staffID}";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		if ($count == 1) {
			$row = mysql_fetch_assoc($result);
			header ("Location: staffview.php?staff={$row['staffID']}");
		} else {
			$_SESSION['searcherror'] = "There were no results for that staff ID.";
		}
	}

	$pageTitle = "Staff Search";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='staffmanager.php'>Staff Manager</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<script type="text/javascript">
	function active() {

		// var no = "m#"; //The coresponding active panal (the menu) of this page
		// change this number for each different page, or is there a better way?

		document.getElementById(no).className = ' active';
		document.getElementById(no).href = "#" ;
		document.getElementById(no).style.cursor = "default";
	}

</script>

<!-- Content goes below -->
<!-- Staff Search Results: Page displays links to staffview.php (for the moment) -->
<!-- PHP for: showall, name, title -->
<?php
	// if no results for staffID, show message
	if (isset($_SESSION['searcherror'])) {
		echo "<p>" . $_SESSION['searcherror'] . "</p>";
		unset($_SESSION['searcherror']);
	} else {
		// get info from form (if used)
		if (isset($_GET['staffID'])) {
			$name = mysql_escape_string($_GET['name']);
			$title = mysql_escape_string($_GET['title']);
		}
		// get showall if link was used
		if (isset($_GET['showall'])) {
			$showall = mysql_escape_string($_GET['showall']);
		}

		// separate checks for each search
		// name
		if (isset($name) && $name != '') {
			$sql = "SELECT staffID, firstName, lastName, titles.title
					FROM staff INNER JOIN titles ON staff.title = titles.titleID
					WHERE firstName LIKE '%{$name}%'
					OR lastName LIKE '%{$name}%'";
		} else if (isset($title) && $title != '') {
			$sql = "SELECT staffID, firstName, lastName, titles.title
					FROM staff INNER JOIN titles ON staff.title = titles.titleID
					WHERE staff.title = {$title}";
		} else if (isset($showall) && $showall == 1) {
			$sql = "SELECT staffID, firstName, lastName, titles.title
					FROM staff INNER JOIN titles ON staff.title = titles.titleID";
		}
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		if ($count != 0) {
			echo "<ul>";
			while ($row = mysql_fetch_array($result)) {
				echo "<li><a href='staffview.php?staff={$row['staffID']}'>{$row['staffID']} - {$row['lastName']}, {$row['firstName']} - {$row['title']}";
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