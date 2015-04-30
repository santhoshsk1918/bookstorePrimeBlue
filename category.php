<?php
	session_start();
	$perpage = 5;
	$dyn_page = "";
	include("includes/connect.php");
	include("includes/sidepannel.php");
	$dyn_cat= "";
	$category = mysql_real_escape_string($_GET['category']);
	$sql1 = mysql_query("Select count(*) From products WHERE category = '$category' OR subcategory = '$category' ") or die(mysql_error());
		$pages = ceil(mysql_result($sql1,0)/$perpage);
		$page = (isset($_GET['page'])) ? (int)($_GET['page']) : 1;
		$start = ($page-1)*$perpage;
	
	
	$sql = mysql_query("Select * From products WHERE category = '$category' OR subcategory = '$category'  ORDER BY pid DESC limit $start,$perpage ") or die(mysql_error());	
	$count = mysql_num_rows($sql);
	if($count > 0){
		while($row = mysql_fetch_array($sql)){ 
             $id = $row["pid"];
			 $product_name = $row["product_name"];
			 $author = $row["author"];
			 $publications = $row["publications"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
					 $dyn_cat .='    <table id ="producttable" width="100%" height="172" cellpadding="2" cellspacing="6" >
			  <tr>
				<td width="24%" height="158" align="center" valign="middle" ><a href="product.php?id=' . $id . '"><img src="Inventory_images/' . $id . '.jpg" width="119" height="119" alt="image" border="1" ></a></td>
				
				<td width="76%" align="left" valign="middle"><p>Book Title :&nbsp;<span id="output">' . $product_name . '</span></p>
				<p>Author :&nbsp;<span id="output">' . $author . '</span></p>
				<p>Price :&nbsp; <span style="color:#A96; font-size:16px ">Rs</span> <span id="output">' . $price . '</span></p>
				<p><a href="product.php?id=' . $id . '" id="outputlink">view details</a></p></td>
			  </tr>
			</table> 
			<hr />';
		}
		if($page>=1 && $page <= $pages){
			for($x=1; $x<=$pages ; $x++){
					$dyn_page .=  '<a class="buttons" href="?&category='.$category.'&page='.$x.'">'.$x.'</a> ';
				}
		}
	
	}else{
		$dyn_cat = '<p id="output">Sorry we have no Books listed under category <span style="color:#E11F1A;"> "'.$category.'" </span> yet<br /> go back to <a href="index.php" id="outputlink">Home Page<a></p>';	
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
  	 <h3 id="h3heading" align="left">Search:</h3>
     <?php echo '<h3 id="h3heading">showing results for '.$category.'</h3>'; ?>
     <hr  />
     <?php echo $dyn_cat; ?>
     <?php echo $dyn_page; ?>
    </div>
   
</div>
<?php include_once("template/template_pageBottom.php"); ?>
</body>
</html>

