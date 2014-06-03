<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';
	// if user is not admin, redirect to home page
	include '../inc/adminCheck.php';


	// get the get things
	$table = mysql_escape_string($_GET['table']);
	$column = mysql_escape_string($_GET['column']);
	$ID = mysql_escape_string($_GET['ID']);

	$pageTitle = "Record Edit";
	$breadcrumb = "<a href='home.php'>Home</a> > <a href='recordsmenu.php'>Records Menu</a> > <a href='records.php?table={$table}'>Records: {$table}</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2b");</script>
<link type="text/css" rel="stylesheet" href="../css/patientupdate.css" media="screen" /> 

<!-- Record Edit: has a form for editing said record -->

<div id="record">
<div class="leftContent">
<div class="box">
	<section class="boxTitle">
		<p>Record</p>
	</section>
	<section class="boxContent">
		<?php
			// sql for record selection
			if (isset($_GET['ID2'])) {
				$column2 = mysql_escape_string($_GET['column2']);
				$ID2 = mysql_escape_string($_GET['ID2']);

				$sql = "SELECT *
						FROM {$table}
						WHERE {$column} = {$ID}
						AND {$column2} = {$ID2}";
			} else {
				$sql = "SELECT *
						FROM {$table}
						WHERE {$column} = '{$ID}'";
			}
			$result = mysql_query($sql);

			while ($row = mysql_fetch_assoc($result)) {
				// switch depending on what table fields to show
				switch ($table) {
					case "beds":
						// form
						echo "
						<form action='recordeditprocess.php?table=beds' method='post'>
							<div>
								<label for='bedNumber'>bedNumber: </label>
								<input type='text' class='textInput' name='bedNumber' value='" . htmlentities($row['bedNumber']) . "' />
							</div>
							<div>
								<label for='patientID'>patientID: </label>
								<input type='text' class='textInput' name='patientID' value='" . htmlentities($row['patientID']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "checkups":
						// form
						echo "
						<form action='recordeditprocess.php?table=checkups' method='post'>
							<div>
								<label for='checkupID'>checkupID: </label>
								<input type='text' class='textInput' name='checkupID' value='" . htmlentities($row['checkupID']) . "' />
							</div>
							<div>
								<label for='temperature'>temperature: </label>
								<input type='text' class='textInput' name='temperature' value='" . htmlentities($row['temperature']) . "' />
							</div>
							<div>
								<label for='bloodPressure'>bloodPressure: </label>
								<input type='text' class='textInput' name='bloodPressure' value='" . htmlentities($row['bloodPressure']) . "' />
							</div>
							<div>
								<label for='pulse'>pulse: </label>
								<input type='text' class='textInput' name='pulse' value='" . htmlentities($row['pulse']) . "' />
							</div>
							<div>
								<label for='eyeSightLeft'>eyeSightLeft: </label>
								<input type='text' class='textInput' name='eyeSightLeft' value='" . htmlentities($row['eyeSightLeft']) . "' />
							</div>
							<div>
								<label for='eyeSightRight'>eyeSightRight: </label>
								<input type='text' class='textInput' name='eyeSightRight' value='" . htmlentities($row['eyeSightRight']) . "' />
							</div>
							<div>
								<label for='bloodSugar'>bloodSugar: </label>
								<input type='text' class='textInput' name='bloodSugar' value='" . htmlentities($row['bloodSugar']) . "' />
							</div>
							<div>
								<label for='height'>height: </label>
								<input type='text' class='textInput' name='height' value='" . htmlentities($row['height']) . "' />
							</div>
							<div>
								<label for='weight'>weight: </label>
								<input type='text' class='textInput' name='weight' value='" . htmlentities($row['weight']) . "' />
							</div>
							<div>
								<label for='bloodType'>bloodType: </label>
								<input type='text' class='textInput' name='bloodType' value='" . htmlentities($row['bloodType']) . "' />
							</div>
							<div>
								<label for='timestamp'>timestamp: </label>
								<input type='text' class='textInput' name='timestamp' value='" . htmlentities($row['timestamp']) . "' />
							</div>
							<div>
								<label for='patientID'>patientID: </label>
								<input type='text' class='textInput' name='patientID' value='" . htmlentities($row['patientID']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "conditions":
						// form
						echo "
						<form action='recordeditprocess.php?table=conditions' method='post'>
							<div>
								<label for='conditionID'>conditionID: </label>
								<input type='text' class='textInput' name='conditionID' value='" . htmlentities($row['conditionID']) . "' />
							</div>
							<div>
								<label for='condition'>condition: </label>
								<input type='text' class='textInput' name='condition' value='" . htmlentities($row['condition']) . "' />
							</div>
							<div>
								<label for='conditionDate'>conditionDate: </label>
								<input type='text' class='textInput' name='conditionDate' value='" . htmlentities($row['conditionDate']) . "' />
							</div>
							<div>
								<label for='medication'>medication: </label>
								<input type='text' class='textInput' name='medication' value='" . htmlentities($row['medication']) . "' />
							</div>
							<div>
								<label for='allergy'>allergy: </label>
								<input type='text' class='textInput' name='allergy' value='" . htmlentities($row['allergy']) . "' />
							</div>
							<div>
								<label for='allergyDate'>allergyDate: </label>
								<input type='text' class='textInput' name='allergyDate' value='" . htmlentities($row['allergyDate']) . "' />
							</div>
							<div>
								<label for='allergySeverity'>allergySeverity: </label>
								<input type='text' class='textInput' name='allergySeverity' value='" . htmlentities($row['allergySeverity']) . "' />
							</div>
							<div>
								<label for='timestamp'>timestamp: </label>
								<input type='text' class='textInput' name='timestamp' value='" . htmlentities($row['timestamp']) . "' />
							</div>
							<div>
								<label for='patientID'>patientID: </label>
								<input type='text' class='textInput' name='patientID' value='" . htmlentities($row['patientID']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "guardians":
						// form
						echo "
						<form action='recordeditprocess.php?table=guardians' method='post'>
							<div>
								<label for='guardianID'>guardianID: </label>
								<input type='text' class='textInput' name='guardianID' value='" . htmlentities($row['guardianID']) . "' />
							</div>
							<div>
								<label for='firstName'>firstName: </label>
								<input type='text' class='textInput' name='firstName' value='" . htmlentities($row['firstName']) . "' />
							</div>
							<div>
								<label for='lastName'>lastName: </label>
								<input type='text' class='textInput' name='lastName' value='" . htmlentities($row['lastName']) . "' />
							</div>
							<div>
								<label for='title'>title: </label>
								<input type='text' class='textInput' name='title' value='" . htmlentities($row['title']) . "' />
							</div>
							<div>
								<label for='contactNumber'>contactNumber: </label>
								<input type='text' class='textInput' name='contactNumber' value='" . htmlentities($row['contactNumber']) . "' />
							</div>
							<div>
								<label for='email'>email: </label>
								<input type='text' class='textInput' name='email' value='" . htmlentities($row['email']) . "' />
							</div>
							<div>
								<label for='address'>address: </label>
								<input type='text' class='textInput' name='address' value='" . htmlentities($row['address']) . "' />
							</div>
							<div>
								<label for='photo'>photo: </label>
								<input type='text' class='textInput' name='photo' value='" . htmlentities($row['photo']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "notes":
						// form
						echo "
						<form action='recordeditprocess.php?table=notes' method='post'>
							<div>
								<label for='noteID'>noteID: </label>
								<input type='text' class='textInput' name='noteID' value='" . htmlentities($row['noteID']) . "' />
							</div>
							<div>
								<label for='datetimeWritten'>datetimeWritten: </label>
								<input type='text' class='textInput' name='datetimeWritten' value='" . htmlentities($row['datetimeWritten']) . "' />
							</div>
							<div>
								<label for='note'>note: </label>
								<input type='text' class='textInput' name='note' value='" . htmlentities($row['note']) . "' />
							</div>
							<div>
								<label for='image'>image: </label>
								<input type='text' class='textInput' name='image' value='" . htmlentities($row['image']) . "' />
							</div>
							<div>
								<label for='staffID'>staffID: </label>
								<input type='text' class='textInput' name='staffID' value='" . htmlentities($row['staffID']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "observations":
						// form
						echo "
						<form action='recordeditprocess.php?table=observations' method='post'>
							<div>
								<label for='observationID'>observationID: </label>
								<input type='text' class='textInput' name='observationID' value='" . htmlentities($row['observationID']) . "' />
							</div>
							<div>
								<label for='timestamp'>timestamp: </label>
								<input type='text' class='textInput' name='timestamp' value='" . htmlentities($row['timestamp']) . "' />
							</div>
							<div>
								<label for='observationTitle'>observationTitle: </label>
								<input type='text' class='textInput' name='observationTitle' value='" . htmlentities($row['observationTitle']) . "' />
							</div>
							<div>
								<label for='observation'>observation: </label>
								<textarea name='observation' required>" . htmlentities($row['observation']) . "</textarea>
							</div>
							<div>
								<label for='patientID'>patientID: </label>
								<input type='text' class='textInput' name='patientID' value='" . htmlentities($row['patientID']) . "' />
							</div>
							<div>
								<label for='staffID'>staffID: </label>
								<input type='text' class='textInput' name='staffID' value='" . htmlentities($row['staffID']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;
					
					case "patients":
						// form
						echo "
						<form action='recordeditprocess.php?table=patients' method='post'>
							<div>
								<label for='patientID'>patientID: </label>
								<input type='text' class='textInput' name='patientID' value='" . htmlentities($row['patientID']) . "' />
							</div>
							<div>
								<label for='firstName'>firstName: </label>
								<input type='text' class='textInput' name='firstName' value='" . htmlentities($row['firstName']) . "' />
							</div>
							<div>
								<label for='lastName'>lastName: </label>
								<input type='text' class='textInput' name='lastName' value='" . htmlentities($row['lastName']) . "' />
							</div>
							<div>
								<label for='DOB'>DOB: </label>
								<input type='text' class='textInput' name='DOB' value='" . htmlentities($row['DOB']) . "' />
							</div>
							<div>
								<label for='photo'>photo: </label>
								<input type='text' class='textInput' name='photo' value='" . htmlentities($row['photo']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "patients_guardians":
						// form
						echo "
						<form action='recordeditprocess.php?table=patients_guardians' method='post'>
							<div>
								<label for='patientID'>patientID: </label>
								<input type='text' class='textInput' name='patientID' value='" . htmlentities($row['patientID']) . "' />
							</div>
							<div>
								<label for='guardianID'>guardianID: </label>
								<input type='text' class='textInput' name='guardianID' value='" . htmlentities($row['guardianID']) . "' />
							</div>
							<div>
								<label for='relation'>relation: </label>
								<input type='text' class='textInput' name='relation' value='" . htmlentities($row['relation']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "payments":
						// form
						echo "
						<form action='recordeditprocess.php?table=payments' method='post'>
							<div>
								<label for='paymentID'>paymentID: </label>
								<input type='text' class='textInput' name='paymentID' value='" . htmlentities($row['paymentID']) . "' />
							</div>
							<div>
								<label for='admissionDate'>admissionDate: </label>
								<input type='text' class='textInput' name='admissionDate' value='" . htmlentities($row['admissionDate']) . "' />
							</div>
							<div>
								<label for='releaseDate'>releaseDate: </label>
								<input type='text' class='textInput' name='releaseDate' value='" . htmlentities($row['releaseDate']) . "' />
							</div>
							<div>
								<label for='cost'>cost: </label>
								<input type='text' class='textInput' name='cost' value='" . htmlentities($row['cost']) . "' />
							</div>
							<div>
								<label for='paymentMethod'>paymentMethod: </label>
								<input type='text' class='textInput' name='paymentMethod' value='" . htmlentities($row['paymentMethod']) . "' />
							</div>
							<div>
								<label for='rebuff'>rebuff: </label>
								<input type='text' class='textInput' name='rebuff' value='" . htmlentities($row['rebuff']) . "' />
							</div>
							<div>
								<label for='patientID'>patientID: </label>
								<input type='text' class='textInput' name='patientID' value='" . htmlentities($row['patientID']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "schedules":
						// form
						echo "
						<form action='recordeditprocess.php?table=schedules' method='post'>
							<div>
								<label for='scheduleID'>scheduleID: </label>
								<input type='text' class='textInput' name='scheduleID' value='" . htmlentities($row['scheduleID']) . "' />
							</div>
							<div>
								<label for='details'>details: </label>
								<input type='text' class='textInput' name='details' value='" . htmlentities($row['details']) . "' />
							</div>
							<div>
								<label for='room'>room: </label>
								<input type='text' class='textInput' name='room' value='" . htmlentities($row['room']) . "' />
							</div>
							<div>
								<label for='startTime'>startTime: </label>
								<input type='text' class='textInput' name='startTime' value='" . htmlentities($row['startTime']) . "' />
							</div>
							<div>
								<label for='endTime'>endTime: </label>
								<input type='text' class='textInput' name='endTime' value='" . htmlentities($row['endTime']) . "' />
							</div>
							<div>
								<label for='patientID'>patientID: </label>
								<input type='text' class='textInput' name='patientID' value='" . htmlentities($row['patientID']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "staff":
						// form
						echo "
						<form action='recordeditprocess.php?table=staff' method='post'>
							<div>
								<label for='staffID'>staffID: </label>
								<input type='text' class='textInput' name='staffID' value='" . htmlentities($row['staffID']) . "' />
							</div>
							<div>
								<label for='firstName'>firstName: </label>
								<input type='text' class='textInput' name='firstName' value='" . htmlentities($row['firstName']) . "' />
							</div>
							<div>
								<label for='lastName'>lastName: </label>
								<input type='text' class='textInput' name='lastName' value='" . htmlentities($row['lastName']) . "' />
							</div>
							<div>
								<label for='title'>title: </label>
								<input type='text' class='textInput' name='title' value='" . htmlentities($row['title']) . "' />
							</div>
							<div>
								<label for='password'>password: </label>
								<input type='text' class='textInput' name='password' value='" . htmlentities($row['password']) . "' />
							</div>
							<div>
								<label for='specialties'>specialties: </label>
								<input type='text' class='textInput' name='specialties' value='" . htmlentities($row['specialties']) . "' />
							</div>
							<div>
								<label for='photo'>photo: </label>
								<input type='text' class='textInput' name='photo' value='" . htmlentities($row['photo']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;

					case "titles":
						// form
						echo "
						<form action='recordeditprocess.php?table=titles' method='post'>
							<div>
								<label for='titleID'>titleID: </label>
								<input type='text' class='textInput' name='titleID' value='" . htmlentities($row['titleID']) . "' />
							</div>
							<div>
								<label for='title'>title: </label>
								<input type='text' class='textInput' name='title' value='" . htmlentities($row['title']) . "' />
							</div>
							<div>
								<button type='submit' class='submit'>Update Record</button>
							</div>
						</form>
						";
						break;
						
					default:
						echo "No table selected.";
						break;
				}
			}
		?>
	</section>
</div>
</div>
</div>

<?php
	include '../inc/footer.php';
?> 