<?php
	include '../inc/dbconnect.php';
	// add "if already logged in" functionality
	if (isset($_SESSION['user'])) {
		header("Location: home.php");
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

	<!-- <link type="text/css" rel="stylesheet" href="style.css" media="screen" /> 
	<script type="text/javascript" src="javascript.js"></script>  -->


<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Css ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<style type="text/css">


body {
	font-family: sans-serif;
	background-image: url("../images/bg.jpg");
	background-size: 100%;
}

/*********  CSS for the rising animation to the login form when the page loads *********/

@keyframes "login" {
 0% {
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
   	filter: alpha(opacity=0);
   	opacity: 0;
   	margin-top: -50px;
 }
 100% {
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
   	filter: alpha(opacity=100);
   	opacity: 1;
   	margin-top: -75px;
 }

}

@-moz-keyframes login {
 0% {
   filter: alpha(opacity=0);
   opacity: 0;
   margin-top: -50px;
 }
 100% {
   filter: alpha(opacity=100);
   opacity: 1;
   margin-top: -75px;
 }

}

@-webkit-keyframes "login" {
 0% {
   filter: alpha(opacity=0);
   opacity: 0;
   margin-top: -50px;
 }
 100% {
   filter: alpha(opacity=100);
   opacity: 1;
   margin-top: -75px;
 }

}

@-ms-keyframes "login" {
 0% {
   -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
   filter: alpha(opacity=0);
   opacity: 0;
   margin-top: -50px;
 }
 100% {
   -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
   filter: alpha(opacity=100);
   opacity: 1;
   margin-top: -75px;
 }

}

@-o-keyframes "login" {
 0% {
   filter: alpha(opacity=0);
   opacity: 0;
   margin-top: -50px;
 }
 100% {
   filter: alpha(opacity=100);
   opacity: 1;
   margin-top: -75px;
 }

}

#logo {
	width: 30%;
	position: absolute;
    left: 55%;
    top: 10%;
    display:none;   /* Logo added but too ugly , so i just hide it.*/
}

#login {
	/* login from basics */
    width: 220px;
    height: 155px;
    position: absolute;
    left: 70%;
    top: 34%;
    margin-left: -110px;
    margin-top: -75px;

    -webkit-animation: login 1s ease-in-out;
	-moz-animation: login 1s ease-in-out;
	-ms-animation: login 1s ease-in-out;
	-o-animation: login 1s ease-in-out;
	animation: login 1s ease-in-out;
}

#login h1 {
	/* Tittle text */
	font-size: 41px;
	color: white;
	font-family: 'Myriad Pro', 'Myriad', helvetica, arial, sans-serif;
	text-shadow: 2px 3px 3px #292929;
	-webkit-text-stroke: 1px white;
	/*-webkit-mask-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,1)), color-stop(50%, rgba(0,0,0,0.8)), to(rgba(0,0,0,1)));*/
	text-shadow: 0 2px 0 #e9e9e9;
	-webkit-transition: all .3s;
	-moz-transition: all .3s;
	transition: all .3s;
	margin-bottom: 10px;
}


/**** error messages ****/

#login p {
  padding-left: 10px;
  font-size: 12px;
  font-weight: bold;
}

#success {
  color: #42a145;
}

#error {
  color: #ee6d6d;
}
	

#login label {
	display: none;
}

.placeholder {
    color: #444;
}

/******** Input boxes ********/

