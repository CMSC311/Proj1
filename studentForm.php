<?php
$debug = true;
session_start();
include ('CommonMethods.php');

$COMMON = new Common($debug);

$fName = $_POST['tb_fName'];
$lName = $_POST['tb_lName'];
$studentID = $_POST['tb_studentID'];
$email = $_POST['tb_email'];
$major = $_POST['dd_major'];


echo "$fName<br>$lName<br>$studentID<br>$email<br>$major";



?>