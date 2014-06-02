<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	// get noteID from previous page
	$noteID = mysql_escape_string($_GET['note']);

	// sql to customise the page title depending on role
	$sql = "SELECT titles.title
			FROM staff INNER JOIN titles ON staff.title = titles.titleID
			WHERE staffID = {$_SESSION['user']}";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);

	$pageTitle = "Note {$noteID}";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='notes.php'>{$row['title']}'s Notes</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m4");</script>

<!-- Note View Page: Shows the note in full -->

<?php
// get note details
$sql = "SELECT noteID, datetimeWritten, note, image, staffID
		FROM notes
		WHERE noteID = '{$noteID}'";
$result = mysql_query($sql);
$count = mysql_num_rows($result);

if ($count > 0) {
	$row = mysql_fetch_assoc($result);
	$note = nl2br($row['note']);

	echo "
	<div class='leftContent'>
		<div class='box'>
			<section class='boxTitle'>
				<p>Note {$row['noteID']}</p>
			</section>
			<section class='boxContent'>
				<h2>Text:</h2>
				<p>{$note}</p>";
				
				if ($row['image'] != '' || $row['image'] != NULL) {
					echo "
					<h2>Image:</h2>
					{$row['image']}
					";
				}

			echo "
			</section>
		</div>
	</div>
	";

} else {
	echo "<p>No note with that ID was found.</p>";
}
?>


<?php
	include '../inc/footer.php';
?> 