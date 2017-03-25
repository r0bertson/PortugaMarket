<?php require_once('Connections/conn_core_clients.php'); ?>
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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="registerFailed.php";
  $loginUsername = $_POST['email'];
  $LoginRS__query = sprintf("SELECT email FROM clients WHERE email=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_conn_core_clients, $conn_core_clients);
  $LoginRS=mysql_query($LoginRS__query, $conn_core_clients) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

// *** Redirect if username exists (in our case, the email)
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="registerFailed.php";
  $loginUsername = $_POST['email'];
  $LoginRS__query = sprintf("SELECT email FROM clients WHERE email=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_conn_core_clients, $conn_core_clients);
  $LoginRS=mysql_query($LoginRS__query, $conn_core_clients) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO clients (pwd, email, firstname, lastname,loyalnumber) VALUES (%s, %s, %s, %s, '')",
                       GetSQLValueString($_POST['pwd'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"));

  mysql_select_db($database_conn_core_clients, $conn_core_clients);
  $Result1 = mysql_query($insertSQL, $conn_core_clients) or die(mysql_error());

  $insertGoTo = "login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register - PORTUGA MARKET</title>
<link href="stylenew.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id ="wrapper">
<?php include('header.php'); ?>
      <div id="main">
  <div id="left">
      <h1>Registration Form</h1>
      <fieldset>
        <legend>Register to be a member of our website</legend>
        <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
          <p>
            <label for="firstname">First Name</label>
            <input name="firstname" type="text" id="firstname" size="30" maxlength="40" />
          </p>
          <p>Last Name 
            <label for="lastname"></label>
            <input name="lastname" type="text" id="lastname" size="30" maxlength="40" />
          </p>
          <p>Email 
            <label for="email"></label>
            <input name="email" type="text" id="email" size="40" maxlength="40" />
          </p>
          <p>Password 
            <label for="pwd"></label>
            <input name="pwd" type="password" id="pwd" size="10" maxlength="15" />
          </p>
          <p>
            <input type="submit" name="submit" id="submit" value="Register" />
          </p>
          <input type="hidden" name="MM_insert" value="form1" />
        </form>
      </fieldset>
    </div>
    </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>