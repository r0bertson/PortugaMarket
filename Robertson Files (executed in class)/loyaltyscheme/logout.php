
<?php 
	session_start();
	session_destroy(); /*destroy current session */
	header("Location: http://localhost/loyaltyscheme/index.php"); /* Redirect browser to index page*/
	exit();
	?> 