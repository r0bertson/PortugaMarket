<?php require_once('Connections/conn_core_clients.php'); ?>

<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
    
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
  $loginUsername=$_SESSION['MM_Username'];
 
	//ACQUIRE THE CURRENT LOYALTY NUMBER STORED IN THE CORE DATABASE
 
  
  mysql_select_db($database_conn_core_clients, $conn_core_clients);
  $information ='';
  $query=sprintf("SELECT * FROM clients WHERE email=%s",
    GetSQLValueString($loginUsername, "text")); 
   
  $resultset = mysql_query($query, $conn_core_clients) or die(mysql_error());
  $row_resultset = mysql_fetch_assoc($resultset);
  $resultnumber = mysql_num_rows($resultset);
  if ($resultnumber > 0){
	  if($row_resultset['loyalnumber'] != ''){
		  $information = '<h> <br>Your current loyalty number is: ' . $row_resultset['loyalnumber'] .'.<br<br></h>';
	  }
  }
  

?>

<?php 
//UPDATE THE LOYALTY NUMBER IF THE BUTTON UPDATE IS PRESSED
  if((isset($_POST['loyalnumber'])) && ($_POST['loyalnumber']!= '')){
  	$loginUsername=$_SESSION['MM_Username'];
    $loyalnumber = $_POST['loyalnumber'];
  	mysql_select_db($database_conn_core_clients, $conn_core_clients);
  	$information ='';
  	$query=sprintf("UPDATE clients 
					SET loyalnumber = '$loyalnumber' 
					WHERE email=%s",
    GetSQLValueString($loginUsername, "text")); 
   
  	$resultset = mysql_query($query, $conn_core_clients) or die(mysql_error());
  	$information = '<h> Loyalty number updated! <br>Your new loyalty number is: ' . $loyalnumber .'.</h>';
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Home - PORTUGA MARKET</title>
<link href="stylenew.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
	<?php include('header.php'); ?>

   <div id="main">
    <div id="left">
      <h1>Your member area</h1>
      <p>Hello, <?php $row_resultset['firstname']?>. You can update your loyalty number in the following box.</p>

	 <?php echo $information; ?>
      <form id="form1" name="form1" method="post" action="">
        <p>
          <label for="loyalnumber">Loyalty Number</label>
          <input type="text" name="loyalnumber" id="loyalnumber" />
        </p>
        <p>
          <input type="submit" name="button" id="button" value="Update" />
        </p>
      </form>
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>

