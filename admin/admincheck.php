<?
// Checking that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); 
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); 
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); 

include ("../includes/connect.php"); 
$sql = mysql_query("SELECT * FROM admin WHERE manager='$manager' AND password='$password' LIMIT 1"); // query the person
$existCount = mysql_num_rows($sql); 
if ($existCount == 0) {
	 echo "Your login session data is not on record in the database.";
     exit();
}
?>
