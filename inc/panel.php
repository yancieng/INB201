<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

	<link type="text/css" rel="stylesheet" href="../css/panel.css" media="screen" /> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


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
    $(".dropdown").toggle(150);
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
		<div class="pic">
			<?php echo $_SESSION['photo']; ?>
		</div>
		<div class="name">
			<span class="title"> Dr. <?php echo $_SESSION['name']; ?> <?php echo $_SESSION['lname']; ?></span> <br />
			<span class="spec"> <?php echo $_SESSION['spec']; ?> </span>
		</div>
		<div class="triangle1"></div>
	</div>
	<div class="dropdown">
		<div class="triangle2"></div>
		<ul>
			<li> <a href="#">Profile</a> </li>
			<li class="set"> <a href="#"> Settings</a> </li>
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

  <a href="#" id="m2">
  <div class="layer effect">
 	<div class="mask"></div>
 	<div class="icon">
 		<img src="../images/i2s.png" alt="patientsICON" />
 	</div>
 	<div class="lable">
 		<span>Patients Finder</span>
 	</div>
 </div></a>

  <a href="#" id="m3">
   <div class="layer effect">
 	<div class="mask"></div>
 	<div class="icon">
 		<img src="../images/i3s.png" alt="scheduleICON" />
 	</div>
 	<div class="lable">
 		<span>Schedule</span>
 	</div>
 </div></a>

    <a href="#" id="m4">
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

	<img src="../images/con.png" />
