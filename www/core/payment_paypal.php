<?php require_once('Connections/conn_payment.php');
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
<?php require_once('Connections/conn_core_clients.php'); ?>
<?php 
$information = '';
if(isset($_POST['submit']) && isset($_POST['email'])) {
	
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	mysql_select_db($database_conn_payment, $conn_payment);
	$query_q_payment = "SELECT * FROM paypal WHERE email='$email' AND pwd='$pwd'";
	$q_payment = mysql_query($query_q_payment, $conn_payment) or die(mysql_error());
	$row_q_payment = mysql_fetch_assoc($q_payment);
	$totalRows_q_payment = mysql_num_rows($q_payment);
 //DO THE QUERY HERE 
 	if($totalRows_q_payment > 0){
	 
	 	if( true){
		 	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=checkout3.php">';
	 	}
	else{ //REDIRECT TO FAILURE PAGE
	 	$information = '<h> Your payment was rejected by paypal.  Try again with a different payment method or other paypal account.</h>';
	 }
 }
 else{
	$information = '<h> The paypal information provided is incorrect. Try again.</h>';
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
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
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
          <p>&nbsp;</p>
          <p><span id="sprytextfield1">
          <label for="email">Paypal Email</label>
          <input type="text" name="email" id="email" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></p>
          <p><span id="sprypassword1">Password
              <input type="password" name="pwd" id="pwd" />
          <span class="passwordRequiredMsg">A value is required.</span></span></p>
          <p>&nbsp;</p>
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>
</html>