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

	$pageTitle = "Add Note";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='notes.php'>{$row['title']}'s Notes</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m4");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Add Note Page: form allowing user to add a note to the database -->

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
			<p>Add Note</p>
		</section>
		<section class="boxContent">
			<form action="noteaddprocess.php" method="post" enctype="multipart/form-data">
				<div>
					<label for="image">Image: </label>
					<input type="file" name="image" accept="image/*" />
				</div>
				<div>
					<label for="note">Note Text: </label>
					<textarea name="note"></textarea>
				</div>
				<div>
					<input type="hidden" name="staffID" value="<?php echo $_SESSION['user']; ?>" />
					<button type="submit" class="submit">Add to Database</button>
				</div>
			</form>
		</section>
	</div>
</div>

<?php
	include '../inc/footer.php';
?> 