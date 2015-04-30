<?php

$mysql_host = "localhost";
$mysql_database = "primeblue";
$mysql_user = "root";
$mysql_password = "";

$connect = mysql_connect("$mysql_host","$mysql_user","$mysql_password");

if(!$connect) {
	die('choud not connect'.mysql_error());
}

$db_select = mysql_select_db("$mysql_database");

if(!$db_select) {
	die('could not connect'.mysql_error());
}
?>