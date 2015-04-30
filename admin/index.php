<?php
session_start();
if (!isset($_SESSION["manager"])) {
    header("location:adminlogin.php"); 
    exit();
}
include("admincheck.php");
$manager = $_SESSION["manager"];
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
	<h1 style="color:#09C">Hello store manager <?php echo $manager  ?>, what would you like to do today?</h1>
	<div id="inventorylinks">
		<a href="inventorylist.php">Check Inventory List</a> <br /><br />
        <a href="additem.php">Add Items</a><br /><br />
        <a href="adminlogout.php">Logout</a><br /><br />
	</div>
</div>
<?php include_once("template_pageBottomadmin.php"); ?>
</body>
</html>