#login input[type="text"],#login input[type="password"] {
    width: 100%;
    height: 40px;
    position: relative;
    margin-top: 7px;
    font-size: 14px;
    color: #444;
    outline: none;
    border: 1px solid rgba(0, 0, 0, .49);
 
    padding-left: 20px;
     
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding-box;
    background-clip: padding-box;
    border-radius: 6px;
 
    background-color: #fff;
    background-image: -webkit-linear-gradient(bottom, #FFFFFF 0%, #F2F2F2 100%);
    background-image: -moz-linear-gradient(bottom, #FFFFFF 0%, #F2F2F2 100%);
    background-image: -o-linear-gradient(bottom, #FFFFFF 0%, #F2F2F2 100%);
    background-image: -ms-linear-gradient(bottom, #FFFFFF 0%, #F2F2F2 100%);
    background-image: linear-gradient(bottom, #FFFFFF 0%, #F2F2F2 100%);
 
    -webkit-box-shadow: inset 0px 2px 0px #d9d9d9;
    box-shadow: inset 0px 2px 0px #d9d9d9;

	-webkit-transition: all .1s ease-in-out;
	-moz-transition: all .1s ease-in-out;
	-o-transition: all .1s ease-in-out;
	-ms-transition: all .1s ease-in-out;
	transition: all .1s ease-in-out;

   /* opacity:0.5;
	filter:alpha(opacity=50);*/
 
}
 
#login input[type="text"]:focus,#login input[type="password"]:focus {
    -webkit-box-shadow: inset 0px 2px 0px #a7a7a7;
    box-shadow: inset 0px 2px 0px #a7a7a7;
}
 
#login input:first-child {
    margin-top: 0px;
}

/********* Submit button and it's colors *********/

#login input[type="submit"] {
    width: 110%;
    height: 50px;
    margin-top: 7px;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    text-shadow: 0px -1px 0px #5b6ddc;
    outline: none;
    border: 1px solid rgba(0, 0, 0, .49);
 
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding-box;
    background-clip: padding-box;
    border-radius: 6px;
 
    background-color: #7ada54;
    background-image: -webkit-linear-gradient(bottom, #7ada54 0%, #9fe476 100%);
    background-image: -moz-linear-gradient(bottom, #7ada54 0%, #9fe476 100%);
    background-image: -o-linear-gradient(bottom, #7ada54 0%, #9fe476 100%);
    background-image: -ms-linear-gradient(bottom, #7ada54 0%, #9fe476 100%);
    background-image: linear-gradient(bottom, #7ada54 0%, #9fe476 100%);
 
    cursor: pointer;
     
    -webkit-box-shadow: inset 0px 1px 0px #bbec9a;
    box-shadow: inset 0px 1px 0px #bbec9a;

    -webkit-transition: all .1s ease-in-out;
	-moz-transition: all .1s ease-in-out;
	-o-transition: all .1s ease-in-out;
	-ms-transition: all .1s ease-in-out;
	transition: all .1s ease-in-out;
 
}
 
#login input[type="submit"]:hover {
    background-color: #93e95f;
    background-image: -webkit-linear-gradient(bottom, #93e95f 0%, #adef85 100%);
    background-image: -moz-linear-gradient(bottom, #93e95f 0%, #adef85 100%);
    background-image: -o-linear-gradient(bottom, #93e95f 0%, #adef85 100%);
    background-image: -ms-linear-gradient(bottom, #93e95f 0%, #adef85 100%);
    background-image: linear-gradient(bottom, #93e95f 0%, #adef85 100%);
 
    -webkit-box-shadow: inset 0px 1px 0px #c6f4aa;
    box-shadow: inset 0px 1px 0px #c6f4aa;
     
    margin-top: 10px;
}
 
#login input[type="submit"]:active {
    background-color: #9be175;
    background-image: -webkit-linear-gradient(bottom, #9be175 0%, #95df71 100%);
    background-image: -moz-linear-gradient(bottom, #9be175 0%, #95df71 100%);
    background-image: -o-linear-gradient(bottom, #9be175 0%, #95df71 100%);
    background-image: -ms-linear-gradient(bottom, #9be175 0%, #95df71 100%);
    background-image: linear-gradient(bottom, #9be175 0%, #95df71 100%);
 
    -webkit-box-shadow: inset 0px 1px 0px #afe993;
    box-shadow: inset 0px 1px 0px #afe993;
}



</style>



	<title>  TC Hospital </title>


</head>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Content ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<body>

<img src="logo.png" alt="logo" id="logo"/>  <!-- this element is hidden -->


<form id="login" method="post" action="loginprocess.php">
	<h1>TC Hospital</h1>
	<label for="username">username</label><input type="text" name="staffID" class="placeholder" placeholder="user ID">
	<label for="password">password</label><input type="password" name="password" class="placeholder" placeholder="password">
	
	<?php
			// if incorrect login credentials, show message
			if (isset($_SESSION['loginerror'])) {
				echo "<p id='error'>" . $_SESSION['loginerror'] . "</p>";
				unset($_SESSION['loginerror']);
			}
			// when logged out, display message
			if (isset($_SESSION['logout'])) {
				echo "<p id='success'>" . $_SESSION['logout'] . "</p>";
				unset($_SESSION['logout']);
			}
		?>
	

	<input type="submit" name="commit" value="Login">
</form>














</body>

</html>


