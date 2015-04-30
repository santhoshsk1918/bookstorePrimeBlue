<?php

include("includes/connect.php");
include("includes/html_codes.php");
?>
<div id="pageTop">
  <div id="pageTopWrap">
    <div id="pageTopLogo">
      <a href="index.php">
        <img src="images/logo.png" alt="logo" title="Prime Blue">
      </a>
	  <div id="sidepannel">
	  <ul>
		<li><a><img src="images/down.png"/></a>
			<ul>
				<li><a href="category.php?category=Arts" >Arts </a></li>
				<li><a href="category.php?category=Body,Mind,Sprit">Body, Mind,Spirit</a></li>
				<li><a href="category.php?category=Business,Economics">Business,Economics</a></li>
				<li><a href="category.php?category=Cooking">Cooking</a></li>
				<li><a href="category.php?category=Educational">Educational</a></li>
				<li><a href="category.php?category=Family,Relationships">Family,Relationships</a></li>
				<li><a href="category.php?category=Fiction">Fiction</a></li>
				<li><a href="category.php?category=Health,Fitness">Health,Fitness</a></li>
				<li><a href="category.php?category=Reference">Reference</a></li>
				<li><a href="category.php?category=Self-Help">Self-Help</a></li>
				<li><a href="category.php?category=Travel">Travel</a></li>
			
			</ul>
	  </ul>
    </div>
</div>
    <div id="pageTopRest">
      <div id="menu1">
        <div>
         <?php topRightLinks(); ?>
        </div>
      </div>
      <div id="menu2">
		<?php topSearch(); ?>
        </div>
      </div>
    </div>
  </div>
  
  
  
  

