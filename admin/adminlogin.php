<?php
session_start();
include("../includes/connect.php");

 if( isset($_SESSION['manager'])){
		header('Location:index.php');
		exit();
	}
	
	if(isset($_POST['submit'])){
		$error= array();
		
		//username		
		if(empty($_POST['username'])){
				$error[]='please enter a username. ';
		}	else if ( ctype_alnum($_POST['username'])) {
				$manager = $_POST['username'];
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
				$result = mysql_query("SELECT * FROM admin WHERE manager='$manager' AND password='$password' ")
				or die (mysql_error());
				if (mysql_num_rows($result)==1){
					while($row = mysql_fetch_array($result)){
						$id =  $row['aid'];
					}
							 $_SESSION["mid"] = $id;
							 $_SESSION["manager"] = $manager;
							 $_SESSION["password"] = $password;
							 header("location: index.php");
							 exit();
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
<link rel="icon" href="adminstyle/PBA.ico" type="image/x-icon">
<link rel="stylesheet" href="adminstyle/adminstyle.css">
<link rel="stylesheet" href="../style/login.css">
</head>
<body>
<?php include_once("template_pageTopadmin.php"); ?>
<div id="pageMiddle">
				<h3 id="regheading">Not an admin? try <a href="../login.php" style="text-decoration:none; font-style:italic">User Login</a>
				<h3 id="regheading">Not yet registered <a href="adminregister.php" style="text-decoration:none;font-style:italic ">Register Now</a>
				<h3 id="regheading">Log In Here</h3>
				<hr style="color:Brown;" />
				<form id="loginform" name="loginform" method="post" action="">
					<h3 style="color:red;"> Admin Login<h3>
					<?php if(isset($_POST['submit'])){echo $error_message;} ?>
					<label id="label" for="username">Manager: </label>
					<input type="text" id="username" name="username" maxlength="88"><br /><br />
					<label id="label" for="username">Password: </label>
					<input type="password" id="password"  name="password" maxlength="100">
					<br /><br /><br />
					<input type="submit" class="buttons" id="submit" name="submit" value="Login"/>
				</form>	

		</div>
</div>
<?php include_once("template_pagebottomadmin.php"); ?>
</body>
</html>

