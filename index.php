<?php 
session_start();
include ("includes/connect.php"); 
include ("includes/sidepannel.php");
$dynamic_table = "";
$perpage = 5;
$dyn_page = "";

$sql1 = mysql_query("SELECT count(*) FROM products ") or die("sorry!! cannot connect to database");

		$pages = ceil(mysql_result($sql1,0)/$perpage);
		$page = (isset($_GET['page'])) ? (int)($_GET['page']) : 1;
		$start = ($page-1)*$perpage;

$sql = mysql_query("SELECT * FROM products ORDER BY pid DESC LIMIT $start,$perpage");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["pid"];
			 $product_name = $row["product_name"];
			 $author = $row["author"];
			 $publications = $row["publications"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $dynamic_table .='    <table id ="producttable" width="100%" height="172" cellpadding="2" cellspacing="6" >
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
					$dyn_page .=  '<a class="buttons" href="?&page='.$x.'">'.$x.'</a> ';
				}
		}

} else {
	$dynamic_table = "We have no products listed in our store yet";
}
mysql_close()

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
    <?php echo $dynamic_table; ?>
    <?php echo $dyn_page; ?>
<!--    <table id ="producttable" width="100%" height="172" cellpadding="2" cellspacing="6" style="border:#333 1px solid;">
      <tr>
        <td width="24%" height="158" align="center" valign="middle" ><a href="product.php?"><img src="Inventory_images/2.jpg" width="139" height="144" alt="image" border="1" ></a></td>
        <td width="76%" align="center" valign="middle"><p>product title</p>
        <p>price</p>
        <p>author</p>
        <p><a href="product.php?">view details</a></p></td>
      </tr>
    </table> -->
  </div>
</div>
<?php include_once("template/template_pageBottom.php"); ?>
</body>
</html>