<html>
<head>
<title>VIEW APPOINTMENTS</title>
</head>

<body>

<?php
	include('../CommonMethods.php');
	$debug = false;
	$COMMON = new Common($debug);
	
	$fName = strval($_POST['fName']);
	$lName = strval($_POST['lName']);
	$major = strval($_POST['major']);
	$eMail = strval ($_POST['eMail']);
	$location = strval($_POST['location']);

	$fullName = $fName.' '.$lName;

	$idQuest = "SELECT `count` FROM advisorData WHERE `lName` = '$lName' AND `fName` = '$fName'";
	$tempVal = $COMMON->executeQuery($idQuest, $_SERVER["SCRIPT_NAME"]);
	$idFound = mysql_fetch_row($tempVal);

	$dateQuest = "SELECT `start_time`, `end_time`, `date`, `count`, `max_student` FROM meetingData WHERE `id` = '$idFound[0]'";
	$query = $COMMON->executeQuery($dateQuest, $_SERVER["SCRIPT_NAME"]);
	
	if(mysql_num_rows($query) > 0){
		while($dateFound = mysql_fetch_assoc($query)){
			$date = $dateFound['date'];
			$startTime = $dateFound['start_time'];
			$endTime = $dateFound['end_time'];
			if($dateFound['max_student'] == 10){
				echo("$startTime - $endTime  $date Group<br>");
			}else if($dateFound['max_student'] == 1){
				echo("$startTime - $endTime  $date Individual<br>");
			}
		}
	}else{
		echo("You do not currently have any appointments scheduled. <br><br>");
	}
?>
	<br>
	<form action="menuPage.php" method="post" name="return">
		Return to the main menu <br>
		<input type="submit" name="submit" value="Return">
		<?php
			echo("<input type='hidden' name='fName' value= $fName>");
			echo("<input type='hidden' name='lName' value= $lName>");
			echo("<input type='hidden' name='major' value= $major>");
			echo("<input type='hidden' name='eMail' value= $eMail>");
			echo("<input type='hidden' name='location' value= $location>");
		?>

	</form>
</body>

</html>