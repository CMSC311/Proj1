<?php

include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

$firstName = strval ($_POST['firstName']);
$lastName = strval ($_POST['lastName']);
$major =strval ($_POST['major']);
$location =strval ($_POST['location']);

$sql = "INSERT INTO advisorData (`count`, `fName`, `lName`, `major`, `location`) VALUES (NULL,'".$firstName."','".$lastName."', '".$major."', '".$location."')";

$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

?>