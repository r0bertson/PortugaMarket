<?php require_once('Connections/conn_clients.php'); ?>
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

$colname_qClient = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_qClient = $_SESSION['MM_Username'];
}
mysql_select_db($database_conn_clients, $conn_clients);
$query_qClient = sprintf("SELECT * FROM clients WHERE email = %s", GetSQLValueString($colname_qClient, "text"));
$qClient = mysql_query($query_qClient, $conn_clients) or die(mysql_error());
$row_qClient = mysql_fetch_assoc($qClient);
$totalRows_qClient = mysql_num_rows($qClient);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Client Area - UWL LOYALTY SCHEME WEBSITE</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
  <?php include('header.php'); ?>
  <div id="main">
    <div id="left">
      <h1>Hello <?php echo $row_qClient['lastname']; ?>, </h1>
      <p>welcome to the UWL Loyalty Scheme clients area!</p>
      <p>&nbsp;</p>
      <p>Thank you for becoming one of our loyal clients. In this area, you can check how many Loyalty Points you have.</p>
      <p>You can also verify, the amount of points you earned at each of your past purchases in Portuga Market.</p>
      <p>&nbsp;</p>
      <p><strong>Your loyalty number is: <?php echo $row_qClient['ID']; ?></strong></p>
      <p>You can use it with your password to redeem your points in Portuga Market website.</p>
      <p>&nbsp;</p>
      <p>Be sure to visit your <a href="balance.php">balance</a> page to view your loyalty points. </p>
      <p>For more information about scheme, please contact us. You can find our contact information at <a href="contactUs.php">contact us</a> page.</p>
      <p>&nbsp;</p>
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>
<?php
mysql_free_result($qClient);
?>
