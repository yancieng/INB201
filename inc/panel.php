<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

	<link type="text/css" rel="stylesheet" href="../css/panel.css" media="screen" /> 
	<link type="text/css" rel="stylesheet" href="../css/style.css" media="screen" /> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="../js/activePanel.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'>

	<!-- Stuff for PDF conversion -->
	<!--<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>-->
	<script type="text/javascript" src="../js/jspdf.js"></script>
	<script type="text/javascript" src="../js/jspdf.plugin.standard_fonts_metrics.js"></script> 
	<script type="text/javascript" src="../js/jspdf.plugin.split_text_to_size.js"></script>               
	<script type="text/javascript" src="../js/jspdf.plugin.from_html.js"></script>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Javascrpit ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- Script for PDF conversion -->
<script>
    function documentFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        pdf.setFont("helvetica");
        margins = {
        	top: 50,
        	bottom: 60,
        	left: 40,
        	width: 522
        }

        // Townsville Children's Hospital
        pdf.setFontSize(24);
        pdf.text(150, margins.top, 'Townsville Children\'s Hospital');

        // Patient Info: PatientID, Name, DOB
        pdf.setFontSize(16);
        pdf.text(margins.left, 100, "Patient Information");

	        // Headings
	        pdf.setFontSize(12);
	        pdf.setFontType("bold")
	        pdf.text(margins.left, 120, "ID Number:");
	        pdf.text(margins.left, 140, "Full Name:");
	        pdf.text(margins.left, 160, "Date of Birth:");

	        // Information
	        var ID = document.getElementById("patientID").innerHTML;
	        var name = document.getElementById("patientName").innerHTML;
	        var age = document.getElementById("patientAge").innerHTML;
	        pdf.setFontType("normal")
	        pdf.text(140, 120, ID);
	        pdf.text(140, 140, name);
	        pdf.text(140, 160, age);

	    // Guardian Info: Name, Relation, Contact Number, Email, Address
        pdf.setFontSize(16);
        pdf.text(margins.left, 200, "Guardian Information");

	    	// Headings
	        pdf.setFontSize(12);
	        pdf.setFontType("bold");
	        pdf.text(margins.left, 220, "Guardian Name:");
	        pdf.text(margins.left, 240, "Relation:");
	        pdf.text(margins.left, 260, "Contact Number:");
	        pdf.text(margins.left, 280, "Email:");
	        pdf.text(margins.left, 300, "Address:");

	        // Information (if exists)
	        if (document.getElementById('guardianInfo') != null) {
		        var name = document.getElementById("guardianName").innerHTML;
		        var relation = document.getElementById("guardianRelation").innerHTML;
		        var contact = document.getElementById("guardianContact").innerHTML;
		        var email = document.getElementById("guardianEmail").innerHTML;
		        var address = document.getElementById("guardianAddress").innerHTML;
		        pdf.setFontType("normal")
		        pdf.text(140, 220, name);
		        pdf.text(140, 240, relation);
		        pdf.text(140, 260, contact);
		        pdf.text(140, 280, email);
		        pdf.text(140, 300, address);
	        }


        // Most recent checkup information: height, weight, blood type, temperature, bloodpressure, pulse, eyesight left + right, blood sugar
        pdf.setFontSize(16);
        pdf.text(350, 100, "Last Checkup");

	        // Headings
	        pdf.setFontSize(12);
	        pdf.setFontType("bold");
	        pdf.text(350, 120, "Height:");
	        pdf.text(350, 140, "Weight:");
	        pdf.text(350, 160, "Blood Type:");
	        pdf.text(350, 180, "Temperature:");
	        pdf.text(350, 200, "Blood Pressure:");
	        pdf.text(350, 220, "Eye Sight:");
	        pdf.text(350, 240, "Blood Sugar:");

	        // Information 
	        var height = document.getElementById("patientHeight").innerHTML;
	        var wieght = document.getElementById("patientWeight").innerHTML;
	        var bloodType = document.getElementById("patientBloodType").innerHTML;
	        var temperature = document.getElementById("patientTemperature").innerHTML;
	        var bloodPressure = document.getElementById("patientBloodPressure").innerHTML;
	        var pulse = document.getElementById("patientPulse").innerHTML;
	        var eyeSightLeft = document.getElementById("patientEyeSightLeft").innerHTML;
	        var eyeSightRight = document.getElementById("patientEyeSightRight").innerHTML;
	        var bloodSugar = document.getElementById("patientBloodSugar").innerHTML;
	        pdf.setFontType("normal")
	        pdf.text(450, 120, height);
	        pdf.text(450, 140, wieght);
	        pdf.text(450, 160, bloodType);
	        pdf.text(450, 180, temperature);
	        pdf.text(450, 200, bloodPressure + " " + pulse);
	        pdf.text(450, 220, eyeSightLeft + " " + eyeSightRight);
	        pdf.text(450, 240, bloodSugar);

	    // Conditions
        pdf.setFontSize(16);
        pdf.text(margins.left, 340, "Conditions");

			// Headings
	        pdf.setFontSize(12);
	        pdf.setFontType("bold");
	        pdf.text(margins.left, 360, "Condition:");
	        pdf.text(140, 360, "Date:");
	        pdf.text(240, 360, "Medication:");

			// Rows
	        pdf.setFontType("normal")
			var rows = document.getElementById("patientConditions").getElementsByTagName("tr").length;
			for (i = 1; i < rows; i++) {
				// get numbered row
				var condition = document.getElementById("patientCondition" + i).innerHTML;
				var date = document.getElementById("patientConditionDate" + i).innerHTML;
				var medication = document.getElementById("patientMedication" + i).innerHTML;
	        	pdf.text(margins.left, (360 + (20 * i)), condition);
	        	pdf.text(140, (360 + (20 * i)), date);
	        	pdf.text(240, (360 + (20 * i)), medication);
			}
			// set end of table
			var conditionEnd = (360 + 20 + (20 * i));

	    // Allergies
        pdf.setFontSize(16);
        pdf.text(margins.left, conditionEnd, "Allergies");

			// Headings
	        pdf.setFontSize(12);
	        pdf.setFontType("bold");
	        pdf.text(margins.left, conditionEnd + 20, "Allergy:");
	        pdf.text(140, conditionEnd + 20, "Date:");
	        pdf.text(240, conditionEnd + 20, "Severity:");

			// Rows
	        pdf.setFontType("normal")
			var rows = document.getElementById("patientAllergies").getElementsByTagName("tr").length;
			for (i = 1; i < rows; i++) {
				// get numbered row
				var allergy = document.getElementById("patientAllergy" + i).innerHTML;
				var date = document.getElementById("patientAllergyDate" + i).innerHTML;
				var severity = document.getElementById("patientSeverity" + i).innerHTML;
	        	pdf.text(margins.left, (conditionEnd + 20 + (20 * i)), allergy);
	        	pdf.text(140, (conditionEnd + 20 + (20 * i)), date);
	        	pdf.text(240, (conditionEnd + 20 + (20 * i)), severity);
			}
			// set end of table
			var allergyEnd = (conditionEnd + 20 + 20 + (20 * i));

	    // Nurse Observations
        pdf.setFontSize(16);
        pdf.text(margins.left, allergyEnd, "Nurse Observations");

	    	// get number of lis
	        pdf.setFontSize(12);
	    	var observations = $('ul.observationNumber>li').length;
	    	for (i = 1; i <= observations; i++) {
	    		// get
	    		var title = document.getElementById("observationTitle" + i).innerHTML;
	    		var details = document.getElementById("observationDetails" + i).innerHTML;
	    		var content = document.getElementById("observation" + i).innerHTML;
	        	pdf.setFontType("bold");
	        	pdf.text(margins.left, (allergyEnd + (20 * i)), title + " - " + details);
	       		pdf.setFontType("normal")
	        	pdf.text(margins.left, (allergyEnd + 20 + (20 * i)), content);
	    	}

        pdf.output('dataurlnewwindow');
        //pdf.save('Test.pdf');
        console.log(pdf);
	}
