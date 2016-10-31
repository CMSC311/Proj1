<?php
$debug = false;
session_start();
include ('../CommonMethods.php');

$COMMON = new Common($debug);

$fName = $_POST['fName'];
$lName = $_POST['lName'];
$studentID = $_POST['studentID'];
$email = $_POST['email'];
$major = $_POST['major'];


$filename = "studentView.php";
$sql = "SELECT * FROM studentData WHERE eMail = '$email' AND studentID = '$studentID'";
$result = $COMMON->executeQuery($sql, $filename);
//gets the students row from the studentData table
if(mysql_num_rows($result) > 0){//if there is already a student with the same studentID and email in the table
	$row = mysql_fetch_assoc($result);
	
	if($row["signedUp"] == 1){//if the student has already signed up for an appointment
		$sql = "SELECT * FROM meetingData WHERE count = '{$row['id']}'";
		$resultTime = $COMMON->executeQuery($sql, $filename);
		$rowTime = mysql_fetch_assoc($resultTime);
		echo("Your appointment is for: ");
		echo($rowTime["start_time"] . " - " . $rowTime["end_time"] . " on " . $rowTime["date"] . " with: " . $rowTime["advName"] . "<br>");
		//it finds the proper appointment in meetingData table and then prints it out to the viewer
	}else{
		echo("You do not already have a scheduled appointment");
	}
}else{
	echo("You do not already have a scheduled appointment");

}

echo("<html>");
echo("<head>");
echo("<title>student form</title>");
echo("</head>");
echo("<body>");

echo("<form action = 'studentMenu.php' method = 'post' name = 'studentMenu1'>");

//hidden info from last form that we can pass again
echo("<input type = 'hidden' name = 'tb_fName' value = '$fName'>");
echo("<input type = 'hidden' name = 'tb_lName' value = '$lName'>");
echo("<input type = 'hidden' name = 'tb_studentID' value = '$studentID'>");
echo("<input type = 'hidden' name = 'tb_email' value = '$email'>");
echo("<input type = 'hidden' name = 'dd_major' value = '$major'>");

echo("<br>");
echo("<input type = 'submit' value = 'Menu'>");

echo("</form>");

echo("</body>");
echo("</html>");


?>
