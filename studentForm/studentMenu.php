<?php
$debug = false;
session_start();
include ('../CommonMethods.php');

$COMMON = new Common($debug);

$fName = $_POST['tb_fName'];
$lName = $_POST['tb_lName'];
$studentID = $_POST['tb_studentID'];
$email = $_POST['tb_email'];
$major = $_POST['dd_major'];

echo("Hello $fName $lName <br><br>");

$filename = "studentMenu.php";
$sql = "SELECT * FROM studentData WHERE eMail = '$email' AND studentID = '$studentID'";
$result = $COMMON->executeQuery($sql, $filename);
if(mysql_num_rows($result) > 0){//if there is already a student with the same studentID and email in the table
	$row = mysql_fetch_assoc($result);
	//copy their data over instead of making a new student entry
	$fName = $row["fName"];
	$lName = $row["lName"];
	$studentID = $row["studentID"];
	$email = $row["eMail"];
	$major = $row["major"];	
}else{//otherwise create a new student entry with the new data
	$filename = "studentForm.php";
	$sql = "INSERT INTO studentData VALUES ('', NULL, '$fName', '$lName', '$studentID', '$email', '$major', NULL, 0)";

	$COMMON->executeQuery($sql, $filename);	
}

$sql = "SELECT * FROM studentData WHERE eMail = '$email' AND studentID = '$studentID'";
$result = $COMMON->executeQuery($sql, $filename);
$row = mysql_fetch_assoc($result);
//here, each time the student logs into the site, it will check that their appointment time was not deleted by the advisor
//if their appointment time has been deleted by the advisor, it will also update the student so that they arent signed up to
//an invalid timeslot
$sql = "SELECT * FROM meetingData WHERE count = '{$row['id']}'";
$resultMeeting = $COMMON->executeQuery($sql, $filename);

if(mysql_num_rows($resultMeeting) == 0 && $row["signedUp"] == 1){
	//if the meeting no longer exists, update the student
	$sql = "UPDATE studentData SET signedUp = 0 WHERE eMail = '$email' AND studentID = '$studentID'";
	$COMMON->executeQuery($sql, $filename);//this will set the signedUp boolean to false for the student
		
	$sql = "UPDATE studentData SET id = NULL WHERE eMail = '$email' AND studentID = '$studentID'";
	$COMMON->executeQuery($sql, $filename);//this will set id of the student to be NULL since now they havent chosen a meeting
		
	echo("Your advisor deleted your appointment!!");
}


echo("<html>");
echo("<head>");
echo("<title>student form</title>");
echo("</head>");
echo("<body>");


//FORM ONE: schedule an appointment
echo("<form action = 'studentForm.php' method = 'post' name = 'studentMenu1'>");

//hidden info from last form that we can pass again
echo("<input type = 'hidden' name = 'fName' value = '$fName'>");
echo("<input type = 'hidden' name = 'lName' value = '$lName'>");
echo("<input type = 'hidden' name = 'studentID' value = '$studentID'>");
echo("<input type = 'hidden' name = 'email' value = '$email'>");
echo("<input type = 'hidden' name = 'major' value = '$major'>");

echo("<br>");
echo("<input type = 'submit' value = 'Schedule an appointment'>");

echo("</form>");


echo("Delete old appointments before rescheduling.");

//FORM TWO: Delete your appointment
echo("<form action = 'studentDelete.php' method = 'post' name = 'studentMenu2'>");

//hidden info from last form that we can pass again
echo("<input type = 'hidden' name = 'fName' value = '$fName'>");
echo("<input type = 'hidden' name = 'lName' value = '$lName'>");
echo("<input type = 'hidden' name = 'studentID' value = '$studentID'>");
echo("<input type = 'hidden' name = 'email' value = '$email'>");
echo("<input type = 'hidden' name = 'major' value = '$major'>");

echo("<input type = 'submit' value = 'Delete your appointment'>");

echo("</form>");


//FORM THREE: View your appointment
echo("<form action = 'studentView.php' method = 'post' name = 'studentMenu3'>");

//hidden info from last form that we can pass again
echo("<input type = 'hidden' name = 'fName' value = '$fName'>");
echo("<input type = 'hidden' name = 'lName' value = '$lName'>");
echo("<input type = 'hidden' name = 'studentID' value = '$studentID'>");
echo("<input type = 'hidden' name = 'email' value = '$email'>");
echo("<input type = 'hidden' name = 'major' value = '$major'>");

echo("<br>");
echo("<input type = 'submit' value = 'View your appointment'>");

echo("</form>");

//FORM FOUR: Log-out
echo("<form action = 'studentForm.html' method = 'post' name = 'studentMenu4'>");

//hidden info from last form that we can pass again

echo("<br>");
echo("<input type = 'submit' value = 'Log-out'>");

echo("</form>");

echo("</body>");
echo("</html>");


?>

