<?php
session_start();
if (!isset($_SESSION["manager"])) {
    header("location:adminlogin.php"); 
    exit();
}
include("admincheck.php");
?>
<?php 
include_once("../includes/connect.php");
$product_list = "";
	$perpage = 15;
	$dyn_page = "";
	
	$sql1 = mysql_query("SELECT count(*) FROM products ") or die(mysql_error());
	$pages = ceil(mysql_result($sql1,0)/$perpage);
	$page = (isset($_GET['page'])) ? (int)($_GET['page']) : 1;
	$start = ($page-1)*$perpage;
		
$sql = mysql_query("SELECT * FROM products ORDER BY pid DESC limit $start,$perpage") or die(mysql_error());
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["pid"];
			 $product_name = $row["product_name"];
			 $author = $row["author"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $product_list .="<table>
			 				<tr id=\"producttable\">
								<td>ISBN : $id |&nbsp;</td>
								<td>Title : <strong>$product_name</strong> |&nbsp;</td>
								<td><span style=\"font-size:16px; color=#069;\">Rs</span> $price |&nbsp;</td>
								<td><em>Added $date_added</em> &nbsp;</td>
								<td>&nbsp;&nbsp;</td>
								<td><a href='edititem.php?pid=$id'>edit</a> &bull;&nbsp;</td>
								<td><a href='deleteitem.php?deletename=$product_name'>delete</a><br /> 
								
							</tr>
			 </table>" ;
	}
	if($page>=1 && $page <= $pages){
			for($x=1; $x<=$pages ; $x++){
					$dyn_page .=  '<a class="buttons" href="?&page='.$x.'">'.$x.'</a> ';
				}
		}
} else {
	$product_list = "You have no products listed in your store yet";
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Primeblue Books Admin Register</title>
<link rel="icon" href="adminstyle/PBA.ico" type="image/x-icon">
<link rel="stylesheet" href="adminstyle/adminstyle.css">

</head>
<body>
<?php include_once("template_pageTopadmin.php"); ?>
<div id="pageMiddle">
	<div id="itemeditlinks">
    	<a href="additem.php">+ Add items</a>
    </div>
    <div id="productlist">
    <?php echo $product_list ?>
    <?php echo $dyn_page; ?>
    </div>
</div>
<?php include_once("template_pageBottomadmin.php"); ?>
</body>
</html>