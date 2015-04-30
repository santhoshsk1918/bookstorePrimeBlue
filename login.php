<?php
	session_start();
	include("includes/connect.php");
	
	if(isset($_SESSION['user_id']) ){
		$uid = $_SESSION['user_id'];
		header('Location:index.php');
		exit();
	}
	if(isset($_SESSION['mid']) ){
		header('Location:admin/index.php');
		exit();
	}
	
	if(isset($_POST['submit'])){
		$error= array();
		
		//username		
		if(empty($_POST['username'])){
				$error[]='please enter a username. ';
		}	else if ( ctype_alnum($_POST['username'])) {
				$username = $_POST['username'];
		} 	else{
			$error[]='Username must consist of letters and numbers only. ';
		}
		
		//password
		if(empty($_POST['password'])){
			$error[]='please enter a password. ';
		}	else {
				$pass = mysql_real_escape_string ($_POST['password']);
				$password = md5($pass);
		}	
		
		if (empty ($error)){
				$result = mysql_query("SELECT * FROM user WHERE username='$username' AND password='$password' ")
				or die (mysql_error());
				if (mysql_num_rows($result)==1){
					while($row = mysql_fetch_array($result)){
						$_SESSION['user_id'] =  $row['user_id'];
						$userid =  $row['user_id'];
						header('Location:index.php');
					}
			}else{
				$error_message ='<span class="error"> Username or password is incorrect </span> <br /> <br />' ;
			}
			}else{
			$error_message ='<span class="error">' ;
				foreach($error as $key => $values) {
					$error_message.= "$values";
				}
			$error_message.="</span> <br/><br/>";
		}
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
				<h3 id="regheading">Not yet registered <a href="register.php" style="text-decoration:none;">Register Here</a>
				<h3 id="regheading">Log In Here</h3>
				<hr style="color:Brown;" /><br />
				<form id="loginform" name="loginform" method="post" action="">
					<h3>Login<h3>
					<?php if(isset($_POST['submit'])){echo $error_message;} ?>
					<label id="label" for="username">Username: </label>
					<input type="text" id="username" name="username" maxlength="88"><br /><br />
					<label id="label" for="username">Password: </label>
					<input type="password" id="password" name="password" maxlength="100">
					<br /><br /><br />
					<input type="submit" class="buttons" id="submit" name="submit" value="Login"/>
				</form>	

		</div>
</div>
<?php include_once("template/template_pageBottom.php"); ?>
</body>
</html>

