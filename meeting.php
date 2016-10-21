<?php
	include('CommonMethods.php');
	include("teacher.php");
	$debug = false;
	$COMMON = new Common($debug);
	
	//copies values from meeting.php
	$advName = $lastName;
	$meetingPlace = $location;
	
	$idQuery = "SELECT `count` FROM advisorData WHERE lName = '".$lastName."'";
	$rt = $COMMON->executeQuery($idQuery, $_SERVER["SCRIPT_NAME"])
	
	echo $rt
	
	//meetingData table does not hold the sessionType but the max number of students
	//a session can have, so this part translates the 'G'/'I' to a 10/1
	$type = strval($_POST['sessionType']);
	if($type == 'G')
		$max_student = 10;
	else
		$max_student = 1;
	$sql = "INSERT INTO meetingData (`count`, `id`, `start_time`, `end_time`, `date`,
	`max_student`, `num_student`) VALUES (NULL, '"."')";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRPIT_NAME"]);
?>