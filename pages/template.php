<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	// $pageTitle = "Untitled Page";
	// $breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>// activePanel("m2");</script>

<!-- Content goes below -->

<div class="leftContent">
	<div class="box">
		<section class="boxTitle">
			<p></p>
		</section>
		<section class="boxContent">
			
		</section>
	</div>
</div>

<?php
	include '../inc/footer.php';
?> 