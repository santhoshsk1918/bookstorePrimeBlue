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
// Parse the form data and add inventory item to the system
if (isset($_POST['product_name'])) {
	
	$pid = mysql_real_escape_string($_POST['thisID']);
    $product_name = mysql_real_escape_string($_POST['product_name']);
	$author = mysql_real_escape_string($_POST['author']);
	$publications = mysql_real_escape_string($_POST['publications']);
	$pages = mysql_real_escape_string($_POST['pages']);
	$price = mysql_real_escape_string($_POST['price']);
	$category = mysql_real_escape_string($_POST['category']);
	$subcategory = mysql_real_escape_string($_POST['subcategory']);
	$details = mysql_real_escape_string($_POST['details']);
	if($product_name=="" || $author==""|| $publications==""|| $pages=="" || $price == "" || $category == "" || $details== ""){
			$error[] = 'Please fill all the fields before submittind !!';
		}else{
			$sql = mysql_query("SELECT pid FROM products WHERE product_name='$product_name' LIMIT 1")  or die ("Sorry !! Could not connect to database");
			$productMatch = mysql_num_rows($sql); 
			if ($productMatch > 1) {
				$error[] ='Sorry you tried to place a duplicate "Product Name" into the system';	
			}
			if (empty ($error)){
	$sql = mysql_query("UPDATE products SET product_name='$product_name',author = '$author',publications='$publications',pages='$pages', price='$price', details='$details', 								category='$category', subcategory='$subcategory' WHERE pid='$pid'") or die(mysql_error());
	if ($_FILES['fileField']['tmp_name'] != "") {
	    // Place image in the folder 
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	}
	header("location:inventorylist.php"); 
    exit();
	}else{
				$error_message ='<span class="error">' ;
				foreach($error as $key => $values) {
					$error_message.= "$values<br />";
				}
				$error_message.="</span> <br/><br/>";
			}
		
		}
}
?>
<?php 
// Gather this product's full information for inserting automatically into the edit form below on page
include_once("../includes/connect.php");
if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = mysql_query("SELECT * FROM products WHERE pid='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             
			 $product_name = $row["product_name"];
			 $author = $row["author"];
			 $publications = $row["publications"];
			 $pages = $row["pages"];
			 $price = $row["price"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $details = $row["details"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }
    } else {
	    echo "Sorry dude that crap dont exist.";
		exit();
    }
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
<?php if(isset($_POST['product_name'])){echo $error_message;} ?>
<h3 id="h3heading">Add Inventory Items</h3>
<div id="additemform">
<form action="edititem.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="center" valign="middle">Book Name</td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" value="<?php echo $product_name; ?>" />
        </label></td>
      </tr>
      <tr>
       <tr>
        <td width="20%" align="center" valign="middle" >Author</td>
        <td width="80%" align="left"><label>
          <input name="author" type="text" id="author" size="64" value="<?php echo $author; ?>" />
        </label></td>
      </tr>
      <td width="20%" align="center" valign="middle">publication</td>
        <td width="80%" align="left"><label>
          <input name="publications" type="text" id="publications" size="64" value="<?php echo $publications; ?>" />
        </label></td>
      </tr>
      <td width="20%" align="center" valign="middle">pages</td>
        <td width="80%" align="left"><label>
          <input name="pages" type="text" id="pages" size="4" value="<?php echo $pages; ?>" />
        </label></td>
      </tr>
        <td align="center" valign="middle">Book Price</td>
        <td><label>
          Rs
          <input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="center" valign="middle">Category</td>
        <td><label>
          <select name="category" id="category">
         <?php include("../includes/categorylist.php")?>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="center" valign="middle">Subcategory</td>
        <td><select name="subcategory" id="subcategory">
          <option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?></option>
          <?php include("../includes/categorylist.php")?>
          </select></td>
      </tr>
      <tr>
        <td align="center" valign="middle">Book Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"><?php echo $details; ?></textarea>
        </label></td>
      </tr>
      <tr>
        <td align="center" valign="middle">Book Cover </td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="button" id="button" value="Make Changes" />
        </label></td>
      </tr>
    </table>
    </form>
    </div>

</div>
<?php include_once("template_pageBottomadmin.php"); ?>
</body>
</html>