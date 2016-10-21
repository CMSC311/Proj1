<?php
	include('CommonMethods.php');
	include("teacher.php");
	$debug = false;
	$COMMON = new Common($debug);
	
	//copies values from meeting.php
	$advName = $lastName;
	$meetingPlace = $location;
	
	$sql = "INSERT INTO meetingData ()";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRPIT_NAME"]);

?>