<?php 
	include("includes/sidepannel.php");
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Primeblue Books</title>
<link rel="icon" href="images/prime.ico" type="image/x-icon">
<link rel="stylesheet" href="style/style.css">
<script type="text/javascript" src="scripts/main.js"></script>
<link rel="stylesheet" href="style/login.css">
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
  	 <h3 id="h3heading" align="Center">Categories</h3>
     <hr  />
     			<a id="categorylinks" href="category.php?category=Arts" >Arts </a><br /><br />
				<a id="categorylinks" href="category.php?category=Body,Mind,Sprit">Body, Mind,Spirit</a><br /><br />
				<a id="categorylinks" href="category.php?category=Business,Economics">Business,Economics</a><br /><br />
				<a id="categorylinks" href="category.php?category=Cooking">Cooking</a><br /><br />
				<a id="categorylinks" href="category.php?category=Educational">Educational</a><br /><br />
				<a id="categorylinks" href="category.php?category=Family,Relationships">Family,Relationships</a><br /><br />
				<a id="categorylinks" href="category.php?category=Fiction">Fiction</a><br /><br />
				<a id="categorylinks" href="category.php?category=Health,Fitness">Health,Fitness</a><br /><br />
				<a id="categorylinks" href="category.php?category=Reference">Reference</a><br /><br />
				<a id="categorylinks" href="category.php?category=Self-Help">Self-Help</a><br /><br />
				<a id="categorylinks" href="category.php?category=Travel">Travel</a><br /><br />
    </div>
   
</div>
<?php include_once("template/template_pageBottom.php"); ?>
</body>
</html>

