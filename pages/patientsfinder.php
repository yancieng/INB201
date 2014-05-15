<?php
	include '../inc/dbconnect.php';
	// if no user is logged in, redirect to login.php with error message
	include '../inc/loginCheck.php';

	$pageTitle = "Patients Finder";
	$breadcrumb = "<a href='home.php'>Home</a> > " . $pageTitle;
	include '../inc/panel.php';
?>

<!-- The coresponding active panal (the menu) of this page
	 change this number for each different page -->
<script>activePanel("m2");

$(document).ready(function(){
  $(".dropdown-toggle").click(function(){
    $(".dropdown-menu").toggle(150);
  });
});

function select(p){
	document.getElementById('dropdown-label').innerHTML=p.innerHTML;
}

</script>

<link type="text/css" rel="stylesheet" href="../css/patientsfinder.css" media="screen" /> 

<!-- Content goes here -->

<div class="leftContent">

	<!-- This DIV is the search criteria -->
	<div class="box patientSearch">
		<section class="boxTitle">
			<p>Search for patients</p>
		</section>
		<section class="boxContent">
			<form action="searchprocess.php" method="get">
				<p>Patient ID: </p>
				<input type="text" name="patientID" value="Patient ID" onfocus="if (this.value==this.defaultValue) this.value = ''" 
 onblur="if (this.value=='') this.value = this.defaultValue" class="pIDinput textInput">
				<p class="or">or</p>
				<div class="firstName">
					<p for="firstName" class="firstNameL" >Frist name: </p>
					<input type="text" class="firstNameInput textInput" value="First Name" onfocus="if (this.value==this.defaultValue) this.value = ''" 
 onblur="if (this.value=='') this.value = this.defaultValue" name="firstName">
				</div>
				<div class="lastname">
					<p for="lastName" class="lastNameL" >Last name: </p>
					<input type="text" class="lastNameInput textInput" value="Last Name" onfocus="if (this.value==this.defaultValue) this.value = ''" 
 onblur="if (this.value=='') this.value = this.defaultValue" name="lastName">
				</div>
				<!-- <p class="or">or</p>
				<p>Phone: </p>
				<input type="text" name="phone" value="Phone Number" onfocus="if (this.value==this.defaultValue) this.value = ''" 
 onblur="if (this.value=='') this.value = this.defaultValue" class="phoneInput textInput"> -->
				<button type="submit" class="submit">Search</button>
			</form>
		</section>
	</div>




	<!-- This DIV is for the 'Advanced Search' -->

	<div class="box advancedSearch">
		<section class="boxTitle">
			<p>Advanced Search</p>
		</section>
		<section class="boxContent">
			<form action="searchadvanced.php" method="get">
				<!-- Advanced Search: parameters for uhh, DOB, what else -->
				<div class="parameters">
					<p> Parameters: </p>
					<!-- Using a select for the moment -->
					<select name="parameter">
						<option>Please Select</option>
						<option>DOB</option>
						<option>Height</option>
						<option>Weight</option>
						<option>Blood Type</option>
					</select>
				</div>
				<div class="parameterInput">
					<p> Value: </p>
					<input type="text" name="value" class="textInput"><br>
				</div>
				<button type="submit" class="submit">Search</button>
			</form>
		</section>	
	</div>


</div>

<div class="rightContent">
	
	<!-- This DIV is for the 'Top 10 patients' -->
	<div class="box topTen">
		<section class="boxTitle">
			<p>10 most recent patients</p>
		</section>
		<section class="boxContent">
		
		<!-- This table is for the 'Top 10 patients' -->
			<table>
				<?php
				// Top 10 Patients

				// Normally, this would be the last 10 patients that have had a checkup?
				// But for now, it'll just be the last 10 patients registered in the system

				// Final sql to use: when enough checkups are in database
				/*$sql = "SELECT patientID, firstName, lastName
						FROM patients INNER JOIN checkups USING (patientID)
						GROUP BY patientID
						ORDER BY timestamp DESC";*/
				
				$sql = "SELECT patientID, firstName, lastName
						FROM patients
						ORDER BY patientID DESC";
				$result = mysql_query($sql);

				for ($i = 1; $i <= 10; $i++) {
					$row = mysql_fetch_assoc($result);
					echo "<tr>";
						if($i != 10) {echo "<td>";}
						else {echo "<td class='last'>";};
						echo "<a href='patientview.php?patient={$row['patientID']}'>{$i}. &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{$row['lastName']}, &nbsp{$row['firstName']}</a></td>";
					echo "</tr>";
				}
				?>
			</table>
		</section>
	</div>

</div>

	
<?php
	include '../inc/footer.php';
?>

