<?php
	include '../inc/dbconnect.php';

	// get data from form: patientID, existing, firstName, lastName, title, relation, contactNumber, email, address, photo
	$patientID = $_POST['patientID'];
	$existing = mysql_escape_string($_POST['existing']);
	$existingRelation = mysql_escape_string($_POST['existingRelation']);
	$firstName = mysql_escape_string($_POST['firstName']);
	$lastName = mysql_escape_string($_POST['lastName']);
	$title = mysql_escape_string($_POST['title']);
	$relation = mysql_escape_string($_POST['relation']);
	$contactNumber = mysql_escape_string($_POST['contactNumber']);
	$email = mysql_escape_string($_POST['email']);
	$address = mysql_escape_string($_POST['address']);

	// check for existing
	if ($existing != "Select") {
		// check to see if relation is filled or not
		if ($existingRelation != '') {
			// assign guardian to patient
			$sql = "INSERT INTO patients_guardians (patientID, guardianID, relation)
					VALUES ({$patientID}, {$existing}, '{$existingRelation}')";

			if (mysql_query($sql)) {
				// redirect to the patientupdate.php page with success message
				$_SESSION['guardiansuccess'] = "Guardian was assigned successfully.";
				header ("Location: patientupdate.php?patient={$patientID}");
			} else {
				// kick back with error message: sql
				$_SESSION['guardianerror'] = "There was an error in assigning the data.";
				header ("Location: patientupdate.php?patient={$patientID}");
			}
		} else {
			$_SESSION['guardianerror'] = "The \"Relation\" field needs to be filled.";
			header ("Location: patientupdate.php?patient={$patientID}");
		}
	} else {
		// if required fields are blank, redirect to patientupdate.php with error
		if (
			(($firstName == '')
			|| ($lastName == '')
			|| ($title == '')
			|| ($relation == '')
			|| ($contactNumber == '')
			|| ($email == '')
			|| ($address == ''))
		) {
			$_SESSION['guardianerror'] = "All required fields need to be filled.";
			header ("Location: patientupdate.php?patient={$patientID}");
		} else {

			if ($_FILES['photo']['name'] != '') {
				$photo = $_FILES['photo']['name'];

				// photo renaming and location
				$randomDigit = rand(0000,9999);
				$newPhotoName = ($randomDigit . "_" . $photo);
				$target = "../images/" . $newPhotoName;
				$allowedExts = array('jpg', 'jpeg', 'gif', 'png');
				$tmp = explode('.', $_FILES['photo']['name']);
				$extension = end($tmp);

				// photo name for database
				$photo = "<img src=\"{$target}\" alt=\"Patient Picture\">";

				// if photo is not an allowed extension, kickback with error
				if (((($_FILES['photo']['type'] == 'image/gif')
					|| ($_FILES['photo']['type'] == 'image/jpeg')
					|| ($_FILES['photo']['type'] == 'image/jpg')
					|| ($_FILES['photo']['type'] == 'image/png'))
					&& 
					in_array($extension, $allowedExts))
				) {
					$sql = "INSERT INTO guardians (firstName, lastName, title, contactNumber, email, address, photo)
						VALUES ('{$firstName}', '{$lastName}', '{$title}', '{$contactNumber}', '{$email}', '{$address}', '{$photo}')";
				} else {
					$_SESSION['stafferror'] = "The file you uploaded is not valid. Photos must be in either .gif, .jpg, or .png format.";
					header ("Location: profile.php");
				}
			} else {
				// add information to database
				$sql = "INSERT INTO guardians (firstName, lastName, title, contactNumber, email, address)
						VALUES ('{$firstName}', '{$lastName}', '{$title}', '{$contactNumber}', '{$email}', '{$address}')";
			}

			if (mysql_query($sql)) {
				// move photo (if exists)
				if ($_FILES['photo']['name'] != '') {
					move_uploaded_file($_FILES['photo']['tmp_name'], $target);
				}

				// use resulting guardianID to add patients_guardians row
				$sql = "SELECT guardianID
						FROM guardians
						WHERE firstName = '{$firstName}'
						AND lastName = '{$lastName}'
						AND email = '{$email}'";
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);
				$guardianID = $row['guardianID'];

				$sql = "INSERT INTO patients_guardians (patientID, guardianID, relation)
						VALUES ({$patientID}, {$guardianID}, '{$relation}')";

				if (mysql_query($sql)) {
					// redirect to the patientupdate.php page with success message
					$_SESSION['guardiansuccess'] = "Guardian {$lastName}, {$firstName} was added successfully.";
					header ("Location: patientupdate.php?patient={$patientID}");
				} else {
					// kick back with error message: sql
					$_SESSION['guardianerror'] = "There was an error in adding the bridging data.";
					header ("Location: patientupdate.php?patient={$patientID}");
				}
			} else {
				// kick back with error message: sql
				$_SESSION['guardianerror'] = "There was an error in adding the data.";
				header ("Location: patientupdate.php?patient={$patientID}");
			}
		}
	}
?>