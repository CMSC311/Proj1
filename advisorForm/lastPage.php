<html>
<head>
	<title>SUBMIT</title>
</head>

<body>
	
<?php
	include('../CommonMethods.php');
	$debug = false;
	$COMMON = new Common($debug);
	error_reporting(E_ERROR | E_PARSE);
	
	$fName = strval($_POST['fName']);
	$lName = strval($_POST['lName']);
	$major = strval($_POST['major']);
	$eMail = strval ($_POST['eMail']);
	$location = strval($_POST['location']);
	$meetingDate = strval($_POST['meetingDate']);

	$indivTimes = array();
	$indivTimes = $_POST['indivTimeList'];
	$groupTimes = array();
	$groupTimes = $_POST['groupCheckList'];
	
	$fullName = $fName." ".$lName;
	
	$idQuest = "SELECT `count` FROM advisorData WHERE `eMail` = '$eMail'";
	$tempVal = $COMMON->executeQuery($idQuest, $_SERVER["SCRIPT_NAME"]);
	$idFound = mysql_fetch_row($tempVal);
	
	//Only adds individual session data to the table if the user checked at least one box 
	if(!empty($indivTimes)){
		foreach($indivTimes as $selected){
			$dataEntry = "INSERT INTO meetingData (`count`, `id`, `advName`, `start_time`, `end_time`, `date`, `max_student`, `num_student`) VALUES (NULL,'".$idFound[0]."','".$fullName."', '".$selected."', '".date('h:i', strtotime("+30 minutes", strtotime($selected)))."', '".$meetingDate."', '1', '0')";
			$rs = $COMMON->executeQuery($dataEntry, $_SERVER["SCRIPT_NAME"]);
		}	
	}
	
	//Only adds group session data to the table if the user checked at least one box 
	if(!empty($groupTimes)){
		foreach($groupTimes as $selected){
			$sql = "INSERT INTO meetingData (`count`, `id`, `advName`, `start_time`, `end_time`, `date`, `max_student`, `num_student`) VALUES (NULL,'".$idFound[0]."','".$fullName."', '".$selected."', '".date('h:i', strtotime("+30 minutes", strtotime($selected)))."', '".$meetingDate."', '10', '0')";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
	}
?>
 
<form action="date.php" method="post" name="reset">
	This will bring you back to select a new date and times<br><br>
	<input type="submit" name="submit" value="Done">
	<?php
		//keeping the user's information available for reference 
		echo("<input type='hidden' name='fName' value= $fName>");
		echo("<input type='hidden' name='lName' value= $lName>");
		echo("<input type='hidden' name='major' value= $major>");
		echo("<input type='hidden' name='eMail' value= $eMail>");
		echo("<input type='hidden' name='location' value= $location>");
	?>
	</form>
	
<form action="menuPage.php" method="post" name="reset">
	This will bring you back to the main menu<br><br>
	<input type="submit" name="submit" value="Menu">
	<?php
		//keeping the user's information available for reference 
		echo("<input type='hidden' name='fName' value= $fName>");
		echo("<input type='hidden' name='lName' value= $lName>");
		echo("<input type='hidden' name='major' value= $major>");
		echo("<input type='hidden' name='eMail' value= $eMail>");
		echo("<input type='hidden' name='location' value= $location>");
	?>
	</form>
	
</body>
</html>