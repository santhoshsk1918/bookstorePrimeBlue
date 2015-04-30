<?php
include("../includes/connect.php");
if ((preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$_GET['useremail']))) {
   $uemail = mysql_real_escape_string($_GET['useremail']);
   $query = mysql_query("SELECT * FROM user WHERE email = '$uemail'") or die("Cannot connect to Database");
		if ((mysql_num_rows($query)==0)) {
			echo 'okay';
			exit();
		} else {
			echo 'Email Already registered';
			exit();
	}
}else{
		echo "Invalid Email Address";
		exit();
	}



?>

     
    
