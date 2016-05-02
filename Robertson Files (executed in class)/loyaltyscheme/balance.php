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

$colname_qPoints = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_qPoints = $_SESSION['MM_Username'];
}
mysql_select_db($database_conn_clients, $conn_clients);
$query_qPoints = sprintf("SELECT * FROM clients WHERE email = %s", GetSQLValueString($colname_qPoints, "text"));
$qPoints = mysql_query($query_qPoints, $conn_clients) or die(mysql_error());
$row_qPoints = mysql_fetch_assoc($qPoints);
$totalRows_qPoints = mysql_num_rows($qPoints);
$id = $row_qPoints['ID'];
$maxRows_history = 10;
$pageNum_history = 0;
if (isset($_GET['pageNum_history'])) {
  $pageNum_history = $_GET['pageNum_history'];
}
$startRow_history = $pageNum_history * $maxRows_history;

mysql_select_db($database_conn_clients, $conn_clients);
$query_history = "SELECT * FROM history WHERE ID='$id' ORDER BY history_id DESC";
$query_limit_history = sprintf("%s LIMIT %d, %d", $query_history, $startRow_history, $maxRows_history);
$history = mysql_query($query_limit_history, $conn_clients) or die(mysql_error());
$row_history = mysql_fetch_assoc($history);
$historyNumRows = mysql_num_rows($history);

if (isset($_GET['totalRows_history'])) {
  $totalRows_history = $_GET['totalRows_history'];
} else {
  $all_history = mysql_query($query_history);
  $totalRows_history = mysql_num_rows($all_history);
}
$totalPages_history = ceil($totalRows_history/$maxRows_history)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Balance - UWL LOYALTY SCHEME WEBSITE</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
  <?php include('header.php'); ?>
  <div id="main">
    <div id="left">
      <h1>Your balance</h1>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>You have <?php echo $row_qPoints['points']; ?> Loyalty Points.</p>
      <p>&nbsp;</p>
      <p>Your last purchases were:</p>
      <?php if($historyNumRows <1 ){
		  echo '<br><p align:"center"> Your still did not make any purchase in Portuga Market using your Loyalty Number </p>';
	  }else{
		  
		  ?>
      <table border="1">
        <tr>
          <td width="99">ID</td>
          <td width="132">Points</td>
          <td width="116">Date</td>
        </tr>
        <?php do { ?>
        <tr>
          <td><?php echo $row_history['ID']; ?></td>
          <td><?php echo $row_history['points']; ?></td>
          <td><?php echo $row_history['date']; ?></td>
        </tr>
        <?php } while ($row_history = mysql_fetch_assoc($history));} ?>
      </table>
      <p>&nbsp;</p>
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>
<?php
mysql_free_result($qPoints);

mysql_free_result($history);
?>
