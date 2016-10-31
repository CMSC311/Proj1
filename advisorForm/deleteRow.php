<html>
<head>
	<title>APPOINTMENT DELETED</title>
</head>

<body>

<?php
	include('../CommonMethods.php');
	$debug = false;
	$COMMON = new Common($debug);
	error_reporting(E_ERROR | E_NOTICE | E_PARSE);
	
	$fName = strval($_POST['fName']);
	$lName = strval($_POST['lName']);
	$major = strval($_POST['major']);
	$eMail = strval ($_POST['eMail']);
	$location = strval($_POST['location']);
	
	$deleteCheckList = array();
	$deleteCheckList = $_POST['deleteCheckList'];
	
	$dateList = array();
	$dateList = $_POST['dateList'];
	
	$i = 0;
	foreach($deleteCheckList as $selected){
		$dateFound = date($dateList[$i]);
		$dataDelete = "DELETE FROM meetingData WHERE start_time = '$selected' AND date = '$dateFound'";
		$rs = $COMMON->executeQuery($dataDelete, $_SERVER["SCRIPT_NAME"]);
		$i++;
		}
?>

<form action="deleteMeeting.php" method="post" name="reset">
	This will bring you back to select more appointments to delete
	<input type="submit" name="submit" value="Done">
	<?php
		echo("<input type='hidden' name='fName' value= $fName>");
		echo("<input type='hidden' name='lName' value= $lName>");
		echo("<input type='hidden' name='major' value= $major>");
		echo("<input type='hidden' name='eMail' value= $eMail>");
		echo("<input type='hidden' name='location' value= $location>");
	?>
	</form>
	
<form action="menuPage.php" method="post" name="reset">
	This will bring you back to the main menu
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