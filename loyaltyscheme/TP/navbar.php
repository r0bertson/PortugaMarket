   
   
    <?php 

    include("checkSession.php");   


/*
    <?php 

    
    if ((function_exists('session_status') 
  && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) { ?>
  
  */
  	if ($loginst == 1){ ?>
        <div id="navbar">
            <a href="index.php">home</a>  <a href="aboutUs.php">about us</a> <a href="contactUs.php">contact us</a>  <a href="logout.php">log out</a>
               
               
            
        </div>

    <?php } else { ?>
        <div id="navbar">
              
            <a href="index.php">home</a>  <a href="aboutUs.php">about us</a> <a href="contactUs.php">contact us</a> <a href="register.php">register</a> <a href="login.php">log in</a>
        </div> 
    <?php } ?>