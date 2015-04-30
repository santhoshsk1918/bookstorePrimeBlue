<?php
include_once("connect.php");

	//Header nad Search Bar
	function topSearch(){
		if (isset ($_GET['keywords'])){
			$defalutText = htmlentities($_GET['keywords']);
		} else { $defalutText=" "; }
	
		echo '
			<div id="rightAlign" >
		';
		echo "
			</div>
			<div id=\"top_search\">
				<form name=\"input\" action=\"search.php\" method=\"GET\">
					<input type=\"text\" id=\"keywords\" name=\"keywords\" size=\"55\" class=\"searchBox\" value=\"$defalutText\"> &nbsp;
					<select id=\"category\" name=\"category\" class=\"searchBox\">
			
		";
		include_once("categorylist.php");// include categories here
		echo '
					</select>
					<input type="submit" value="Search" class="buttons" />
				</form>
				
			</div>
		';
	}
	
// Top Right Links#
function topRightLinks(){
	if(!isset($_SESSION['user_id']) ){
		echo '<a href="register.php">Register</a> | <a href="Login.php">Login</a> | <a href="Logout.php">Logout</a> &nbsp;&nbsp; <a href="cart.php" id="categorylink" style="background:#009;">YourCart</a>';
	} else {
		$user_id=$_SESSION['user_id'];
		$result = mysql_query("SELECT * FROM user WHERE user_id=$user_id") or die(mysql_error());
		$num = mysql_num_rows($result);
	while($row = mysql_fetch_array($result)){
		$user = $row['firstname'];
		}
		echo '<p><span style ="color:Red; font-fize:16px;">Hi &nbsp;' . $user . ' !&nbsp;&nbsp; </span><a href="profile.php">Profile </a> |<a href="history.php">History</a> | <a href="logout.php">Log out</a> &nbsp; &nbsp; <a href="cart.php" id="categorylink" style="background:#ccc;">YourCart</a></p>' ;
	}
}

//Creates Category options for search bar
function createCategoryList() {
	if( ctype_digit($_GET['category'])){ $x = $GET_['category']; } else { $x=999; }
	echo "<option> All Categories </option>";
	$i=0;
	while (1){
		if(nuberTOCategory($i)=="Category Does Not Exist"){
			break;
		}else {
			echo "<option value=\"$i\" ";
			if($i==$x) {echo' SELECTED ';}
			echo " > ";
			echo nuberTOCategory($i);
			echo "</option>";
		}
		$i++;
		
	}
}

//category Nubmer to string 
function nuberTOCategory($n){
	switch($n){
		case 0 :
			$cat= "Art";
			break;
		case 1 :
			$cat= "Body, Mind & Spirit";
			break;
		case 2 :
			$cat= "Business & Economics";
			break;
		case 3 :
			$cat= "Cooking";
			break;
		case 4 :
			$cat= "Educational";
			break;
		case 5 :
			$cat= "Family & Relationships";
			break;
		case 6 :
			$cat= "Fiction";
			break;
		case 7 :
			$cat= "Health & Fitness";
			break;
		case 8 :
			$cat= "Kids";
			break;
		case 9 :
			$cat= "Reference";
			break;
		case 10 :
			$cat= "Self-Help";
			break;
		case 11 :
			$cat= "Travel";
			break;
		case 12:
			$cat="Other";
			break;
		default:
			$cat = "Category Does Not Exist";
			break;
	}
	return $cat;
}
/*
//COde for account pages links
include("../functions/fum_userstats.php");
function accountLinks($x){
	$my_id = $_SESSION['user_id'];
	$allPending = CalculateAllPendingItems();
	$allReported = calculateAllReportedItems();
	$userActive  = CalculateUserActivceItems($my_id);
	$usersPending = CalculateUsersPendingItems($my_id);
	// those functions are not created yet
	$userOfferRecived = CalculateUsersOffersRecived($my_id);
	$userOfferMade = CalculateUsersOffersMade($my_id);
	$userCompletedTrades = CalculateUsersCompletedTrades($my_id);
	$usersUnreadMessages = CalculateUsersUnreadMessages($my_id);
	}
	switch ($x) {
		case 0:
			$additems = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 1:
			$myitems = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 2:
			$myprofile = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 3:
			$shippinginfo = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 4:
			$offersrecived = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 5:
			$offersmade = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 6:
			$offersdeclined = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 7:
			$completetrades = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 8:
			$inbox = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 9:
			$sent = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 10:
			$trash = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 11:
			$compose = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 12:
			$additems = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 13:
			$reported = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 14:
			$myactive = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 15:
			$mypending = ' style="Color:white; text-shadow: 1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" ';
		break;
		case 99: break;
		$result = mysql_query ("SELECT * FROM users WHERE user_id=$my_id  and (role='mod' OR role='admin')");
		if(mysql_num_rows($result)==1){
			echo " <div id=\"modnav\">
					<span class=\"navheadings\">Moredator</span>
					<ul class=\"menu\"> 
						<li> <a href=\"mod_pending.php\" $peinding> <span> Pending $allPending </span></li>
					</ul>			
				</div>";
		
		}
	}*/
?>