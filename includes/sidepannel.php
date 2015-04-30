<?php 
include ("includes/connect.php"); 
$Side_table = "";

$sql = mysql_query("SELECT * FROM products ORDER BY sales DESC LIMIT 5");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["pid"];
			 $product_name = $row["product_name"];
			 $author = $row["author"];
			 $publications = $row["publications"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $Side_table .='    <table id ="producttable" width="100%"  cellpadding="2" cellspacing="6" >
      <tr>
        <td height="44%" height="158" align="center" valign="middle" ><a href="product.php?id=' . $id . '"><img src="Inventory_images/' . $id . '.jpg" width="100" height="100" alt="image" border="1" ></a></td>
		</tr>
		<tr>
        <td height="56%" align="center" valign="middle"><p><a href="product.php?id=' . $id . '"><span id="output">' . $product_name . '<span></a></p>
		 <p>Price : <span style="color:#A96; font-size:16px ">Rs</span> <span id="output"> <span id="output">' . $price . '</span></p>
      </tr>
    </table> 
	<hr />';
	
	}
} else {
	$Side_table = "We have no featured products listed in our store yet";
}
?>
