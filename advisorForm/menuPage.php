<html>
<head>
    <title>MENU</title>
</head>
<body>
	<?php
		include('../CommonMethods.php');
		$debug = false;
		$COMMON = new Common($debug);
		error_reporting(E_ERROR | E_NOTICE | E_PARSE);
		
		$fName = strval ($_POST['fName']);
		$lName = strval ($_POST['lName']);
		$major = strval ($_POST['major']);
		$eMail = strval ($_POST['eMail']);
		$location = strval ($_POST['location']);
		
		$sql = "SELECT * FROM advisorData WHERE eMail = '$eMail'";
		$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		if(mysql_num_rows($result) > 0){//if there is already a student with the same studentID and email in the table
			$row = mysql_fetch_assoc($result);
			//copy their data over instead of making a new student entry
			$fName = $row["fName"];
			$lName = $row["lName"];
			$eMail = $row["eMail"];
			$major = $row["major"];
			$location = $row["location"];
			
			}else{//otherwise create a new student entry with the new data
			$sql = "INSERT INTO advisorData (`count`, `fName`, `lName`, `major`, `eMail`, `location`) VALUES (NULL,'".$fName."','".$lName."', '".$major."', '".$eMail."', '".$location."')";
			$COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			
		}
	?>
<form action="date.php" method="post" name="indivMeeting">
	<?php
		echo("<input type='hidden' name='fName' value= $fName>");
		echo("<input type='hidden' name='lName' value= $lName>");
		echo("<input type='hidden' name='major' value= $major>");
		echo("<input type='hidden' name='eMail' value= $eMail>");
		echo("<input type='hidden' name='location' value= $location>");
	?>
	<input type="submit" name="submit" value="Create Appointments">
</form>
<form action="viewMeeting.php" method="post" name="viewMeeting">
	<input type="submit" name="submit" value="View Appointments">
	<?php
		echo("<input type='hidden' name='fName' value= $fName>");
		echo("<input type='hidden' name='lName' value= $lName>");
		echo("<input type='hidden' name='major' value= $major>");
		echo("<input type='hidden' name='eMail' value= $eMail>");
		echo("<input type='hidden' name='location' value= $location>");
	?>
</form>
<form action="deleteMeeting.php" method="post" name="deleteMeeting">
	<?php
		echo("<input type='hidden' name='fName' value= $fName>");
		echo("<input type='hidden' name='lName' value= $lName>");
		echo("<input type='hidden' name='major' value= $major>");
		echo("<input type='hidden' name='eMail' value= $eMail>");
		echo("<input type='hidden' name='location' value= $location>");
	?>
	<input type="submit" name="submit" value="Cancel Appointments">
</form>
<form action="index.html" method="post" name="Logout">
	<input type="submit" name="sumbit" value="Logout">
</form>

</body>
</html>