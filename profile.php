<?php
session_start();
if(isset($_SESSION['user_id']) ){
		include_once("includes/connect.php"); 	
	$uid = $_SESSION['user_id'];
	$result = mysql_query("SELECT * FROM user WHERE user_id = $uid ")or die (mysql_error());
	$count = mysql_num_rows($result);
	if ($count > 0){
		while($row = mysql_fetch_array($result)){
			$uid =  $row['user_id'];
			$name = $row['firstname'];
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Primeblue Books</title>
<link rel="icon" href="images/prime.ico" type="image/x-icon">
<link rel="stylesheet" href="style/style.css">
<script type="text/javascript" src="scripts/main.js"></script>
</head>
<body>
<?php include_once("template/template_pageTop.php"); ?>
<div id="pageMiddle">
  <?php echo '<center><h2 id="h3heading"> Hello '.$name.'</h2></center>'; ?>
  
</div>
<?php include_once("template/template_pageBottom.php"); ?>
</body>
</html>