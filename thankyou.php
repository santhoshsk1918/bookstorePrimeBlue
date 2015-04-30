<?php 
session_start();
include ("includes/connect.php"); 
include ("includes/sidepannel.php");
mysql_close();

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
  <div id="popularproducts" >
  	<h3 id="h3heading" align="center">Best Sellers</h3>
    <hr />
    <?php echo $Side_table; ?>
    </div>
  <div id="products">
  	<h3 id="h3heading" align="left">PRODUCTS</h3>
    <hr  />
    	<h3 id="h3heading">Welcome to primebooks</h3>
   		<p style="color:#063;">Thankyou for registering.<a href="index.php" style="text-decoration:none;color:#039;">go to home page</a></p>
  </div>
</div>
<?php include_once("template/template_pageBottom.php"); ?>
</body>
</html>