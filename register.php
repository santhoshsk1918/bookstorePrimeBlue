<?php 
	session_start();
	include("includes/connect.php");
	if(isset($_SESSION['user_id']) ){
		header('Location:index.php');
		exit();
	}
	if(isset($_SESSION['mid']) ){
		header('Location:admin/index.php');
		exit();
	}
	
if(isset($_POST['signup'])){
	include_once("includes/connect.php");
	$error = array();
	if((!isset($_POST['username'])) || (!isset($_POST['pass1'])) || (!isset($_POST['fname'])) || (!isset($_POST['lname']))|| (!isset($_POST['email'])) || (!isset($_POST['phoneno'])) || (!isset($_POST['gender']))){
		
		echo "please enter all the fields";
		exit();
		
	}else{
		$u = preg_replace('#[^a-z0-9]#i', '', $_POST['username']);
		$e = mysql_real_escape_string($_POST['email']);
		$pass = $_REQUEST['pass1'];
		$g = preg_replace('#[^a-z]#', '', $_POST['gender']);
		$fn = preg_replace('#[^a-z ]#i', '', $_POST['fname']);
		$ln = preg_replace('#[^a-z]#i', '', $_POST['lname']);
		$ph = preg_replace('#[^0-9]#', '', $_POST['phoneno']);

		$p = md5($pass);
			$query = mysql_query("INSERT INTO user(username,email,password,firstname,lastname,gender,phoneno,avatar,lastlogin) VALUES ('$u','$e','$p','$fn','$ln','$g','$ph','0',now()) ") or die (mysql_error());
				if(!$query){
					echo "Could not insert into database";
				}
				else{
					header("Location:thankyou.php");
					exit();
				}
		}
	}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Primeblue Books register</title>
<link rel="icon" href="images/prime.ico" type="image/x-icon">
<link rel="stylesheet" href="style/style.css">
<link rel="stylesheet" href="style/register.css">
<script src="scripts/main.js"></script>
<script src="scripts/utils.js" type="text/javascript"></script> 
<script src="scripts/validation.js" type="text/javascript"></script> 
</head>
<body>
<?php include_once("template/template_pageTop.php"); ?>
<div id="pageMiddle">
	<div id="register">
			<h3 id="regheading"> Already Registered <a href="login.php" style="text-decoration:none;"> Login Here</a></h3>
            <?php if(isset($_POST['signup'])){echo $error_message;} ?>
			<h3 id="regheading"> Some Basic Information</h3>
			<hr style="color:Brown;" /><br />
			<form name="signupform" id="signupform" action="register.php" method="post">
				<label id="label" for="username">Username: </label>
				<input id="username" type="text" onkeyup="restrict('username')" maxlength="20" name="username">
				<span id="unamestatus"></span><br /><br />
				<label id="label" for="email">Email Address: </label>
				<input id="email" type="text" onfocus="emptyElement('status')" name="email" onkeyup="restrict('email')" maxlength="88">
				<span id="emailstatus"></span><br /><br />
				<label id="label" for = "pass1">Create Password: </label>
				<input id="pass1" type="password" onfocus="emptyElement('status')" maxlength="16" name="pass1" >
				<span id="passstatus"></span><br /><br />
				<label id="label" for="pass2">Confirm Password:</label> 
				<input id="pass2" type="password" onfocus="emptyElement('status')" maxlength="16" name="pass2" ><br /><br />
				<h3 id="regheading">Personal Information </h3>
				<hr style="color:Brown;" /><br />
				<label id="label" for="fname">First Name: </label>
				<input id="fname" type="text" onfocus="emptyElement('status')" maxlength="26"  name="fname"><br /><br />
				<label id="label" for="lname">Last Name: </label>
				<input id="lname" type="text" onfocus="emptyElement('status')" maxlength="26" name="lname"><br /><br />
				<label id="label" for="gender">Gender: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</label>
					<select id="gender" onfocus="emptyElement('status')" name="gender">
					  <option value="">Gender</option>
					  <option value="m">Male</option>
					  <option value="f">Female</option>
					</select>
				<br /><br />
				<label id="label" for="phoneno">Phone Number: &nbsp &nbsp &nbsp</label>
				<input id="phoneno" type="text" onfocus="emptyElement('status')" maxlength="10" name="phoneno">
				<br /><br />
		<div>
        <hr style="color:Brown;" /><br />
        <h4 id="regheading">Please view the terms before creating the account</h4>
		  <a href="#" onclick="return false" onmousedown="openTerms()">
			View the Terms Of Use
		  </a>
		</div><br />

		<div id="terms" style="display:none;">
		  <h3>Prime Books Terms Of Use</h3>
		  <p>1.This site belongs to IBM developed by 
		  primeBlue for TGMC 2012.</p>
		</div>
		<br /><br />
		<!--this is  to submit through ajax-->
		<button id="signup" name="signup" class="buttons">Create Account</button>
		<span id="status"></span>
		<!--<input type="submit" class="buttons" name="submit" id="submit" value="Create Account" style="float:left;height:30px;width:125px;"/>-->
	  </form>
	</div>	
</div>
<?php include_once("template/template_pageBottom.php"); ?>
</body>
</html>