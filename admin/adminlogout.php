<?php
	session_start();
	// Destroy the session variables
	session_destroy();
	// Double check to see if their sessions exists
	if(isset($_SESSION['username'])){
	header("location: prompt.php?msg=Error:_Logout_Failed");
	} else {
	header("location:../index.php");
	exit();
}