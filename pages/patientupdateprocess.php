<style type="text/css">
	html{
		background:#222;
		font-size:12px;
		font-family:Arial;
	}

	ul#breadcrumbs{         
		list-style:none;
		/* optional */
		margin:100px;
		padding:10px 2px 10px 10px;
		background:#000;
		width:295px;
		height:30px;
		border-radius:5px;
		border:1px solid #222;
		-moz-box-shadow:0 0 3px 0 #000;
	}
	ul#breadcrumbs li{
		float:left;
		background:#93ce68 url(bg.png)no-repeat right;
		eight:30px;
		adding:0 23px 0 10px;
		text-align:center;
		text-decoration:none;
		color:#000;
		line-height:32px;
	}
	ul#breadcrumbs li.active{
		background:url(bg.png)no-repeat right;
		color:#000;
	}
	ul#breadcrumbs li a{
		display:block;
		text-decoration:none;
		color:#fff;
		line-height:32px;
		text-shadow:0 0 2px #222;
	}
	ul#breadcrumbs li a:hover{
		color:#a2ff00;
	}

</style>
	
<ul id="breadcrumbs">
	<li><a href="">Home</a></li>
	<li><a href="">Page1</a></li>
	<li><a href="">Page2</a></li>
	<li class="active">About Us</li>
</ul>

<?php
	include '../inc/dbconnect.php';

	// get data from previous form: patientID, firstName, lastName, address (patientAddress), DOB, contactNumber, emergencyNumber, caregiverNumber, bloodType, previousNotes
	$patientID = $_POST['patientID'];
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$address = mysql_escape_string($_POST['patientAddress']);
	$DOB = mysql_escape_string($_POST['DOB']);
	$contactNumber = mysql_escape_string($_POST['contactNumber']);
	$emergencyNumber = mysql_escape_string($_POST['emergencyNumber']);
	$caregiverNumber = mysql_escape_string($_POST['caregiverNumber']);
	$bloodType = mysql_escape_string($_POST['bloodType']);
	$previousNotes = mysql_escape_string($_POST['previousNotes']);

	// if optional fields are blank, make them NULL
	if ($emergencyNumber == '') {
		$emergencyNumber = NULL;
	}
	if ($caregiverNumber == '') {
		$caregiverNumber = NULL;
	}
	if ($previousNotes == '') {
		$previousNotes = NULL;
	}

	// if required fields are blank, redirect to patientview.php with error
	if (
		(($firstName == '')
		|| ($lastName == '')
		|| ($address == '')
		|| ($DOB == '')
		|| ($contactNumber == '')
		|| ($bloodType == ''))
	) {
		$_SESSION['patienterror'] = "ALL required fields need to be filled. Don't just delete data like that.";
		header ("Location: patientview.php?patient={$patientID}");
	} else {
		$sql = "UPDATE patients
				SET firstName = '{$firstName}',
					lastName = '{$lastName}',
					address = '{$address}',
					DOB = '{$DOB}',
					contactNumber = '{$contactNumber}',
					emergencyNumber = '{$emergencyNumber}',
					caregiverNumber = '{$caregiverNumber}',
					bloodType = '{$bloodType}',
					previousNotes = '{$previousNotes}'
				WHERE patientID = '{$patientID}'";

		if (mysql_query($sql)) {		
			// redirect to the patientview.php page with success message
			$_SESSION['patientsuccess'] = "Patient {$lastName}, {$firstName} was updated successfully.";
			header ("Location: patientview.php?patient={$patientID}");
		} else {
			// kick back with error message: sql
			$_SESSION['patienterror'] = "There was an error in updating the data.";
			header ("Location: patientview.php?patient={$patientID}");
		}
	}
?>