<?php
if (strlen($_REQUEST['password']) > 4) {
	echo 'okay';
} else {
	echo 'Password Length must be atleast 4 char long';
}

?>