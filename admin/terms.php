<?php
session_start();
if (!isset($_SESSION["manager"])) {
    header("location:adminlogin.php"); 
    exit();
}
include("admincheck.php");
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Primeblue Books Admin Register</title>
<link rel="icon" href="adminstyle/PBA.ico" type="image/x-icon">
<link rel="stylesheet" href="adminstyle/adminstyle.css">
</head>
<body>
<?php include_once("template_pageTopadmin.php"); ?>
<div id="pageMiddle">
	<center><h2 id="h3heading">Terms</h2></center> 
</div>
<?php include_once("template_pageBottomadmin.php"); ?>
</body>
</html>