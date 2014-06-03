<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	// GET patient
	$patient = mysql_escape_string($_GET['patient']);

	$pageTitle = "Patient {$patient}";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='patientsfinder.php'>Patients Finder</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>
activePanel("m2");
active = "1";
function observation(numb){
	if(numb!=active){
		document.getElementById("n"+numb).className="active";
		document.getElementById("n"+active).className="";
		document.getElementById("o"+numb).style.display = "block";
		document.getElementById("o"+active).style.display = "none";
		active = numb;
	}
}

</script>

<link type="text/css" rel="stylesheet" href="../css/patientview.css" media="screen" /> 

<?php
	$sql = "SELECT *
			FROM patients
			LEFT OUTER JOIN beds USING (patientID)
			WHERE patientID = {$patient}";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);

	$timestamp = strtotime($row['DOB']);
	$year = 2014- date("Y",$timestamp);

	if ($row['bedNumber'] != NULL) {
		$bed = $row['bedNumber'];
	} else {
		$bed = "Not currently assigned";
	}
?>
<div id="details">
	<div class="almostfullContent">

		<!-- Patient Details box -->

		<div class="box patientDetails">
			<section class="boxTitle">
				<p>Patient Details</p>
			</section>
			<section class="boxContent">
				<div class="textDetails">
					<?php echo $row['photo']; ?>
					<p><span class="PatientName" id="patientName"><?php echo $row['firstName']." ". $row['lastName']; ?></span></br>
						<span><?php echo $year; ?> Years Old</span><span style="display:none;" id="patientAge"><?php echo $row['DOB']; ?></span></br>
						(p<span id="patientID"><?php echo $row['patientID']; ?></span>)</br>
						Bed: <?php echo $bed ?></p>
				</div>
				<?php
					// looking up last height, weight and bloodtype. separate queries because all won't be updated each checkup?
					// current date used for "# days ago" calculations
					$current = new DateTime(date('Y-m-d H:i:s'));

					// Height
					$sql = "SELECT height, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND height IS NOT NULL
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$count = mysql_num_rows($result);
					if ($count == 0) {
						$height = '?';
					} else {
						$height = $row['height'];
					}
					$timestamp = new DateTime($row['timestamp']);
					$heightTime = $timestamp->diff($current);
					$heightTime = $heightTime->days;

					// Weight
					$sql = "SELECT weight, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND weight IS NOT NULL
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$count = mysql_num_rows($result);
					if ($count == 0) {
						$weight = '?';
					} else {
						$weight = $row['weight'];
					}
					$timestamp = new DateTime($row['timestamp']);
					$weightTime = $timestamp->diff($current);
					$weightTime = $weightTime->days;

					// Blood Type
					$sql = "SELECT bloodType, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND bloodType IS NOT NULL
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$count = mysql_num_rows($result);
					if ($count == 0) {
						$bloodType = '?';
					} else {
						$bloodType = $row['bloodType'];
					}
					$timestamp = new DateTime($row['timestamp']);
					$bloodTypeTime = $timestamp->diff($current);
					$bloodTypeTime = $bloodTypeTime->days;
				?>

				<!-- height weight and blood type boxes -->

				<div class="picDetails">
					<ul>
						<li class="tall"><img src="../images/height.png" alt=""><p class="info"><span class="infoLine1" id="patientHeight"><?php echo $height; ?> cm</span><br/> <?php echo $heightTime; ?> days ago</p></li>
						<li class="weight"><img src="../images/weight.png" alt=""><p class="info"><span class="infoLine1" id="patientWeight"><?php echo $weight; ?> kg</span><br/> <?php echo $weightTime; ?> days ago</p></li>
						<li class="blood"><img src="../images/blood.png" alt=""><p class="info"><span class="infoLine1" id="patientBloodType"><?php echo $bloodType; ?></span><br/> <?php echo $bloodTypeTime; ?> days ago</p></li>
					</ul>
				</div>
			</section>
		</div>
		
		<!-- Parents Details box -->

		<div class="box parentsDetails">
			<section class="boxTitle">
				<p>Parents or guardians contacts</p>
			</section>
			<section class="boxContent">
				<?php
					$sql = "SELECT *
							FROM guardians INNER JOIN patients_guardians USING (guardianID)
							WHERE patientID = {$patient}";
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
							<div class='parentDetailRight' id='guardianInfo'>
								<ul>
									<li id='guardianName'>{$row['title']} {$row['firstName']} {$row['lastName']}</li>
									<li id='guardianRelation'>{$row['relation']}</li>
									<li id='guardianContact'>{$row['contactNumber']}</li>
									<li id='guardianEmail'>{$row['email']}</li>
									<li id='guardianAddress'>{$row['address']}</li>
								</ul>
							</div>
						</div>";
					} else {
						echo "No Guardian currently assigned.";
					}
				?>
			</section>
		</div>
		

		<!-- Condition box -->

		<div class="box condiAllergy">
			<section class="boxTitle"><p>Condition</p></section>
			<section class="boxContent">
				<table id="patientConditions">
					<tr>
						<th class="first">Condition</th>
						<th class="second">Date</th>
						<th class="third">Medications</th>
					</tr>
					<?php
						// get patient's current condition listings, else blank table?
						$sql = "SELECT `condition`, conditionDate, medication
								FROM conditions
								WHERE patientID = {$patient}
								AND `condition` IS NOT NULL";
						$result = mysql_query($sql);
						$count = mysql_num_rows($result);
						$i = 1; // for row pdf

						if ($count > 0) {
							while ($row = mysql_fetch_array($result)) {
								echo "
								<tr>
									<td id='patientCondition{$i}'>{$row['condition']}</td>
									<td id='patientConditionDate{$i}'>{$row['conditionDate']}</td>
									<td id='patientMedication{$i}'>{$row['medication']}</td>
								</tr>
								";
								$i++;
							}
						} else {
							echo "
							<tr>
								<td id='patientCondition{$i}'>None</td>
								<td id='patientConditionDate{$i}'>None</td>
								<td id='patientMedication{$i}'>None</td>
							</tr>
							";
						}
					?>
				</table>
			</section>
		</div>

		<!--  Allergy box -->

		<div class="box condiAllergy">
			<section class="boxTitle"><p>Allergy</p></section>
			<section class="boxContent">
				<table id="patientAllergies">
					<tr>
						<th class="first">Allergy</th>
						<th class="second">Date</th>
						<th class="third">Severity</th>
					</tr>
					<?php
						// get patient's current condition listings, else blank table?
						$sql = "SELECT allergy, allergyDate, allergySeverity
								FROM conditions
								WHERE patientID = {$patient}
								AND allergy IS NOT NULL";
						$result = mysql_query($sql);
						$count = mysql_num_rows($result);
						$i = 1; // for row pdf

						if ($count > 0) {
							while ($row = mysql_fetch_array($result)) {
								echo "
								<tr>
									<td id='patientAllergy{$i}'>{$row['allergy']}</td>
									<td id='patientAllergyDate{$i}'>{$row['allergyDate']}</td>
									<td id='patientSeverity{$i}'>{$row['allergySeverity']}</td>
								</tr>
								";
								$i++;
							}
						} else {
							echo "
							<tr>
								<td id='patientAllergy{$i}'>None</td>
								<td id='patientAllergyDate{$i}'>None</td>
								<td id='patientSeverity{$i}'>None</td>
							</tr>
							";
						}
					?>
				</table>
			</section>
		</div>
	
	</div> <!-- End of almost full content -->
	
	<div class="leftContent">

		<!-- Check up box -->

		<div class="box checkup">
			<section class="boxTitle">
				<p>Check up</p>
			</section>
			<section class="boxContent">
				<?php
					// sql for getting the last checkup details (similar to the one above for height, weight, etc.)

					// Temperature
					$sql = "SELECT temperature, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND temperature IS NOT NULL
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$temperature = $row['temperature'];
					$timestamp = new DateTime($row['timestamp']);
					$temperatureTime = $timestamp->diff($current);
					$temperatureTime = $temperatureTime->days;

					// Blood Pressure
					$sql = "SELECT bloodPressure, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND bloodPressure IS NOT NULL
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$bloodPressure = $row['bloodPressure'];
					$timestamp = new DateTime($row['timestamp']);
					$bloodPressureTime = $timestamp->diff($current);
					$bloodPressureTime = $bloodPressureTime->days;

					// Pulse
					$sql = "SELECT pulse, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND pulse IS NOT NULL
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$pulse = $row['pulse'];
					$timestamp = new DateTime($row['timestamp']);

					// Eye Sight, Left
					$sql = "SELECT eyeSightLeft, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND eyeSightLeft IS NOT NULL
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$eyeSightLeft = $row['eyeSightLeft'];
					$timestamp = new DateTime($row['timestamp']);
					$eyeSightLeftTime = $timestamp->diff($current);
					$eyeSightLeftTime = $eyeSightLeftTime->days;

					// Eye Sight, right
					$sql = "SELECT eyeSightRight, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND eyeSightRight IS NOT NULL
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$eyeSightRight = $row['eyeSightRight'];
					$timestamp = new DateTime($row['timestamp']);

					// Blood Sugar
					$sql = "SELECT bloodSugar, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND bloodSugar IS NOT NULL
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$bloodSugar = $row['bloodSugar'];
					$timestamp = new DateTime($row['timestamp']);
					$bloodSugarTime = $timestamp->diff($current);
					$bloodSugarTime = $bloodSugarTime->days;

					// Defensive code for no checkup data
					if ($temperature == '') {
						$temperature = '?';
					}
					if ($bloodPressure == '') {
						$bloodPressure = '?/?';
					}
					if ($pulse == '') {
						$pulse = '?';
					}
					if ($eyeSightLeft == '') {
						$eyeSightLeft = '?';
					}
					if ($eyeSightRight == '') {
						$eyeSightRight = '?';
					}
					if ($bloodSugar == '') {
						$bloodSugar = '?';
					}
				?>
				<table>
					<tr>
						<td class="leftSide topSide">
							<div class="checkupBox">
								<p class="title">Temperature:
									<p class="value" id="patientTemperature"><?php echo $temperature; ?>°C
										<p class="time"><?php echo $temperatureTime; ?> days ago</p>
									</p>
								</p>
							</div>
						</td>
						<td class="topSide">
							<div class="checkupBox">
								<p class="title">Blood Pressure: 
									<p class="value2line"><span id="patientBloodPressure"><?php echo $bloodPressure; ?></span><br/> <span id="patientPulse">pulse <?php echo $pulse; ?></span>
										<p class="time"><?php echo $bloodPressureTime; ?> days ago</p>
									</p>
								</p>
							</div>
						</td>
					</tr>
					<tr>
						<td class="leftSide">
							<div class="checkupBox">
								<p class="title">Eye sight:
									<p class="value2line"> <span id="patientEyeSightLeft">Left: <?php echo $eyeSightLeft; ?></span><br/> <span id="patientEyeSightRight">Right: <?php echo $eyeSightRight; ?></span>
										<p class="time"><?php echo $eyeSightLeftTime; ?> days ago</p>
									</p>
								</p>
							</div>
						</td>
						<td>
							<div class="checkupBox">
								<p class="title">Blood Sugar:
									<p class="value" id="patientBloodSugar"><?php echo $bloodSugar; ?>
										<p class="time"><?php echo $bloodSugarTime; ?> days ago</p>
									</p>
								</p>
							</div>
						</td>
					</tr>
				</table>
			</section>
		</div>

	</div> <!-- End of left content -->

	<div class="rightContent">

		<!-- Check up history box -->
		<div class="box checkupHistory">
			<div class="boxTitle">
				<p>Check Up History</p>
			</div>
			<div class="boxContent">
				<table>
					<tr>
						<th class="date">Date</th>
						<th class="temp">Temp</th>
						<th class="bp">Blood Pressure</th>
						<th class="es">Eye sight</th>
						<th class="bs">Blood Sugar</th>
					</tr>
					<?php
						// sql for getting last 6 checkups data
						$sql = "SELECT timestamp, temperature, bloodPressure, pulse, eyeSightLeft, eyeSightRight, bloodSugar
								FROM checkups
								WHERE patientID = {$patient}
								ORDER BY timestamp DESC";
						$result = mysql_query($sql);


						// .. how am I gonna code filling in the rest with blank rows?
						for ($i = 0; $i <= 5; $i++) {
							if ($row = mysql_fetch_assoc($result)) {
								// format timestamp
								$timestamp = date("d/m/Y", strtotime($row['timestamp']));

								echo "
								<tr>
									<td>{$timestamp}</td>
								";

								// include detection for blank fields
								if ($row['temperature'] != '') {
									echo "<td>{$row['temperature']}°C</td>";
								} else {
									echo "<td></td>";
								}
								if ($row['bloodPressure'] != '') {
									echo "<td>{$row['bloodPressure']}, pulse {$row['pulse']}</td>";
								} else {
									echo "<td></td>";
								}
								if ($row['eyeSightLeft'] != '') {
									echo "<td>left: {$row['eyeSightLeft']}, right: {$row['eyeSightRight']}</td>";
								} else {
									echo "<td></td>";
								}
								if ($row['bloodSugar'] != '') {
									echo "<td>{$row['bloodSugar']}</td>";
								} else {
									echo "<td></td>";
								}
								echo "
								</tr>
								";
							} else {
								echo "
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								";
							}
						}
					?>
				</table>
			</div>
		</div>
	</div> <!-- End of Right Content -->


	<div class="fullContent">

		<!-- Nurse Observation -->

		<div class="box NurseObservation">
			<div class="boxTitle">
				<p>Nurse Observation</p>
			</div>
			<div class="boxContent">
				<?php
					// sql to get the latest 12 nurse observations for the patient
					$sql = "SELECT timestamp, observationTitle, observation, firstName, lastName
							FROM observations INNER JOIN staff USING (staffID)
							WHERE patientID = {$patient}
							ORDER BY timestamp DESC
							LIMIT 0, 12";
					$result = mysql_query($sql);
					$count = mysql_num_rows($result);

					// if no observations, have one saying so
					if ($count > 0) {

						// Observation Navbar

						// first observation
						$i = 1;
						$row = mysql_fetch_assoc($result);
						$timestamp = date("d/m/Y", strtotime($row['timestamp']));
						// only return a short part of the title
						$title = substr($row['observationTitle'], 0, 12);
						if (strlen($title) >= 12) {
							$title = $title . '...';
						}

						echo "
						<div class='observationNavbar'>
							<ul class='observationNumber'>
								<li class='active' id='n{$i}' onclick='observation(\"{$i}\")'>
										{$title}
										<span class='observationTimeStamp'>{$timestamp}</span>
								</li>
						";

						// following observations
						while ($row = mysql_fetch_assoc($result)) {
							$i++;
							$timestamp = date("d/m/Y", strtotime($row['timestamp']));
							// only return a short part of the title
							$title = substr($row['observationTitle'], 0, 12);
							if (strlen($title) >= 12) {
								$title = $title . '...';
							}

							echo "
								<li id='n{$i}' onclick='observation(\"{$i}\")'>
										{$title}
										<span class='observationTimeStamp'>{$timestamp}</span>
								</li>
							";
						}

						echo "
							</ul>
						</div>
						";

						// Observation Details

						$sql = "SELECT timestamp, observationTitle, observation, firstName, lastName
								FROM observations INNER JOIN staff USING (staffID)
								WHERE patientID = {$patient}
								ORDER BY timestamp DESC";
						$result = mysql_query($sql);
						$i = 0;

						while ($row = mysql_fetch_array($result)) {
							$i++;
							$timestamp = date("d/m/Y", strtotime($row['timestamp']));
							// to display newline characters when pulling text from database
							$observation = nl2br($row['observation']);
							echo "
							<div class='observation' id='o{$i}'>
								<p class='observationTitle'>
									<span id='observationTitle{$i}'>{$row['observationTitle']}</span>
									<span class='observationTimeStamp' id='observationDetails{$i}'>Recorded by: Nurse {$row['firstName']} {$row['lastName']}, {$timestamp}</span>
								</p>
								<p class='observationContent'>
									<span id='observation{$i}'>{$observation}</span>
								</p>
							</div>
							";
						}

					} else {
						echo "
						<div class='observationNavbar'>
							<ul>
								<li class='active' id='n1' onclick='observation('1')'>						
										No Observations
										<span class='observationTimeStamp' id='observationDetails1'></span>				
								</li>
							</ul>			
						</div>
						<div class='observation' id='o1'>
							<p class='observationTitle' id='observationTitle1'>
								No Observations
								<span class='observationTimeStamp'></span>
							</p>
							<p class='observationContent' id='observation1'>
							</p>
						</div>
						";
					}
				?>
			</div>
		</div>
	</div> <!-- End of full content -->
</div> <!-- End of details -->


<div class="clear"></div>
	
	<?php
		$id = $patient;
		$href = "patientupdate.php?patient=". $id;

		switch ($_SESSION['title']) {
			case 1: $update = 'Update Checkup / Conditions / Allergies';
				break;
			case 2: $update = 'Update Observations';
				break;
			case 3: $update = 'Upload X-ray';
				break;
			default: $update = 'Update Information';
				echo "<div id='pdf'>
					<button type='button' class='submit' onclick='documentFromHTML()'>Export information to PDF</button>
			 	</div>";
				break;
		}

		echo "<a href='".$href. "'><button type='submit' class='submit'>{$update}</button></a>"
	?>
	
<?php
	include '../inc/footer.php';
?>