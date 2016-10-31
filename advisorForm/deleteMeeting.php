<html>
<head>
<title>DELETE MEETINGS</title>
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
		
		$dateQuest = "SELECT `start_time`, `end_time`, `date`, `count` FROM meetingData WHERE `id` = '$idFound[0]'";
		$query = $COMMON->executeQuery($dateQuest, $_SERVER["SCRIPT_NAME"]);
		
		if(mysql_num_rows($query) < 0){
			echo("You do not currently have any appointments scheduled.");
			echo("<form action='menuPage.php' method='post' name='return'>
					<input type='hidden' name='fName' value=$fName>
					<input type='hidden' name='lName' value=$lName>
					<input type='hidden' name='major' value=$major>
					<input type='hidden' name='eMail' value= $eMail>
					<input type='hidden' name='location' value=$location>
					<input type='submit' name='cancel' value='Cancel'> 
					</form>");
		}
		else{
			echo("<form action='deleteRow.php' method='post' name='deleteInfo'>");
					error_reporting(E_ERROR | E_NOTICE | E_PARSE);
			
					echo("<input type='hidden' name='fName' value=$fName>");
					echo("<input type='hidden' name='lName' value=$lName>");
					echo("<input type='hidden' name='major' value=$major>");
					echo("<input type='hidden' name='eMail' value= $eMail>");
					echo("<input type='hidden' name='location' value=$location>");

					while($dateFound = mysql_fetch_assoc($query)){
						$date = $dateFound['date'];
						$startTime = $dateFound['start_time'];
						$endTime = $dateFound['end_time'];
						echo("<input type='checkbox' name='deleteCheckList[]' value=$startTime> $startTime - $endTime  $date<br>");	
						echo("<input type='hidden' name='dateList[]' value=$date>");
					}
				echo("<input type='submit' name='submit' value='Submit'>");
			echo("</form>");		
			echo("<form action='menuPage.php' method='post' name='return'>
				<input type='hidden' name='fName' value=$fName>
				<input type='hidden' name='lName' value=$lName>
				<input type='hidden' name='major' value=$major>
				<input type='hidden' name='eMail' value= $eMail>
				<input type='hidden' name='location' value=$location>
				<input type='submit' name='cancel' value='Cancel'>");
		}
	?>
	
</body>
</html>