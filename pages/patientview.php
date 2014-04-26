<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	if (!isset($_SESSION['user'])) {
		$_SESSION['loginerror'] = "You must be logged in to access this resource.";
		header ("Location: login.php");
	}

	$pageTitle = "Patient {$_GET['patient']}";
	include '../inc/panel.php';
?>

<section>
	<div class="container">
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
            height:30px;
            padding:0 23px 0 10px;
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
			// if patient has just been added, show message
			if (isset($_SESSION['patientsuccess'])) {
				echo "<p id='success'>" . $_SESSION['patientsuccess'] . "</p>";
				unset($_SESSION['patientsuccess']);
			}
			// if editing fails, show message
			if (isset($_SESSION['patienterror'])) {
				echo "<p id='error'>" . $_SESSION['patienterror'] . "</p>";
				unset($_SESSION['patienterror']);
			}
		?>
		<div class="login">
			<!-- Full patient info page. Can edit info if authorised (receptionist, etc.) ?? how -->
			<h1>Patient <?php echo $_GET['patient']; ?></h1>
			<!-- Form layout? if authorised, else just show info -->
			<?php
				$sql = "SELECT *
						FROM patients
						WHERE patientID = {$_GET['patient']}";
				$result = mysql_query($sql);
				$row = mysql_num_rows($result);

				while ($row = mysql_fetch_assoc($result)) {
					echo "<div id='patient'>";
						echo "<form action='patientupdateprocess.php' method='post'>";
							echo "<div>";
								echo "<label for='firstName'>*First Name: </label>";
								echo "<input type='text' name='firstName' id='firstName' value='{$row['firstName']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='lastName'>*Last Name: </label>";
								echo "<input type='text' name='lastName' id='lastName' value='{$row['lastName']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='patientAddress'>*Address: </label>";
								echo "<input type='text' name='patientAddress' id='patientAddress' value='{$row['address']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='DOB'>*DOB: </label>";
								echo "<input type='text' name='DOB' id='DOB' value='{$row['DOB']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='contactNumber'>*Contact Number: </label>";
								echo "<input type='text' name='contactNumber' id='contactNumber' value='{$row['contactNumber']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='emergencyNumber'>Emergency Number: </label>";
								echo "<input type='text' name='emergencyNumber' id='emergencyNumber' value='{$row['emergencyNumber']}' />";
							echo "</div>";
							echo "<div>";
								echo "<label for='caregiverNumber'>Caregiver Number: </label>";
								echo "<input type='text' name='caregiverNumber' id='caregiverNumber' value='{$row['caregiverNumber']}' />";
							echo "</div>";
							echo "<div>";
								echo "<label for='bloodType'>*Blood Type: </label>";
								echo "<input type='text' name='bloodType' id='bloodType' value='{$row['bloodType']}' required />";
							echo "</div>";
							echo "<div>";
								echo "<label for='previousNotes'>Previous Notes: </label>";
								echo "<textarea name='previousNotes' id='previousNotes' cols='32' rows='5'>{$row['previousNotes']}</textarea>";
							echo "</div>";
							echo "<div>";
								// hidden field with patientID
								echo "<input type='hidden' name='patientID' value='{$row['patientID']}' />";
								echo "<button type='submit' class='submit'>Update Information</button>";
							echo "</div>";
						echo "</form>";
					echo "</div>";
				}
			?>
		</div>
	</div>
</section>

 