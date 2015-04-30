<?php 
include ("includes/connect.php"); 
include ("includes/sidepannel.php");
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "includes/connect.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$sql = mysql_query("SELECT * FROM products WHERE pid='$id' LIMIT 1");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
			// get all the product details
			while($row = mysql_fetch_array($sql)){ 
				 $product_name = $row["product_name"];
				 $author = $row["author"];
				 $publisher = $row["publications"];
				 $pages = $row["pages"];
				 $price = $row["price"];
				 $details = $row["details"];
				 $category = $row["category"];
				 $subcategory = $row["subcategory"];
				 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
				 
		}
	//this is for product count		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
// this else is for first isset 		
} else {
	echo "Data to render this page is missing.";
	exit();
}
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
    <table width="100%"  cellspacing="6" cellpadding="2">
      <tr>
        <th height="33" colspan="2" scope="col"><?php echo '<h2 id="h3heading">'.$product_name.'</h2>';  ?></th>
      </tr>
       <tr>
      		<td colspan="2"><hr /></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle">
        <img src="inventory_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $product_name; ?>" /><br />
        <a href="inventory_images/<?php echo $id; ?>.jpg">View Full Size Image</a></td><td width="6%">
      </tr>
       <tr>
      		<td colspan="2"><hr /></td>
      </tr>
      <tr>
        <td width="48%" align="right">Author : </td>
        <td width="46%" align="left"><?php echo $author;  ?></td>
      </tr>
      <tr>
        <td align="right" >Publisher : </td>
        <td align="left"><?php echo $publisher;  ?></td>
      </tr>
      <tr>
        <td align="right">pages : </td>
        <td align="left"><?php echo $pages;  ?></td>
      </tr>
      <tr>
        <td align="right">Price : </td>
        <td align="left"><span style="color:#990; font-size:16px;">Rs.</span><?php echo $price ;  ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center">Categories: <?php echo '<a id="outputlink" href="category.php?"'.$category.'>'.$category.'</a>,&nbsp;<a id="outputlink" href="category.php?"'.$subcategory.'>'.$subcategory.'</a>';?></td>
      </tr>
      <tr>
        <td align="right">Added on:</td>
        <td align="left"><?php echo $date_added ;  ?></td>
      </tr>
      <td colspan="2" align="center">
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" class="buttons" value="Add to Shopping Cart" />
      </form>
      <td>&nbsp; </td>
      </tr>
          
      <tr>
      		<td colspan="2"><hr /></td>
      </tr>
        <tr>
      		<td colspan="2" align="center"><?php echo '<span style="font-size:18px;font-weight:200;">'.$product_name.'&nbsp; <br /> <br />Details</span>';  ?></td>
      </tr>
      <tr>
      		
      		<td colspan="2" align="center" ><?php echo $details ;  ?></td>
      </tr>
    </table>
  </div>
</div>
<?php include_once("template/template_pageBottom.php"); ?>
</body>
</html>