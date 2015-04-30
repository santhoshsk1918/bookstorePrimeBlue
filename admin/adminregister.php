<?php 
session_start();
if (isset($_SESSION["manager"])) {
    header("location:adminlogin.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Primeblue Books Admin Register</title>
<link rel="icon" href="adminstyle/PBA.ico" type="image/x-icon">
<link rel="stylesheet" href="adminstyle/adminstyle.css">
<link rel="stylesheet" href="../style/login.css">
</head>
<body>
<?php include_once("template_pageTopadmin.php"); ?>
<div id="pageMiddle">
<center>
 <p style="color:#71c155; font-size:18px;"> Please contact existing Admins for Admin Registration <p>
 <p style="color:#71c155; font-size:14px;">go back to <a href="../login.php" style="text-decoration:none; color:brown">User login</a></p>
 </center>
</div>
<?php include_once("template_pageBottomadmin.php"); ?>
</body>
</html>