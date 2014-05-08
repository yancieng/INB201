<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

	<link type="text/css" rel="stylesheet" href="../css/panel.css" media="screen" /> 
	<link type="text/css" rel="stylesheet" href="../css/style.css" media="screen" /> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="../js/activePanel.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Javascrpit ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

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

 <a href="home.php" id="m1">
 <div class="layer effect">
 	<div class="mask"></div>
 	<div class="icon">
 		<img src="../images/i1s.png" alt="dashboardICON" />
 	</div>
 	<div class="lable">
 		<span>Dashboard</span>
 	</div>
 </div></a>

  <a href="patientsfinder.php" id="m2">
  <div class="layer effect">
 	<div class="mask"></div>
 	<div class="icon">
 		<img src="../images/i2s.png" alt="patientsICON" />
 	</div>
 	<div class="lable">
 		<span>Patients Finder</span>
 	</div>
 </div></a>

  <a href="schedule.php" id="m3">
   <div class="layer effect">
 	<div class="mask"></div>
 	<div class="icon">
 		<img src="../images/i3s.png" alt="scheduleICON" />
 	</div>
 	<div class="lable">
 		<span>Schedule</span>
 	</div>
 </div></a>

    <a href="notes.php" id="m4">
    	<div class="layer effect" id="m4">
 			<div class="mask"></div>
 			<div class="icon">
 				<img src="../images/i4s.png" alt="noteICON" />
 			</div>
 			<div class="lable">
 				<span>Notes</span>
 			</div>
 		</div>
 	</a>


</div>

<div class="content">