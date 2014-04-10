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
			<img src="../images/profile.jpg" alt="Profile picture" />
		</div>
		<div class="name">
			<span class="title"> Dr. John Doe </span> <br />
			<span class="spec"> Cardiologists </span>
		</div>
		<div class="triangle1"></div>
	</div>
	<div class="dropdown">
		<div class="triangle2"></div>
		<ul>
			<li> <a href="#">Profile</a> </li>
			<li class="set"> <a href="#"> Settings</a> </li>
			<li class="logout"> <a href="#">Logout</a> </li>
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

<p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>

</div>








</body>


<script type="text/javascript">
	function active() {

		var no = "m1"; //The coresponding active panal (the menu) of this page
		// change this number for each different page, or is there a better way?

		document.getElementById(no).className = ' active';
		document.getElementById(no).href = "#" ;
		document.getElementById(no).style.cursor = "default";
	}

</script>

</html>



