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
				<?php echo $row['photo']; ?>
				<p><span class="PatientName"><?php echo $row['firstName']." ". $row['lastName']; ?></span></br>
					<?php echo $year; ?> Years Old</br>
					(p<?php echo $row['patientID']; ?>)</br>
					Bed: R302-02</p>
			</div>
			<?php
				// looking up last height, weight and bloodtype. separate queries because all won't be updated each checkup?
				// current date used for "# days ago" calculations
				$current = new DateTime(date('Y-m-d H:i:s'));

				$sql = "SELECT height, timestamp
						FROM checkups
						WHERE patientID = {$_GET['patient']}
						AND height IS NOT NULL";
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);
				$height = $row['height'];
				$timestamp = new DateTime($row['timestamp']);
				$heightTime = $timestamp->diff($current);
				$heightTime = $heightTime->days;

				$sql = "SELECT weight, timestamp
						FROM checkups
						WHERE patientID = {$_GET['patient']}
						AND weight IS NOT NULL";
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);
				$weight = $row['weight'];
				$timestamp = new DateTime($row['timestamp']);
				$weightTime = $timestamp->diff($current);
				$weightTime = $weightTime->days;

				$sql = "SELECT bloodType, timestamp
						FROM checkups
						WHERE patientID = {$_GET['patient']}
						AND bloodType IS NOT NULL";
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);
				$bloodType = $row['bloodType'];
				$timestamp = new DateTime($row['timestamp']);
				$bloodTypeTime = $timestamp->diff($current);
				$bloodTypeTime = $bloodTypeTime->days;
			?>
			<div class="picDetails">
				<ul>
					<li class="tall"><img src="../images/height.png" alt=""><p class="info"><span class="infoLine1"><?php echo $height; ?></span><br/> <?php echo $heightTime; ?> days ago</p></li>
					<li class="weight"><img src="../images/weight.png" alt=""><p class="info"><span class="infoLine1"><?php echo $weight; ?></span><br/> <?php echo $weightTime; ?> days ago</p></li>
					<li class="blood"><img src="../images/blood.png" alt=""><p class="info"><span class="infoLine1"><?php echo $bloodType; ?></span><br/> <?php echo $bloodTypeTime; ?> days ago</p></li>
				</ul>
			</div>
		</section>
</div>

<div class="box parentsDetails">
		<section class="boxTitle">
			<p>Parents or guardians contacts</p>
		</section>
		<section class="boxContent">
			<?php
				$sql = "SELECT *
						FROM guardians INNER JOIN patients_guardians USING (guardianID)
						WHERE patientID = {$_GET['patient']}";
				$result = mysql_query($sql);
				$count = mysql_num_rows($result);

				// if guardian in database, display data. else display form for adding one?
				if ($count > 0) {
					$row = mysql_fetch_assoc($result);
					echo "
					<div class='parentPicture'>{$row['photo']}</div>
					<div class='parentDetail'>
						<div class='parentDetailLeft'>
							<ul>
								<li>Name :</li>
								<li>Relation :</li>
								<li>Contact Number :</li>
								<li>E - mail :</li>
								<li>Address :</li>
							</ul>

						</div>
						<div class='parentDetailRight'>
							<ul>
								<li>{$row['title']} {$row['firstName']} {$row['lastName']}</li>
								<li>{$row['relation']}</li>
								<li>{$row['contactNumber']}</li>
								<li>{$row['email']}</li>
								<li>{$row['address']}</li>
							</ul>
						</div>
					</div>";
				} else {
					echo "No Guardian currently assigned.";
				}
			?>
		</section>
</div>
<br/>
<?php
	$id = $_GET['patient'];
	$href = "patientupdate.php?patient=". $id;
	echo "<a href='".$href. "'><button type='submit' class='submit'>Update Information</button></a>"
?>


 