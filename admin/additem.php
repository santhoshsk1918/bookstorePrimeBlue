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
	if (isset($_POST['product_name'])) { 
		$error= array();
		
		
		$product_name = mysql_real_escape_string($_POST['product_name']);
		$author = mysql_real_escape_string($_POST['author']);
		$publications = mysql_real_escape_string($_POST['publications']);
		$pages = mysql_real_escape_string($_POST['pages']);
		$price = mysql_real_escape_string($_POST['price']);
		$category = mysql_real_escape_string($_POST['category']);
		$subcategory = mysql_real_escape_string($_POST['subcategory']);
		$details = mysql_real_escape_string($_POST['details']);
		if($product_name=="" || $author=="" || $publications==""|| $pages=="" || $price == "" || $category == "Category" || $details== "" ){
			$error[] = 'Please fill all the fields before submittind !!';
		}
		
			$sql = mysql_query("SELECT pid FROM products WHERE product_name='$product_name' LIMIT 1")  or die ("Sorry !!  Could not connect to database");
			$productMatch = mysql_num_rows($sql); 
			if ($productMatch > 0) {
				$error[] ='Sorry you tried to place a duplicate "Product Name" into the system';	
			}
			if (empty ($error)){
			
			$sql = mysql_query("INSERT INTO products (product_name , author , publications , pages , price, details, category, subcategory, date_added) 
				VALUES('$product_name','$author','$publications','$pages','$price','$details','$category','$subcategory',now())") or die ("Sorry !! Could 11 not connect to database");
			 $pid = mysql_insert_id();
			 
			$newname = "$pid.jpg";
			move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
			header("location: inventorylist.php"); 
			exit();
			}else{
				$error_message ='<span class="error">' ;
				foreach($error as $key => $values) {
					$error_message.= "$values<br />";
				}
				$error_message.="</span> <br/><br/>";
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
<body bgcolor="#F4F4F4">
<?php include_once("template_pageTopadmin.php"); ?>
<div id="pageMiddle" >
<h3 id="h3heading">Add Inventory Items</h3>
<div id="additemform">
<form action="additem.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
	<?php if(isset($_POST['product_name'])){echo $error_message;} ?>
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="center" valign="middle">Book Name</td>
        <td width="80%" align="left"><label>
          <input name="product_name" type="text" id="product_name" size="64" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="center" valign="middle">Author</td>
        <td width="80%" align="left"><label>
          <input name="author" type="text" id="author" size="64" />
        </label></td>
      </tr>
      <td width="20%" align="center" valign="middle">Publication</td>
        <td width="80%" align="left"><label>
          <input name="publications" type="text" id="publications" size="64" />
        </label></td>
      </tr>
      <td width="20%" align="center" valign="middle">Pages</td>
        <td width="80%" align="left"><label>
          <input name="pages" type="text" id="pages" size="4" />
        </label></td>
      </tr>
      
      <tr>
        <td align="center" valign="middle">Book Price</td>
        <td align="left"><label>
         <span tyle="font-size:16px;color:#069;">Rs</span>
          <input name="price" type="text" id="price" size="12" />
        </label></td>
      </tr>
      <tr>
        <td align="center" valign="middle">Category</td>
        <td align="left"><label>
          <select name="category" id="category">
          <?php include("../includes/categorylist.php")?>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="center" valign="middle">Subcategory</td>
        <td align="left"><select name="subcategory" id="subcategory">
        	<?php include("../includes/categorylist.php")?>
          </select></td>
      </tr>
      <tr>
        <td align="center" valign="middle">Book Details</td>
        <td align="left"><label>
          <textarea name="details" id="details" cols="64" rows="5"></textarea>
        </label></td>
      <tr>
        <td align="center" valign="top"><label for="fileField">Book Cover</label></td>
        <td align="left"><label>
          <input type="file" name="fileField" id="fileField" />
        </label><p class="hint">Please add .jpg and .png formats only</p></td>
        
      </tr>      
      <tr>
      	<td align="right"><h4> Please view <a href="terms.php" target="_blank">Terms </a></h4></td>
        <td><h4 align="left">for adding new item</h4></td>
      </tr>
      <tr>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="left"><label>
          <input type="submit" name="button" id="button" value="Add This Item Now" />
        </label></td>
      </tr>
    </table>
    
    </form>
    <br />
   </div>
</div>
<?php include_once("template_pageBottomadmin.php"); ?>
</body>
</html>