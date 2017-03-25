

<?php 
    include("checkSession.php");   
?>

  	<style type="text/css">
    	@import url("styles.css");
	</style>
    <?php 

    if ($loginst == 1){ ?>  
    <!-- IF THERE IS AN USER LOGGED IN -->
    <div id="navbar">
            <ul>
            	<li><a href="index.php">Home</a></li>
                <li><a href="#">Shopping</a> 
                	<ul>
                		<li><a href="category_page.php?page_category=freshfood">Fresh Food</a></li>
                    	<li><a href="category_page.php?page_category=drinks">Drinks</a></li>
                    	<li><a href="category_page.php?page_category=clothing">Clothing</a></li>
                	</ul>
            	</li>
                <li><a href="aboutUs.php">About Us</a></li>
                <li><a href="http://localhost/loyaltyscheme/index.php">Loyalty Scheme</a></li>
            	<li><a href="clientArea.php">Your Area</a></li>
            	<li><a href="logout.php">Logout</a></li>
            	<li><a href="cart.php">Cart</a></li>          
            </ul>
        </div>

    <?php } else { ?>
	 <!-- IF THERE IS NOT AN USER LOGGED IN -->
     <div id="navbar">
            <ul>
            	<li><a href="index.php">Home</a></li>
                <li><a href="#">Shopping </a>
                	<ul>
                		<li><a href="category_page.php?page_category=freshfood">Fresh Food</a></li>
                    	<li><a href="category_page.php?page_category=drinks">Drinks</a></li>
                    	<li><a href="category_page.php?page_category=clothing">Clothing</a></li>
                	</ul>
            	</li>
                <li><a href="aboutUs.php">About Us</a></li>
                <li><a href="http://localhost/loyaltyscheme/index.php">Loyalty Scheme</a></li>
            	
            	<li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            	<li><a href="cart.php">Cart</a></li>
           </ul>              
    </div>
    <?php } ?>