<?php include_once("adminstyle/adminhtml_codes.php");?>
<div id="pageTop">
  <div id="pageTopWrap">
    <div id="pageTopLogo">
      <a href="index.php">
        <img src="adminstyle/adminlogo.png" alt="logo" title="Prime Blue">
      </a>
    </div>
    <div id="pageTopRest">
      <div id="menu1">
        <div>
           <a href="adminregister.php">Register</a> | <a href = "adminlogin.php">Login</a> | <a href = "adminlogout.php">Logout</a>
        </div>
      </div>
      <div id="menu2">
      		
            <form action="adminsearch.php" method="get" name="input">
           			 <a href="inventorylist.php" class="buttons1">Inventory List</a>
            		<a href="additem.php" class="buttons1">Add Inventory Item</a>
            	<input type="text" id="keywords" name="keywords" size="40\" class="searchBox"/>
                <input type="submit" value="Search" class="buttons" />
            </form>
        </div>
      </div>
    </div>
  </div>
