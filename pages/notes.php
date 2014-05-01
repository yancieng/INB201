<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	// sql to customise the page title depending on role
	$sql = "SELECT titles.title
			FROM staff INNER JOIN titles ON staff.title = titles.titleID
			WHERE staffID = {$_SESSION['user']}";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);

	$pageTitle = "{$row['title']}'s Notes";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<script type="text/javascript">
	function active() {

		var no = "m4"; //The coresponding active panal (the menu) of this page
		// change this number for each different page, or is there a better way?

		document.getElementById(no).className = ' active';
		document.getElementById(no).href = "#" ;
		document.getElementById(no).style.cursor = "default";
	}

</script>

<section>
	<div class="container">
		<h1>Notes</h1>
		<!-- Link to add a new note -->
		<h2><a href="#.html">Add a Note</a></h2>
		<!-- List of existing notes, link to view/update -->
		<h2>View/Update</h2>
		<ul>
		<?php
			$staffID = $_SESSION['user'];
			$sql = "SELECT noteID, datetimeWritten, patientID, staffID
					FROM notes
					WHERE staffID = '$staffID'";
			$result = mysql_query($sql);
			$row = mysql_num_rows($result);

			while ($row = mysql_fetch_assoc($result)) {
				// Link to notes.php with full note/edit
				// ?? how should this be laid out
				echo "<li><a href='note.php?note={$row['noteID']}'>Patient {$row['patientID']} - {$row['datetimeWritten']}</a></li>";
			}
		?>
		</ul>
	</div>
</section>

<?php
	include '../inc/footer.php';
?>