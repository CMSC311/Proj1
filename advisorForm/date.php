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
	error_reporting(E_ERROR | E_NOTICE | E_PARSE);

	$fName = strval ($_POST['fName']);
	$lName = strval ($_POST['lName']);
	$major =strval ($_POST['major']);
	$eMail = strval ($_POST['eMail']);
	$location =strval ($_POST['location']);
	

	echo("<form action='indivMeeting.php' method='post' name='day'>");
		//keeping the user's information available for reference 
		echo("<input type='hidden' name='fName' value= $fName>");
		echo("<input type='hidden' name='lName' value= $lName>");
		echo("<input type='hidden' name='major' value= $major>");
		echo("<input type='hidden' name='eMail' value= $eMail>");
		echo("<input type='hidden' name='location' value= $location>");
		
		$currDate = date("Y-m-d");
		//this sets up a calendar for the user to select a date from
		echo("Enter the date of the appointment you want to schedule <br>");
		echo("<input type='date' name='meetingDate' min =$currDate required><br><br>");
		echo("<input type='submit' name='submit' value='Next'>");
	echo("</form>");
?>

<form action="menuPage.php" method="post" name="reset">
	<br><br>
	<input type="submit" name="submit" value="Cancel">
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