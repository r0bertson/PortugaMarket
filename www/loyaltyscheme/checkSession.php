<?php require_once('Connections/conn_clients.php'); ?>
<?php

//session_start();
$loginst = 0;
if(isset($_SESSION['MM_Username'])) {
//	if(!empty($_SESSION['email'])) {
	$user_check = $_SESSION['MM_Username'];
 	mysql_select_db($database_conn_clients, $conn_clients);
	$check_query = sprintf("SELECT email FROM clients WHERE email='$user_check' ");
	$check_result = mysql_query($check_query, $conn_clients) or die(mysql_error());
	
 
  	$found_user = mysql_num_rows($check_result);


	if(!empty($found_user)) {
   		$loginst = 1;
	}

}

?>