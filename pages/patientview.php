<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Patient {$_GET['patient']}";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='patientsfinder.php'>Patients Finder</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2");</script>

<link type="text/css" rel="stylesheet" href="../css/patientview.css" media="screen" /> 

<?php
	$sql = "SELECT *
			FROM patients
			WHERE patientID = {$_GET['patient']}";
	$result = mysql_query($sql);
	$row = mysql_num_rows($result);

	$row = mysql_fetch_assoc($result); 

	$timestamp = strtotime($row['DOB']);
	$year = 2014- date("Y",$timestamp)
?>

<div class="box patientDetails">
		<section class="boxTitle">
			<p>Patient Details</p>
		</section>
		<section class="boxContent">
			<div class="textDetails">
				<img src="../images/none.png" alt="patient Picture">
				<p><span class="PatientName"><?php echo $row['firstName']." ". $row['lastName']; ?></span>
				</br><?php echo $year; ?> Years Old</br> (<?php echo $row['patientID']; ?>)</br> Bed: R302-02</p>
			</div>
			<div class="picDetails">
				<ul>
					<li class="tall"><img src="../images/height.png" alt=""><p class="info"><span class="infoLine1">112cm</span><br/> 2 days ago</p></li>
					<li class="weight"><img src="../images/weight.png" alt=""><p class="info"><span class="infoLine1">26kg</span><br/> 2 days ago</p></li>
					<li class="blood"><img src="../images/blood.png" alt=""><p class="info"><span class="infoLine1"><?php echo $row['bloodType']; ?></span><br/> 2 days ago</p></li>
				</ul>
			</div>
		</section>
</div>

<?php
	$sql2 = "SELECT *
			FROM guardians
			WHERE guardians.patientID={$_GET['patient']}";
	$result2 = mysql_query($sql2);
	$row2 = mysql_num_rows($result2);

	$row2 = mysql_fetch_assoc($result2); 
?>

<div class="box parentsDetails">
		<section class="boxTitle">
			<p>Parents or guardians contacts</p>
		</section>
		<section class="boxContent">
			<div class="parentPicture"><img src="../images/none.png" alt="parent Picture"></div>
			<div class="parentDetail">
				<div class="parentDetailLeft">
					<ul>
						<li>Name :</li>
						<li>Relation :</li>
						<li>Contact Number :</li>
						<li>E - mail :</li>
						<li>Address :</li>
					</ul>

				</div>
				<div class="parentDetailRight">
					<ul>
						<li><?php echo $row2['title']; ?> <?php echo $row2['firstName']; ?> <?php echo $row2['lastName']; ?></li>
						<li><?php echo $row2['relation']; ?></li>
						<li><?php echo $row2['contactNumber']; ?></li>
						<li><?php echo $row2['email']; ?></li>
						<li><?php echo $row2['address']; ?></li>
					</ul>
				</div>
			</div>
		</section>
</div>
<br/>
<?php
	$id = $_GET['patient'];
	$href = "updatePatient.php?patient=". $id;
	echo "<a href='".$href. "'><button type='submit' class='submit'>Update Information</button></a>"
?>


 