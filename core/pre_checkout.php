<?php require_once('Connections/conn_payment.php'); ?>
<?php require_once('Connections/conn_loyalty.php'); ?>
<?php include "Connections/conn_core_clients.php";   //necessary mysql database connection
?>

<?php
if (!isset($_SESSION)) {
  session_start();
  $information = '';
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
	if(isset($_POST['loyal_control'])){
	$loyal_number = $_POST['loyal_number'];
	$password = $_POST['password'];
	
	mysql_select_db($database_conn_loyalty, $conn_loyalty);
	$query_q_loyalty = sprintf("SELECT * FROM clients WHERE ID=%s AND pwd=%s",GetSQLValueString($loyal_number, "text"), GetSQLValueString($password, "text"));
	$q_loyalty = mysql_query($query_q_loyalty, $conn_loyalty) or die(mysql_error());
	$row_q_loyalty = mysql_fetch_assoc($q_loyalty);
	$totalRows_q_loyalty = mysql_num_rows($q_loyalty);
	$information = '';
	$loyal_discount = '';
	$cartTotal = $_SESSION['cartTotal'];
	$discount = $_SESSION['discount'];

	if ($totalRows_q_loyalty > 0){
		if($row_q_loyalty['points'] < 100){
			$information = '<h> Hello ' .$row_q_loyalty['firstname'] . '! You only have ' . $row_q_loyalty['points'] . ' points. It is necessary at least 100 points to redeem them.';
		}else{
		$loyal_input = true;
		
		$loyal_discount = $row_q_loyalty['points']/100;
		$new_total = $cartTotal - $loyal_discount;
		$information = '<h> Hello ' .$row_q_loyalty['firstname'] . '! You are using ' . $row_q_loyalty['points'] . ' of your points in this purchase. The discount given by the loyalty scheme is: ' . $loyal_discount . '. <br> <br> Previous Cart total:' . $cartTotal . '<br>Products discount: ' . $discount .'<br>Loyalty discount: '. $loyal_discount .'<br> <br> New Cart total:' . $new_total . '<br></h>';
		$_SESSION['loyal_discount'] = $loyal_discount;
		$_SESSION['loyal_id'] = $loyal_number;
		$_SESSION['loyal_pwd'] = $password;
		$_SESSION['newTotal'] = $new_total;
		}
	}else{
		$_POST['loyal_control'] = false;
		if($_POST['loyal_number'] != ''){
		$information = '<h style="color:red;"> <br> The loyalty number and password are invalid. Try again. <br></h>';
	}

	}
	$_SESSION['loyal_discount'] = $loyal_discount;}
	?>
    
    
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Home - PORTUGA MARKET</title>
<link href="stylenew.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
</head>

<body>
<div id="wrapper">
  <?php include('header.php'); ?>
  <div id="main">
    <div id="left">
      <h1>Loyalty Scheme</h1>
      <?php 
	  
	  if(isset($_POST['loyal_control']) && ($_POST['loyal_control'] == true)){
		  echo $information;
	  } else{$_SESSION['newTotal'] = $_SESSION['cartTotal'];?>
      
      <fieldset>
        <legend>If you wish to use your loyalty points, please insert your data in the fields below and press Discount, then, select your payment method. </legend>
        <form id="form1" name="form1" method="POST" 
          
        
        
        <p><span id="sprytextfield1">
          <label for="loyal_number">Loyalty Number</label>
          <input type="text" name="loyal_number" id="loyal_number" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span><span class="textfieldInvalidFormatMsg">You must enter 8 digits.</span></span></p>
        <p><span id="sprypassword1">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" />
          <span class="passwordRequiredMsg">A value is required.</span></span></p>
        <p><?php echo $information;?>
          <input type="hidden" name="loyal_control" value="true">
          <input type="submit" name="discountButton" id="discountButton" value="Discount" />
        </p>
        <p>&nbsp;</p>
        <?php }?>
        <div>
          <p><a href="payment_cc.php"><img src="bt_images/cc_bt.jpg" width="450" height="130" alt="Credit Card"/></a> <a href="payment_paypal.php"><img src="bt_images/paypal_btjpg.jpg" width="450" height="130" alt="Paypal" /></a></p>
        </div>
        <input type="hidden" name="MM_insert" value="form1" />
        </form>
      </fieldset>
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {minChars:8, maxChars:8});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</html>