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
if (isset($_GET['deletename'])) {
	echo 'Do you really want to delete product with product name of ' . $_GET['deletename'] . '? <a href="deleteitem.php?yesdelete=' . $_GET['deletename'] . '">Yes</a> | <a href="inventorylist.php">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	// delete from database
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysql_query("DELETE FROM products WHERE product_name='$id_to_delete' LIMIT 1") or die (mysql_error());
	// unlink the image from server
	// Remove The Pic -------------------------------------------
    $pictodelete = ("../inventory_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: inventorylist.php"); 
    exit();
}
?>
