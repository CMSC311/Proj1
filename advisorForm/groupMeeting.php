<html>

<head>
    <title>MEETING SETUP</title>
</head>

<body>

<?php
	include('../CommonMethods.php');
	$debug = false;
	$COMMON = new Common($debug);
	
	error_reporting(E_ERROR | E_PARSE);
	
	//copies values from indivMeeting.php hidden form
	$fName = strval($_POST['fName']);
	$lName = strval($_POST['lName']);
	$major = strval($_POST['major']);
	$eMail = strval ($_POST['eMail']);
	$location = strval($_POST['location']);
	$meetingDate = strval($_POST['meetingDate']);
	
	$indivTimeList = array();
	$indivTimeList = $_POST['indivTimeList'];
	$dateList = array();
	$dateList = $_POST['dateList'];
	
	if(!empty($indivTimeList)){
		echo "You have selected: ";
		foreach($indivTimeList as $selected){
			echo "<p>".$selected." - ".date('h:i', strtotime("+30 minutes", strtotime($selected)))."</p>";		
		}
	}

	echo("<form action='lastPage.php' method='post' name='advInfo'>");
	echo("Select all group sessions:<br>");

	//warnings about how date() is used incorrectly is suppressed, because it runs correctly
	error_reporting(E_ERROR | E_NOTICE | E_PARSE);
	
	//keeping the user's information available for reference 
	echo("<input type='hidden' name='fName' value=$fName>");
	echo("<input type='hidden' name='lName' value=$lName>");
	echo("<input type='hidden' name='major' value=$major>");
	echo("<input type='hidden' name='eMail' value= $eMail>");
	echo("<input type='hidden' name='location' value=$location>");
	echo("<input type='hidden' name='meetingDate' value=$meetingDate>");
	
	foreach($indivTimeList as $time){
		echo('<input type="hidden" name="indivTimeList[]" value="'.$time.'">');
	}
	
	//setting up the checkList for group sessions
	$startTime = "08:00";
	$endTime = "08:00";
	for($i = 1; $i < 18; $i++){
		$timeMatch = false;
		$endTime = strtotime("+30 minutes", strtotime($endTime));
		$endTime = date('h:i', $endTime);
		//leaves out times that are in indivTimeList
		
		foreach($indivTimeList as $selected){
			if($selected == $startTime ){
				$timeMatch = true;
				break;
			}
		}
		if($timeMatch == false){
			foreach($dateList as $selected){
				if(substr($selected, 0, -3) == $startTime ){
					$timeMatch = true;
					break;
				}
			}
		}
		
		if($timeMatch == false){
			echo("<input type='checkbox' name='groupCheckList[]' value=$startTime> $startTime - $endTime <br><br>");
		}else{
			
		}
		$startTime = strtotime("+30 minutes", strtotime($startTime));
		$startTime = date('h:i', $startTime);
		}
	
	echo("<input type='submit' name='submit' value='Submit'>
		</form>");
	?>
	
	<form action="menuPage.php" method="post" name="reset">
	<input type="submit" name="cancel" value="Cancel">
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