</script>


<script type="text/javascript">

function timer(){
	var d = new Date();
	var hours = d.getHours(); 
	var ampm = hours >= 12 ? 'pm' : 'am';
	var minutes = d.getMinutes();
	var m = d.getMonth();
	var month = ["January","February","March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	var date = d.getDate();
	hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? '0'+minutes : minutes;

	document.getElementById("clock").innerHTML=hours + " : " + minutes + " " + ampm + " | " + month[m] + " " + date;
	t = setTimeout(function () {
        timer();
    }, 500);
}


$(document).ready(function(){
  $(".profile").click(function(){
    $(".dropdownProfile").toggle(150);
  });
});

function load() {
	timer();
	active();
}

</script>





	<title> <?php echo $pageTitle; ?> - TCH  </title>


</head>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Content ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<body onload="load()">


<div class="header">
	<div class="logo">
		<img src="../images/logo_white.png" alt="logo" />
	</div>
	<div class="timer">
		<span id="clock"></span>
	</div>
	<div class="profile">
		<!-- PHP needed for updated staff info/photo -->
		<?php
			$staffID = $_SESSION['user'];
			$sql = "SELECT staffID, firstName, lastName, title, specialties, photo
					FROM staff
					WHERE staffID = '$staffID'";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);

		echo "<div class='pic'>";
			echo $row['photo'];
		echo "</div>";

		echo "<div class='name'>";
			echo "<span class='title'>";
			/*if ($row['title'] == 1) { // Doctor
				echo "Dr. ";
			} else if ($row['title'] == 2) { // Nurse
				echo "Nurse ";
			} else if ($row['title'] == 3) { // Medical Technician
				echo "Med Tech. ";// uhh
			} else if ($row['title'] == 4) { // Receptionist
				echo "Rec. ";// uhh
			} else if ($row['title'] == 5) { // Administrator
				echo "Admin ";
			}*/
			switch ($row['title']) {
				case 1:	echo "Dr. ";
					break;
				
				case 2: echo "Nurse ";
					break;

				case 3: echo "Med Tech. ";
					break;

				case 4: echo "Rec. ";
					break;

				case 5: echo "Admin ";
					break;

				default:
					break;
			}
			echo $row['firstName'] . " " . $row['lastName'] . "</span> <br />";
				echo "<span class='spec'>{$row['specialties']}</span>";
		echo "</div>";
		?>
		<div class="triangle1"></div>
	</div>
	<div class="dropdownProfile">
		<div class="triangle2"></div>
		<ul>
			<li> <a href="profile.php">Profile</a> </li>
			<li class="set"> <a href="#">Settings</a> </li>
			<li class="logout"> 
				<?php
					if (isset($_SESSION['user']))
					{
						echo "<a href='logout.php'>Logout</a>";
					}
				?>
			</li>
		</ul>
	</div>
	<div id="breadcrumb">
		<span><?php echo $breadcrumb ?></span>
	</div>
</div>

<div class="panal">

<div class="extent"> </div>

<?php
// admin has more functions than the rest of the roles, so
/*if ($_SESSION['title'] == 5) {
	echo "
	<a href='home.php' id='m1'>
	<div class='layer effect'>
		<div class='mask'></div>
	 	<div class='icon'>
	 		<img src='../images/i1s.png' alt='dashboardICON' />
	 	</div>
	 	<div class='lable'>
	 		<span>Dashboard</span>
	 	</div>
	</div></a>

	<a href='patientsfinder.php' id='m2'>
	<div class='layer effect'>
	 	<div class='mask'></div>
	 	<div class='icon'>
	 		<img src='../images/i2s.png' alt='patientsICON' />
	 	</div>
	 	<div class='lable'>
	 		<span>Patients Finder</span>
	 	</div>
	</div></a>

	<a href='staffmanager.php' id='m2a'>
	<div class='layer effect'>
	 	<div class='mask'></div>
	 	<div class='icon'>
	 		<img src='../images/i2s.png' alt='patientsICON' />
	 	</div>
	 	<div class='lable'>
	 		<span>Staff Manager</span>
	 	</div>
	</div></a>

	<a href='recordsmenu.php' id='m2b'>
	<div class='layer effect'>
	 	<div class='mask'></div>
	 	<div class='icon'>
	 		<img src='../images/i2s.png' alt='patientsICON' />
	 	</div>
	 	<div class='lable'>
	 		<span>Records Menu</span>
	 	</div>
	</div></a>

	<a href='schedule.php' id='m3'>
	<div class='layer effect'>
	 	<div class='mask'></div>
	 	<div class='icon'>
	 		<img src='../images/i3s.png' alt='scheduleICON' />
	 	</div>
	 	<div class='lable'>
	 		<span>Schedule</span>
	 	</div>
	</div></a>

	<a href='notes.php' id='m4'>
	<div class='layer effect' id='m4'>
		<div class='mask'></div>
		<div class='icon'>
			<img src='../images/i4s.png' alt='noteICON' />
		</div>
		<div class='lable'>
			<span>Notes</span>
		</div>
	</div></a>
	";
} else {
	echo "
	<a href='home.php' id='m1'>
	<div class='layer effect'>
		<div class='mask'></div>
	 	<div class='icon'>
	 		<img src='../images/i1s.png' alt='dashboardICON' />
	 	</div>
	 	<div class='lable'>
	 		<span>Dashboard</span>
	 	</div>
	</div></a>

	<a href='patientsfinder.php' id='m2'>
	<div class='layer effect'>
	 	<div class='mask'></div>
	 	<div class='icon'>
	 		<img src='../images/i2s.png' alt='patientsICON' />
	 	</div>
	 	<div class='lable'>
	 		<span>Patients Finder</span>
	 	</div>
	</div></a>

	<a href='schedule.php' id='m3'>
	<div class='layer effect'>
	 	<div class='mask'></div>
	 	<div class='icon'>
	 		<img src='../images/i3s.png' alt='scheduleICON' />
	 	</div>
	 	<div class='lable'>
	 		<span>Schedule</span>
	 	</div>
	</div></a>

	<a href='notes.php' id='m4'>
	<div class='layer effect' id='m4'>
		<div class='mask'></div>
		<div class='icon'>
			<img src='../images/i4s.png' alt='noteICON' />
		</div>
		<div class='lable'>
			<span>Notes</span>
		</div>
	</div></a>
	";
}*/
?>
<a href='home.php' id='m1'>
<div class='layer effect'>
	<div class='mask'></div>
 	<div class='icon'>
 		<img src='../images/i1s.png' alt='dashboardICON' />
 	</div>
 	<div class='lable'>
 		<span>Dashboard</span>
 	</div>
</div></a>

<a href='patientsfinder.php' id='m2'>
<div class='layer effect'>
 	<div class='mask'></div>
 	<div class='icon'>
 		<img src='../images/i2s.png' alt='patientsICON' />
 	</div>
 	<div class='lable'>
 		<span>Patients Finder</span>
 	</div>
</div></a>

<?php
/* Different functions for different roles go here:
	Doctor:
	Nurse:
	Medical Technician:
	Receptionist:
	Administrator:
	*/

switch ($_SESSION['title']) {
	case 4: // Receptionist
		echo "
		<a href='patientadd.php' id='m2a'>
		<div class='layer effect'>
		 	<div class='mask'></div>
		 	<div class='icon'>
		 		<img src='../images/i2s.png' alt='patientsICON' />
		 	</div>
		 	<div class='lable'>
		 		<span>Admit New</span>
		 	</div>
		</div></a>

		<a href='patientadmit.php' id='m2b'>
		<div class='layer effect'>
		 	<div class='mask'></div>
		 	<div class='icon'>
		 		<img src='../images/i2s.png' alt='patientsICON' />
		 	</div>
		 	<div class='lable'>
		 		<span>Admit Existing</span>
		 	</div>
		</div></a>

		<a href='patientdischarge.php' id='m2c'>
		<div class='layer effect'>
		 	<div class='mask'></div>
		 	<div class='icon'>
		 		<img src='../images/i2s.png' alt='patientsICON' />
		 	</div>
		 	<div class='lable'>
		 		<span>Discharge</span>
		 	</div>
		</div></a>
		";
		break;

	case 5: // Admin
		echo "
		<a href='staffmanager.php' id='m2a'>
		<div class='layer effect'>
		 	<div class='mask'></div>
		 	<div class='icon'>
		 		<img src='../images/i2s.png' alt='patientsICON' />
		 	</div>
		 	<div class='lable'>
		 		<span>Staff Manager</span>
		 	</div>
		</div></a>

		<a href='recordsmenu.php' id='m2b'>
		<div class='layer effect'>
		 	<div class='mask'></div>
		 	<div class='icon'>
		 		<img src='../images/i2s.png' alt='patientsICON' />
		 	</div>
		 	<div class='lable'>
		 		<span>Records Menu</span>
		 	</div>
		</div></a>
		";
		break;

	default:
		break;
}
?>

<a href='schedule.php' id='m3'>
<div class='layer effect'>
 	<div class='mask'></div>
 	<div class='icon'>
 		<img src='../images/i3s.png' alt='scheduleICON' />
 	</div>
 	<div class='lable'>
 		<span>Schedule</span>
 	</div>
</div></a>

<a href='notes.php' id='m4'>
<div class='layer effect' id='m4'>
	<div class='mask'></div>
	<div class='icon'>
		<img src='../images/i4s.png' alt='noteICON' />
	</div>
	<div class='lable'>
		<span>Notes</span>
	</div>
</div></a>

</div>

<div class="content">