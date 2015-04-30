<?php
	include("includes/connect.php");
	$dyn_list = "";
	$sql=mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 12");
	$pqr = mysql_num_rows($sql);
	$i = 0;
	if($pqr >0){
		$dyn_list .= '<table bgcolor="#CCCCCC">';
		while($row = mysql_fetch_array($sql)){
			$id = $row['pid'];
			$product_name = $row['product_name'];
			$author = $row['author'];
			$price = $row['price'];
			$publications = $row['publications'];
			$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
		}
		}else{
		$dyn_list="SORRY!! <br />We have no products in our store yet";	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
	
<body>
<?php echo $dyn_list; ?>
</body>
</html>