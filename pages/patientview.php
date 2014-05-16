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
					<p><span class="PatientName"><?php echo $row['firstName']." ". $row['lastName']; ?></span></br>
						<?php echo $year; ?> Years Old</br>
						(p<?php echo $row['patientID']; ?>)</br>
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
							AND height IS NOT NULL";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$height = $row['height'];
					$timestamp = new DateTime($row['timestamp']);
					$heightTime = $timestamp->diff($current);
					$heightTime = $heightTime->days;

					// Weight
					$sql = "SELECT weight, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND weight IS NOT NULL";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$weight = $row['weight'];
					$timestamp = new DateTime($row['timestamp']);
					$weightTime = $timestamp->diff($current);
					$weightTime = $weightTime->days;

					// Blood Type
					$sql = "SELECT bloodType, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND bloodType IS NOT NULL";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$bloodType = $row['bloodType'];
					$timestamp = new DateTime($row['timestamp']);
					$bloodTypeTime = $timestamp->diff($current);
					$bloodTypeTime = $bloodTypeTime->days;
				?>

				<!-- height weight and blood type boxes -->

				<div class="picDetails">
					<ul>
						<li class="tall"><img src="../images/height.png" alt=""><p class="info"><span class="infoLine1"><?php echo $height; ?></span><br/> <?php echo $heightTime; ?> days ago</p></li>
						<li class="weight"><img src="../images/weight.png" alt=""><p class="info"><span class="infoLine1"><?php echo $weight; ?></span><br/> <?php echo $weightTime; ?> days ago</p></li>
						<li class="blood"><img src="../images/blood.png" alt=""><p class="info"><span class="infoLine1"><?php echo $bloodType; ?></span><br/> <?php echo $bloodTypeTime; ?> days ago</p></li>
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
		

		<!-- Condition box -->

		<div class="box condiAllergy">
			<section class="boxTitle"><p>Condition</p></section>
			<section class="boxContent">
				<table>
					<tr>
						<th class="first">Condition</th>
						<th class="second">Date</th>
						<th class="third">Medications</th>
					</tr>
					<!-- while ($row = mysql_fetch_assoc($result)) { -->
					<!-- echo " <tr>
						<td>Something $row['condition'] </td>
						<td>14/02/2014 the timestamp thing </td>
						<td>Something, Something, Something  $row['medications'] </td>
					</tr>-->
					<?php
						// get patient's current condition listings, else blank table?
						$sql = "SELECT `condition`, conditionDate, medication
								FROM conditions
								WHERE patientID = {$patient}";
						$result = mysql_query($sql);
						$count = mysql_num_rows($result);

						if ($count > 0) {
							while ($row = mysql_fetch_array($result)) {
								echo "
								<tr>
									<td>{$row['condition']}</td>
									<td>{$row['conditionDate']}</td>
									<td>{$row['medication']}</td>
								</tr>
								";
							}
						} else {
							echo "
							<tr>
								<td>None</td>
								<td>None</td>
								<td>None</td>
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
				<table>
					<tr>
						<th class="first">Allergy</th>
						<th class="second">Date</th>
						<th class="third">Severity</th>
					</tr>
					<!-- while ($row = mysql_fetch_array($result)) { -->
					<!-- echo " <tr>
						<td>Something $row['allergy'] </td>
						<td>14/02/2014 the timestamp thing </td>
						<td>Very serious  $row['midcations'] </td>
					</tr> -->
					<?php
						// get patient's current condition listings, else blank table?
						$sql = "SELECT allergy, allergyDate, allergySeverity
								FROM conditions
								WHERE patientID = {$patient}";
						$result = mysql_query($sql);
						$count = mysql_num_rows($result);

						if ($count > 0) {
							while ($row = mysql_fetch_array($result)) {
								echo "
								<tr>
									<td>{$row['allergy']}</td>
									<td>{$row['allergyDate']}</td>
									<td>{$row['allergySeverity']}</td>
								</tr>
								";
							}
						} else {
							echo "
							<tr>
								<td>None</td>
								<td>None</td>
								<td>None</td>
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
					// temperature, bloodPressure, pulse, eyeSightLeft, eyeSightRight, bloodSugar
					// $current should still work?
					// need to check for no checkup data too

					// Temperature
					$sql = "SELECT temperature, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND temperature IS NOT NULL";
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
							AND bloodPressure IS NOT NULL";
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
							AND pulse IS NOT NULL";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$pulse = $row['pulse'];
					$timestamp = new DateTime($row['timestamp']);
					//$pulseTime = $timestamp->diff($current);
					//$pulseTime = $pulseTime->days;

					// Eye Sight, Left
					$sql = "SELECT eyeSightLeft, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND eyeSightLeft IS NOT NULL";
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
							AND eyeSightRight IS NOT NULL";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$eyeSightRight = $row['eyeSightRight'];
					$timestamp = new DateTime($row['timestamp']);
					//$eyeSightRightTime = $timestamp->diff($current);
					//$eyeSightRightTime = $eyeSightRightTime->days;

					// Blood Sugar
					$sql = "SELECT bloodSugar, timestamp
							FROM checkups
							WHERE patientID = {$patient}
							AND bloodSugar IS NOT NULL";
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
									<p class="value"><?php echo $temperature; ?>°C
										<p class="time"><?php echo $temperatureTime; ?> days ago</p>
									</p>
								</p>
							</div>
						</td>
						<td class="topSide">
							<div class="checkupBox">
								<p class="title">Blood Pressure: 
									<p class="value2line"><?php echo $bloodPressure; ?><br/> pulse <?php echo $pulse; ?>
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
									<p class="value2line"> Left: <?php echo $eyeSightLeft; ?><br/> Right: <?php echo $eyeSightRight; ?>
										<p class="time"><?php echo $eyeSightLeftTime; ?> days ago</p>
									</p>
								</p>
							</div>
						</td>
						<td>
							<div class="checkupBox">
								<p class="title">Blood Sugar:
									<p class="value"><?php echo $bloodSugar; ?>
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
		<!-- This box should show the 6 most recent check up history, if there isn't, leave it blank tables 
		so maybe for(i=0;i<5;i++){if($xx != null){ echo "<tr><td>{$xx}</td><td>"....}else { echo "<tr><td></td>....."}}
		yeah this is javascript like, sorry but you get the idea -->
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
					<!--<tr>
						<td>18/2/2014</td>
						<td>37°C</td>
						<td>120/80, pluse 70</td>
						<td>left: -1, right: -1.5</td>
						<td>75</td>
					</tr>
					<tr>
						<td>18/2/2014</td>
						<td>37°C</td>
						<td>120/80, pluse 70</td>
						<td>left: -1, right: -1.5</td>
						<td>75</td>
					</tr>
					<tr>
						<td>18/2/2014</td>
						<td>37°C</td>
						<td>120/80, pluse 70</td>
						<td>left: -1, right: -1.5</td>
						<td>75</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>-->
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
					// sql to get all? nurse observations for the patient
					$sql = "SELECT timestamp, observationTitle, observation, firstName, lastName
							FROM observations INNER JOIN staff USING (staffID)
							WHERE patientID = {$patient}
							ORDER BY timestamp DESC";
					$result = mysql_query($sql);
					$count = mysql_num_rows($result);

					// if no observations, have one saying so
					if ($count > 0) {

						// Observation Navbar

						// first observation
						$i = 1;
						$row = mysql_fetch_assoc($result);
						$timestamp = date("d/m/Y", strtotime($row['timestamp']));

						echo "
						<div class='observationNavbar'>
							<ul>
								<li class='active' id='n{$i}' onclick='observation(\"{$i}\")'>
										{$row['observationTitle']}
										<span class='observationTimeStamp'>{$timestamp}</span>
								</li>
						";

						// following observations
						while ($row = mysql_fetch_assoc($result)) {
							$i++;
							$timestamp = date("d/m/Y", strtotime($row['timestamp']));
							echo "
								<li id='n{$i}' onclick='observation(\"{$i}\")'>
										{$row['observationTitle']}
										<span class='observationTimeStamp'>{$timestamp}</span>
								</li>
							";
						}

						echo "
							</ul>
						</div>
						";

						// Observation Details

						// re-do sql? otherwise fetch_assoc is all messed up
						$sql = "SELECT timestamp, observationTitle, observation, firstName, lastName
								FROM observations INNER JOIN staff USING (staffID)
								WHERE patientID = {$patient}
								ORDER BY timestamp DESC";
						$result = mysql_query($sql);
						$i = 0;

						while ($row = mysql_fetch_array($result)) {
							$i++;
							$timestamp = date("d/m/Y", strtotime($row['timestamp']));
							echo "
							<div class='observation' id='o{$i}'>
								<p class='observationTitle'>
									{$row['observationTitle']}
									<span class='observationTimeStamp'>Recorded by: Nurse {$row['firstName']} {$row['lastName']}, {$timestamp}</span>
								</p>
								<p class='observationContent'>
									{$row['observation']}
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
										<span class='observationTimeStamp'></span>				
								</li>
							</ul>			
						</div>
						<div class='observation' id='o1'>
							<p class='observationTitle'>
								No Observations
								<span class='observationTimeStamp'></span>
							</p>
							<p class='observationContent'>
							</p>
						</div>
						";
					}
				?>
				<!--<div class="observationNavbar">
					<ul>
						<li class="active" id="n1" onclick='observation("1")'>						
								Bad Appetite
								<span class="observationTimeStamp">11/05/2014</span>				
						</li><li id="n2" onclick='observation("2")'>		
								Bad Appetite
								<span class="observationTimeStamp">11/05/2014</span>			
						</li><li id="n3" onclick='observation("3")'>		
								Bad Appetite
								<span class="observationTimeStamp">11/05/2014</span>			
						</li><li id="n4" onclick='observation("4")'>		
								Bad Appetite
								<span class="observationTimeStamp">11/05/2014</span>			
						</li><li id="n5" onclick='observation("5")'>
								Bad Appetite
								<span class="observationTimeStamp">11/05/2014</span>			
						</li>
					</ul>			
				</div>
				<div class="observation" id="o1">
					<p class="observationTitle">
						Bad Appetite 1
						<span class="observationTimeStamp">Recorded by: Nurse xxx , 11/05/2014</span>
					</p>
					<p class="observationContent">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, ipsum, temporibus dolores ducimus reprehenderit tenetur architecto ex eligendi a quia dolor voluptas vero sunt. Voluptates odit natus ab atque nobis. Laudantium, corporis, repellat, sed velit sunt sint voluptas cupiditate iure non provident expedita accusamus odit autem. Nesciunt, qui, consequatur, numquam eligendi excepturi consequuntur soluta sunt blanditiis doloribus quod quidem odit veritatis! Odio voluptatem veritatis voluptatum! In, quisquam, soluta aliquid est sint obcaecati totam ratione distinctio blanditiis sunt! Sapiente, temporibus, accusamus, nostrum, nesciunt sed repudiandae consectetur nihil natus veritatis corrupti fugiat perspiciatis repellat enim consequatur minima illum sint cum quis aliquid ipsum earum consequuntur vero aut tenetur nulla doloribus impedit dolorem dolores ipsam adipisci. Voluptate, molestiae, consequuntur, in voluptas perferendis at dolorum sunt animi distinctio mollitia commodi minima. Deserunt, dolores, autem accusantium ducimus ratione fugiat unde asperiores aliquid labore odio expedita rem veritatis voluptatum velit eveniet praesentium enim quisquam eius voluptatem explicabo saepe iusto minus eligendi assumenda facilis! Quibusdam, necessitatibus, asperiores, architecto quos illum nihil quia eius velit atque reprehenderit cupiditate harum impedit molestiae at magnam quis nam fuga qui mollitia consectetur! Provident quis nisi eaque beatae quia molestias nemo dolorum. Exercitationem, ipsam molestias molestiae dolorum nam sit mollitia quisquam voluptate dolorem consequuntur rerum recusandae animi beatae sequi ab omnis eligendi vitae illo quod reprehenderit autem illum voluptatibus. Libero, sit corporis doloribus vitae voluptas ab blanditiis officia quae dignissimos quos. Ipsa qui corporis a animi iure quo sequi quasi asperiores earum fugit. Harum, error, mollitia, consequatur pariatur doloribus dolores aliquam ex nostrum quia perferendis magni placeat accusamus consectetur atque aspernatur nesciunt recusandae cum vero odio iure amet deleniti nobis itaque ea vitae molestias molestiae facilis soluta cumque non hic obcaecati excepturi aliquid accusantium alias quam est cupiditate odit libero impedit repellat eligendi magnam incidunt voluptate asperiores eius porro earum assumenda quasi fugit! Nulla, deleniti, vitae, a ipsa voluptates nesciunt provident nihil nostrum et aliquam excepturi nam aspernatur vero temporibus asperiores labore dolores harum natus veritatis dolor quidem odit aut fuga eaque autem mollitia possimus. Quam, inventore, harum, dolor nam iusto animi doloribus hic facere porro iste neque amet veniam voluptate dignissimos expedita a laudantium dolorum eos voluptatibus nobis nihil earum illum incidunt voluptates ratione. Quidem quia corrupti earum dolor ratione dolore asperiores impedit cumque totam corporis! Magni, reprehenderit, officia, ipsam, dolores dolor repudiandae aspernatur repellat sed id nobis cupiditate qui ducimus perspiciatis excepturi cumque iste recusandae fugiat laudantium aperiam saepe debitis rerum molestias velit unde voluptatem cum eius harum quis ab itaque asperiores explicabo veniam sunt dignissimos minima fuga incidunt doloribus. Optio, corporis, sint sit modi adipisci obcaecati maiores dolorum iste eos laboriosam minima eveniet architecto minus cum aperiam numquam quibusdam in exercitationem quaerat molestiae praesentium saepe pariatur explicabo sequi cumque eligendi perspiciatis a illum deleniti asperiores nostrum voluptatem assumenda repellat temporibus officiis natus nihil doloribus. Veritatis, nostrum voluptatem nobis vel quas placeat velit numquam alias. Vitae, ab vel similique hic sit ratione nobis at. Nam, nobis, asperiores, porro amet numquam mollitia maiores delectus quia aliquam ex ad repudiandae voluptas quisquam odit doloremque earum nisi id deserunt odio quasi. Sint, veniam, porro, voluptatibus, minus provident corrupti est beatae eos culpa aut nemo molestias eaque maiores delectus excepturi nisi quae consequuntur tempora ea consequatur doloribus aliquid earum cum voluptatem aliquam laboriosam quos accusamus dolorum inventore itaque quas labore expedita vero quibusdam fugit rerum dicta nesciunt. Consequatur, sunt, itaque ex dolore aliquam quod iusto hic nihil quae dignissimos enim tempora accusantium sed ipsa dicta soluta quisquam id labore sint officiis excepturi ullam dolores at eveniet nostrum natus possimus fugiat! Soluta, iure, voluptatem, nulla deleniti consequuntur distinctio dolorem inventore quod iste id quasi sunt tempore minima repellendus laboriosam eos repellat! Beatae, officia, dolore, odit quasi ipsum eveniet nam et eos sapiente quos voluptatum debitis dignissimos velit obcaecati voluptatibus quod aperiam veritatis aliquid error necessitatibus vel nihil a aspernatur. Illum, velit provident tenetur earum libero. Perferendis, nobis natus distinctio consequuntur aspernatur ratione quidem veritatis qui itaque architecto quasi at aperiam illum. Debitis, maxime, dolorem dicta quibusdam vero fugiat mollitia ducimus commodi non iste tempora esse distinctio exercitationem modi officiis animi voluptas inventore eius consequuntur quod et sapiente perspiciatis ipsum. Reiciendis, obcaecati, optio fugiat impedit rem dolores alias dolorum ipsa voluptatibus et est ipsam cumque eaque quidem dolorem enim adipisci sunt voluptates qui nulla voluptate facere reprehenderit suscipit consequatur pariatur at sint assumenda soluta libero itaque? Repellat, temporibus, itaque, reprehenderit id quibusdam perspiciatis impedit quis error dolorum fugit tenetur architecto quisquam exercitationem laboriosam fuga sed voluptatibus vel commodi soluta quidem distinctio voluptatum et beatae nostrum cum adipisci explicabo tempora nihil harum ducimus magnam debitis fugiat non. Quidem, ipsa, fuga cum numquam assumenda ab minima fugit nihil delectus voluptates error velit temporibus ad eos debitis id incidunt omnis non. Illo, ab, inventore, placeat, veniam at sapiente sequi odio expedita quod quis esse in ratione pariatur accusamus delectus fugit assumenda harum vel atque suscipit eum laborum voluptate ex obcaecati corrupti. Neque, eos, quibusdam, soluta non deleniti facere accusamus temporibus facilis ipsum quisquam architecto vel recusandae corrupti possimus quae. Distinctio, dolore, tenetur quam quod nam inventore maxime tempore sint doloribus cupiditate culpa nobis praesentium beatae architecto dolorum at enim minus ullam quidem rem ad corrupti natus cumque saepe eaque error similique obcaecati animi perspiciatis aspernatur exercitationem voluptatum est blanditiis eveniet expedita dolores maiores a eligendi nisi deleniti nostrum iure non illum ex ipsa accusamus. Doloremque, molestias dolor quam vero quod eligendi dicta. Dolore, numquam voluptate ullam quasi atque rem amet praesentium minima velit ex beatae ratione nulla laboriosam similique ipsum exercitationem necessitatibus molestiae nam doloribus tempora ab veritatis labore alias eos accusamus facilis fuga odit nemo quaerat tenetur quae doloremque temporibus magnam. Eius, error, a, quos, alias itaque necessitatibus et aliquid consectetur libero doloremque velit cupiditate deserunt distinctio doloribus sapiente illum eaque enim mollitia fugit fugiat harum tempora laboriosam dolor assumenda saepe perspiciatis sint autem eveniet in nihil eos reprehenderit nam cum aperiam totam blanditiis reiciendis consequatur quisquam delectus maxime. Quas, ex iste doloribus excepturi quod blanditiis asperiores molestiae unde culpa illo veniam labore minus doloremque veritatis accusantium eos.
					</p>
				</div>
				<div class="observation" id="o2">
					<p class="observationTitle">
						Bad Appetite 2
						<span class="observationTimeStamp">Recorded by: Nurse xxx , 11/05/2014</span>
					</p>
					<p class="observationContent">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, dolorum, atque totam architecto voluptates repellendus explicabo. Voluptate, cumque, officiis, magni saepe impedit voluptates facere sunt autem cupiditate enim tempore voluptatum nisi reiciendis natus ut deserunt velit nesciunt sapiente alias expedita! Ducimus, incidunt, consequatur, porro quia doloremque commodi delectus corporis cupiditate alias sit assumenda provident illo aliquam libero aspernatur! Libero officia sint delectus cum perspiciatis ducimus rerum sapiente velit veniam. Labore qui commodi nulla quia dolor deleniti libero. Commodi, consequatur, odio, repudiandae ducimus quisquam voluptatibus ex accusamus aut dolore temporibus neque quos iusto suscipit sunt non ratione rerum. Suscipit, ratione tempore reprehenderit non dolores. Cupiditate minus quidem voluptatibus repellendus odio maxime ullam sequi dolor eum. Fuga, ratione, iure atque quidem earum omnis eligendi optio nostrum suscipit sapiente in nesciunt asperiores ab repellendus illum. Quam, enim, quos, quibusdam error explicabo ab atque animi saepe odit sint inventore non nisi consequuntur aperiam iste obcaecati in amet nihil dolor sequi excepturi maiores distinctio omnis porro deleniti. Dolor saepe ducimus dicta deleniti atque ratione nihil alias voluptatibus. Accusantium, quasi, voluptatum, laborum tempora minus est reprehenderit asperiores illum consequuntur at numquam adipisci hic inventore? Doloribus, expedita, atque totam enim quibusdam repellat dignissimos saepe sunt. Obcaecati, minima!
					</p>
				</div>
				<div class="observation" id="o3">
					<p class="observationTitle">
						Bad Appetite 3
						<span class="observationTimeStamp">Recorded by: Nurse xxx , 11/05/2014</span>
					</p>
					<p class="observationContent">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae, fugiat nisi quo perferendis iure temporibus nesciunt qui odit quod consequuntur deserunt repellat sit sed culpa dolores nobis assumenda? Temporibus, fugiat, eius, perferendis debitis in delectus ipsum voluptatum id nobis qui placeat facilis quam necessitatibus dolorem vero eum nisi et incidunt dolore non modi assumenda sed pariatur tempora aspernatur deleniti laudantium porro numquam consequatur autem minus harum enim laboriosam reprehenderit magnam dolorum nesciunt animi ex sequi praesentium culpa facere. Maxime, reiciendis magni mollitia quod incidunt autem numquam? Incidunt, quam, impedit ratione accusamus fugit a. Voluptas praesentium quasi ex tempore modi odit.
					</p>
				</div>
				<div class="observation" id="o4">
					<p class="observationTitle">
						Bad Appetite 4
						<span class="observationTimeStamp">Recorded by: Nurse xxx , 11/05/2014</span>
					</p>
					<p class="observationContent">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non, commodi ratione mollitia suscipit iure eligendi at ut nam itaque ad totam voluptatum fuga eos asperiores perferendis quia velit illum atque ea aspernatur necessitatibus excepturi repellendus sit quas dignissimos vitae soluta cumque blanditiis ullam molestiae amet obcaecati quasi delectus id laboriosam numquam accusantium nemo! Totam, hic, inventore beatae est omnis architecto voluptatem ea modi dolore deserunt nostrum a dolores similique aperiam error asperiores impedit. Pariatur, perspiciatis, placeat libero rerum atque ab consequatur natus quo qui excepturi quaerat assumenda laborum quos quis illum. Earum, non, eius, qui nesciunt sit quaerat suscipit pariatur vitae explicabo repudiandae impedit eaque voluptatum fuga necessitatibus obcaecati fugiat architecto dolor consequuntur ex quod autem maxime rerum quibusdam dignissimos officiis. Deleniti, qui, omnis eligendi at officiis sit placeat nulla ut dolore quis beatae alias fugit quas doloribus natus minus laborum impedit earum nam molestiae consequatur hic quidem quod adipisci asperiores? Officiis, voluptates, non qui veritatis eius aliquam dolor. Esse, molestiae, cumque, facere neque quam ex alias quas voluptates sunt magnam necessitatibus rerum placeat architecto fugiat possimus similique id dicta quasi quia quo voluptate dolorum soluta at ab pariatur voluptatem aliquam cupiditate repudiandae saepe dolores quod ad non in harum rem odit fugit dignissimos nemo accusamus cum quos enim. Quaerat, nisi, voluptates vel expedita dolore ut ducimus nostrum reiciendis fuga illo officia magnam nesciunt! Facere, veniam, id, laborum iusto vitae itaque minima sunt alias cumque aperiam dolor deleniti autem quaerat voluptas perspiciatis maxime fuga perferendis numquam quae magni architecto esse at sequi possimus amet aliquam nostrum iure dignissimos labore? Adipisci, laboriosam distinctio cumque optio nihil non aspernatur eligendi nemo culpa debitis totam perspiciatis ex animi nisi numquam voluptas recusandae veritatis nostrum libero eos nobis velit laborum eveniet dignissimos corrupti. Reiciendis, sed, sequi aliquam praesentium blanditiis dolorem accusantium ad nemo quaerat dicta dolores sunt quos vel nihil unde minima dignissimos voluptatum odit earum provident libero pariatur delectus. Id, impedit, voluptas, quisquam architecto laudantium asperiores reiciendis explicabo similique perferendis provident sit atque omnis sint numquam officiis officia vel cupiditate dolores consectetur dolorem magnam maiores consequatur odio labore ad repellendus quidem voluptate harum laborum nostrum corrupti sequi soluta velit error neque nam praesentium. Incidunt, quis, vitae, autem eaque facilis aperiam qui adipisci esse dicta sapiente laudantium dolorum voluptates? Error, delectus, inventore quidem doloribus minus voluptate dolorum perferendis esse assumenda nisi at harum? Repellat, quod hic nobis vel molestias neque id fugiat. Nostrum, ab, omnis, explicabo, repellendus alias odio commodi libero ullam iste corrupti aspernatur consectetur aliquam suscipit quos ad sequi harum amet eius sit odit! Eos, rerum, enim ratione doloribus nihil fugiat architecto tenetur fuga qui ex! Dignissimos, sed, nulla, odit, alias adipisci architecto nihil praesentium porro aspernatur esse fuga nam quis officia asperiores cumque dolorum ad. Architecto, maiores ab illo fugiat expedita perferendis eius quo illum aspernatur pariatur aliquid repellendus maxime. Nihil, earum, odio totam a aperiam eveniet ex molestiae delectus nobis quis error cumque voluptatibus placeat itaque ut quas similique vitae saepe provident consequuntur illum quo ducimus architecto! Eveniet, commodi sunt!
					</p>
				</div>
				<div class="observation" id="o5">
					<p class="observationTitle">
						Bad Appetite 5
						<span class="observationTimeStamp">Recorded by: Nurse xxx , 11/05/2014</span>
					</p>
					<p class="observationContent">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum consequuntur exercitationem expedita. Suscipit ducimus voluptatem consequuntur accusamus odio? Ex, animi, dolor nemo reprehenderit voluptatum odit explicabo sunt illum obcaecati molestias quos at nisi laborum similique atque. Facilis, autem, amet, iste, porro sapiente quae omnis minus aliquid qui quam laborum harum velit consectetur libero culpa quia doloremque fugit. Voluptatum, voluptates, consectetur, illum recusandae beatae aspernatur voluptatibus accusamus repellat laborum nam nobis perspiciatis dolor eum cupiditate optio odio illo culpa iusto doloribus ipsum ut accusantium ullam nesciunt facere sit! Consectetur, maiores beatae magnam eum doloremque praesentium officia illo doloribus incidunt unde repellendus quis quas consequatur amet totam natus tempore perferendis officiis quod reprehenderit dolorum repudiandae iure impedit nulla sunt fuga magni! Placeat, explicabo, eum facilis atque natus neque odio sed quisquam. Fugiat, suscipit, aut totam voluptatum esse necessitatibus nemo ratione voluptates nobis debitis consequuntur perspiciatis eius explicabo non animi! Aliquid, ipsa, dolorem, eum nemo consequatur expedita ratione nostrum enim laudantium dolore temporibus soluta quaerat omnis est nulla praesentium assumenda distinctio. Voluptas, assumenda, eligendi, quae totam temporibus doloremque porro minus autem illum accusantium perspiciatis eos aliquam iusto similique voluptates impedit atque sequi illo quod itaque molestias vero quisquam voluptatibus sint consequuntur! Cum, fuga, vitae, illum soluta earum est a quam ratione nemo nobis molestias laboriosam tempora ducimus ullam cumque animi modi sint. Odio id molestias aliquid esse praesentium dignissimos maxime officiis ad et soluta! Dolorum, qui, pariatur deserunt eaque eligendi temporibus debitis consequuntur dignissimos accusamus ea saepe beatae animi non aspernatur porro maiores illo quis laborum harum similique omnis ipsum tempora voluptates ut nisi obcaecati cumque nostrum dolore minus ullam dicta modi voluptatibus in quidem accusantium vitae a ipsa. Vel, velit, aperiam delectus ducimus sunt repellat autem soluta quos unde molestiae. Quaerat, maiores doloribus ratione velit assumenda est architecto necessitatibus error dignissimos libero.
					</p>
				</div>-->
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