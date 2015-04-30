<?php
include("../includes/connect.php");
$usern = preg_replace('#[^a-z0-9]#i', '', $_GET['username']);

$query = mysql_query("SELECT * FROM user WHERE username = '$usern'") or die("Cannot connect to Database");
if (strlen($usern) < 3 || strlen($usern) > 16) {
   echo '3 - 16 characters please';
   exit();
    }
if (is_numeric($usern[0])) {
   echo 'Usernames must begin with a letter';
   exit();
    }

else if ((mysql_num_rows($query)==0)) {
	echo 'okay';
	exit();
} else {
	echo 'Username Taken';
	exit();
}
?>

     
    
