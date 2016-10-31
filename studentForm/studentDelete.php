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


$filename = "studentDelete.php";
$sql = "SELECT * FROM studentData WHERE eMail = '$email' AND studentID = '$studentID'";
$result = $COMMON->executeQuery($sql, $filename);
if(mysql_num_rows($result) > 0){//if there is already a student with the same studentID and email in the table
	$row = mysql_fetch_assoc($result);
	
	if($row["signedUp"] == 1){
		$timeSlot = $row["id"];//id from studentData matching the count of the timeSlot that is currently picked
		$sql = "SELECT * FROM meetingData WHERE count = '$timeSlot'";
		$resultMeeting = $COMMON->executeQuery($sql, $filename);
		$rowMeeting = mysql_fetch_assoc($resultMeeting);//gets the row from meetingData that is currently selected
		
		$newNumStudent = $rowMeeting["num_student"] - 1;
		$sql = "UPDATE meetingData SET num_student = '$newNumStudent' WHERE count = '$timeSlot'";
		$COMMON->executeQuery($sql, $filename);//this will subtract 1 from the number of students signed up for this time slot
		
		$sql = "UPDATE studentData SET signedUp = 0 WHERE eMail = '$email' AND studentID = '$studentID'";
		$COMMON->executeQuery($sql, $filename);//this will set the signedUp boolean to false for the student
		
		$sql = "UPDATE studentData SET id = NULL WHERE eMail = '$email' AND studentID = '$studentID'";
		$COMMON->executeQuery($sql, $filename);//this will set id of the student to be NULL since now they havent chosen a meeting
		
		echo("Your appointment has been successfully deleted");
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

