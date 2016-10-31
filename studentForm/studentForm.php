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


$filename = "studentForm.php";
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


echo("<html>");
echo("<head>");
echo("<title>student form</title>");
echo("</head>");
echo("<body>");

echo("<form action = 'studentForm2.php' method = 'post' name = 'studentform2'>");

echo("<fieldset>");
echo("<legend>Type of meeting:</legend>");
echo("<br>");

//hidden info from last form that we can pass again
echo("<input type = 'hidden' name = 'fName' value = '$fName'>");
echo("<input type = 'hidden' name = 'lName' value = '$lName'>");
echo("<input type = 'hidden' name = 'studentID' value = '$studentID'>");
echo("<input type = 'hidden' name = 'email' value = '$email'>");
echo("<input type = 'hidden' name = 'major' value = '$major'>");


echo("<input type = 'radio' name = 'rb_groupType' value = 'Individual' required/> Individual<br>");
echo("<input type = 'radio' name = 'rb_groupType' value = 'Group' required/> Group<br>");

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

