<html>

<head>
    <title>MEETING SETUP</title>
</head>

<body>
<?php
	include('../CommonMethods.php');
	$debug = false;
	$COMMON = new Common($debug);
	
	//warnings about how date() is used incorrectly is suppressed, because it runs correctly
	error_reporting(E_ERROR | E_PARSE);

	$fName = strval ($_POST['fName']);
	$lName = strval ($_POST['lName']);
	$major =strval ($_POST['major']);
	$eMail = strval ($_POST['eMail']);
	$location =strval ($_POST['location']);
	$meetingDate = strval ($_POST['meetingDate']);
?>

	<form action="groupMeeting.php" method="post" name="advInfo">
		<?php 
			//keeping the user's information available for reference 
			echo("<input type='hidden' name='fName' value= $fName>");
			echo("<input type='hidden' name='lName' value= $lName>");
			echo("<input type='hidden' name='major' value= $major>");
			echo("<input type='hidden' name='eMail' value= $eMail>");
			echo("<input type='hidden' name='location' value= $location>");
			echo("<input type='hidden' name='meetingDate' value='$meetingDate'>");
			
			$idQuest = "SELECT `count` FROM advisorData WHERE `eMail` = '$eMail'";
			$tempId = $COMMON->executeQuery($idQuest, $_SERVER["SCRIPT_NAME"]);
			$idFound = mysql_fetch_assoc($tempId);
			$id = $idFound['count'];
			
			$dateQuest = "SELECT `start_time` FROM meetingData WHERE `id` = $id AND `date` = '$meetingDate'";
			$tempDate = $COMMON->executeQuery($dateQuest, $_SERVER["SCRIPT_NAME"]);
			
			$dateTime = array();
			echo("These are the scheduled appointment <br>");
			while($dateFound = mysql_fetch_assoc($tempDate)){
				$sentDate = $dateFound['start_time'];
				echo($sentDate."<br>");
				echo("<input type='hidden' name = 'dateList[]' value = '$sentDate'>");
				
				//used in the for loop later on
				array_push($dateTime, $sentDate);
			}
			
			error_reporting(E_ERROR | E_NOTICE | E_PARSE);
			
			//setting up the checkList for individual sessions
			echo("Enter all individual advising sessions <br><br>");
			$startTime = "08:00";
			$endTime = "08:00";
			for($i = 1; $i < 18; $i++){
				$timeMatch = false;
				$endTime = strtotime("+30 minutes", strtotime($endTime));
				$endTime = date('h:i', $endTime);
				//leaves out times that are in the dateTime array
				foreach($dateTime as $selected){
					if(substr($selected, 0, -3) == $startTime){
						$timeMatch = true;
						break;
					}
				}
				
				if($timeMatch == false){
					echo("<input type='checkbox' name='indivTimeList[]' value=$startTime> $startTime - $endTime <br><br>");
				}
				$startTime = strtotime("+30 minutes", strtotime($startTime));
				$startTime = date('h:i', $startTime);
			} 
			?>
		<br>
		<input type="submit" name="submit" value="Next">
	</form>
	
	<form action="menuPage.php" method="post" name="reset">
	<input type="submit" name="submit" value="Cancel">
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
