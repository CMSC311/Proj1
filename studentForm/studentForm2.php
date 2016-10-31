<?php
$debug = false;
session_start();
include ('../CommonMethods.php');

$COMMON = new Common($debug);

$groupType = $_POST['rb_groupType'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$studentID = $_POST['studentID'];
$email = $_POST['email'];
$major = $_POST['major'];


$filename = "studentForm2.php";
$sql = "UPDATE studentData SET indiv_group = 'I' WHERE studentID = '$studentID'";
if($groupType == "Group"){
		$sql = "UPDATE studentData SET indiv_group = 'G' WHERE studentID = '$studentID'";
}

$COMMON->executeQuery($sql, $filename);

echo("<html>");
echo("<head>");
echo("<title>student form</title>");
echo("</head>");
echo("<body>");

echo("<form action = 'studentForm3.php' method = 'post' name = 'studentform3'>");

echo("<fieldset>");
echo("<legend>Times available:</legend>");
echo("<br>");

//hidden info from last form that we can pass again
echo("<input type = 'hidden' name = 'fName' value = '$fName'>");
echo("<input type = 'hidden' name = 'lName' value = '$lName'>");
echo("<input type = 'hidden' name = 'studentID' value = '$studentID'>");
echo("<input type = 'hidden' name = 'email' value = '$email'>");
echo("<input type = 'hidden' name = 'major' value = '$major'>");
echo("<input type = 'hidden' name = 'groupType' value = '$groupType'>");

if($groupType == "Individual"){
	$sql = "SELECT * FROM meetingData WHERE max_student = 1 AND num_student = 0 ORDER BY date";
}else{
	$sql = "SELECT * FROM meetingData WHERE max_student = 10 AND num_student BETWEEN 0 AND 9 ORDER BY date";
}
$result = $COMMON->executeQuery($sql, $filename);

if(mysql_num_rows($result) > 0){
	while($row = mysql_fetch_assoc($result)){
		echo("<input type = 'radio' name = 'rb_timeSlot' value = '{$row['count']}' required/>");
		echo($row["start_time"] . " - " . $row["end_time"] . " on " . $row["date"] . " with: " . $row["advName"] . "<br>");	
		//creates radio buttons associated with each time slot that is available for the person to choose
	}
}else{
	echo("no times available.");
}

echo("<br>");
echo("<input type = 'submit' value = 'submit'>");

echo("</fieldset>");

echo("</form>");

//Menu button
echo("<form action = 'studentMenu.php' method = 'post' name = 'studentMenu'>");

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