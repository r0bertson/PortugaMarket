<?php require_once('Connections/conn_payment.php'); ?>
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

$MM_restrictGoTo = "index.php";
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
?>


<?php 
$information = '';
if(isset($_POST['submit']) && isset($_POST['cardNumber'])) {
	
	$cardNumber = $_POST['cardNumber'];
	$name = $_POST['name'];
	$exp = $_POST['exp'];
	$cod = $_POST['cod'];
	mysql_select_db($database_conn_payment, $conn_payment);
	$query_q_payment = "SELECT * FROM creditcard WHERE cardnumber='$cardNumber' AND name='$name' AND expiration ='$exp' AND security='$cod'";
	$q_payment = mysql_query($query_q_payment, $conn_payment) or die(mysql_error());
	$row_q_payment = mysql_fetch_assoc($q_payment);
	$totalRows_q_payment = mysql_num_rows($q_payment);

 	if($totalRows_q_payment > 0){
	 
	 if( $row_q_payment['credit_available'] > $_SESSION['newTotal']){
		 ////header('Location: checkout.php');
		 //exit; 
		 $_SESSION['cardNumber'] = $cardNumber;
		 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=checkout3.php">';
		
	 }
	 else{ //REDIRECT TO FAILURE PAGE
	 $information = '<h> Your payment was rejected by the credit card company. You do not have enouth funds. Try again with a different credit card.</h>';
	 }
 }
 else{
	$information = '<h> The credit card information provided is incorrect. Try again.</h>';
 }
 
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register - PORTUGA MARKET</title>
<link href="stylenew.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
</head>

<body>

<div id ="wrapper">
<?php include('header.php'); ?>
      <div id="main">
  <div id="left">
      <h1>Payment by Credit Card</h1>
      <fieldset>
        <legend>Please, insert your credit card information and click checkout.</legend>
        <?php echo $information;?>
        <form id="form1" name="form1" method="POST" action="">
          <p><span id="sprytextfield1">
          <label for="cardNumber">Card Number</label>
          <input type="text" name="cardNumber" id="cardNumber" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span><span class="textfieldInvalidFormatMsg">You must provide 16 numbers.</span></span></p>
          <p><span id="sprytextfield3">
          <label for="name2">Cardholder Name</label>
          <input type="text" name="name" id="name2" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></p>
          <p><span id="spryselect1">
            <label for="exp2">Expiration Year</label>
            <select name="exp" id="exp2">
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              
            </select>
            <span class="selectRequiredMsg">Please select an item.</span></span>
            <label for="exp"></label>
          </p>
          <p><span id="sprytextfield2">
          <label for="cod2">Security Code</label>
          <input type="text" name="cod" id="cod2" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span><span class="textfieldInvalidFormatMsg">You must provide the 3 numbers  that are shown on the back of your card.</span></span></p>
          <p>
            <input type="submit" name="submit" id="submit" value="Checkout" />
          </p>
          <input type="hidden" name="MM_insert" value="form1" />
        </form>
      </fieldset>
    </div>
    </div>
  <?php include('footer.php'); ?>
</div>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {minChars:3, maxChars:3});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {minChars:16, maxChars:16});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {minChars:0, maxChars:40});
</script>
</body>
</html>

