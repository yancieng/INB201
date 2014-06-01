<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

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

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m4");</script>

<div class="leftContent">
	<?php
		// success and error messages go here
		if (isset($_SESSION['success'])) {
			echo "<p id='success'>" . $_SESSION['success'] . "</p>";
			unset($_SESSION['success']);
		}
		if (isset($_SESSION['error'])) {
			echo "<p id='error'>" . $_SESSION['error'] . "</p>";
			unset($_SESSION['error']);
		}
	?>
	<div class="box">
		<section class="boxTitle">
			<p>View/Update</p>
		</section>
		<!-- List of existing notes, link to view/update -->
		<section class="boxContent">
			<?php
				$staffID = $_SESSION['user'];
				$sql = "SELECT noteID, datetimeWritten, staffID
						FROM notes
						WHERE staffID = '$staffID'
						ORDER BY datetimeWritten DESC";
				$result = mysql_query($sql);
				$count = mysql_num_rows($result);

				if ($count > 0) {
					echo "<ul>";
					while ($row = mysql_fetch_assoc($result)) {
						// Link to notes.php with full note/edit
						echo "<li><a href='note.php?note={$row['noteID']}'>Note {$row['noteID']} - {$row['datetimeWritten']}</a></li>";
					}
					echo "</ul>";
				} else {
					echo "<p>No Notes currently in database.</p>";
				}
			?>
		</section>
	</div>

	<!-- Link to add a new note -->
	<br /><a href="noteadd.php"><button type="button" class="submit">Add a Note</button></a>
</div>


<?php
	include '../inc/footer.php';
?>