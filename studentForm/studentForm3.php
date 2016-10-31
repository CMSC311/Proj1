<?php
$debug = false;
session_start();
include ('../CommonMethods.php');

$COMMON = new Common($debug);

$groupType = $_POST['groupType'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$studentID = $_POST['studentID'];
$email = $_POST['email'];
$major = $_POST['major'];
$timeSlot = $_POST['rb_timeSlot'];// the count field in our meetingData table (Auto incremented)



$filename = "studentForm3.php";

$sql = "SELECT * FROM studentData WHERE eMail = '$email' AND studentID = '$studentID'";
$result = $COMMON->executeQuery($sql, $filename);
$row = mysql_fetch_assoc($result);

if($row["signedUp"] == 1){//if the student already has a scheduled appointment
	echo("You already have scheduled an appointment, please go back to delete your old appointment before signing up");
}else{
	$sql = "SELECT * FROM meetingData WHERE count = '$timeSlot'";
	$resultMeeting = $COMMON->executeQuery($sql, $filename);
	$rowMeeting = mysql_fetch_assoc($resultMeeting);//gets the row from meetingData that is currently being chosen
		
	$newNumStudent = $rowMeeting["num_student"] + 1;
	$sql = "UPDATE meetingData SET num_student = '$newNumStudent' WHERE count = '$timeSlot'";
	$COMMON->executeQuery($sql, $filename);//this will add 1 from the number of students signed up for this time slot
	
	$sql = "UPDATE studentData SET signedUp = 1 WHERE eMail = '$email' AND studentID = '$studentID'";
	$COMMON->executeQuery($sql, $filename);//this will set the signedUp boolean to true for the student
		
	$sql = "UPDATE studentData SET id = '$timeSlot' WHERE eMail = '$email' AND studentID = '$studentID'";
	$COMMON->executeQuery($sql, $filename);//this will set the id of the student to match the count of the meeting they chose
		
	echo("Your appointment has been successfully scheduled");
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