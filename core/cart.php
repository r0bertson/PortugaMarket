<?php session_start(); //start the session first
include "Connections/conn_core_clients.php";   //necessary mysql database connection
?>

<!-- 07/04 robertson - the following script will handle the adition of a product to the cart, 
the cart initialization and addition of one product that is already
in the cart -->
<?php if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
	$wasFound = false;
	$i = 0;
	// check if the cart session is already initialized and if there is products in the cart
	if (!isset($_SESSION["cart_storage"]) || count($_SESSION["cart_storage"]) < 1) { 
	    // if cart has no product
		$_SESSION["cart_storage"] = array(0 => array("product_id" => $product_id, "quantity" => 1));
	} else {
		// if cart has one product or more
		foreach ($_SESSION["cart_storage"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "product_id" && $value == $product_id) {
					  // if the item is already in the cart, only change the quantity
					  array_splice($_SESSION["cart_storage"], $i-1, 1, array(array("product_id" => $product_id, "quantity" => $each_item['quantity'] + 1)));
					  $wasFound = true;
				  } // end if
		      } // end while
	       } // end foreach
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_storage"], array("product_id" => $product_id, "quantity" => 1));
		   }
	}
	header("location: cart.php"); //redirect to cart page
    exit();
}
?>

<!-- 08/04 robertson - this function simply verify if the command in the session is equal to resetcart, then,
unset the cart_storage variable.-->
<?php 
//if the command variable set on the session is equal to resetcart, the cart_storage variable will be unset
if (isset($_GET['command']) && $_GET['command'] == "resetcart") {
    unset($_SESSION["cart_storage"]); 
}
?>


<!-- 08/04 robertson -this function verify if the variable adjust_product exists and is not "", then change the quantity
of the product passed in the adjust_product variable.-->
<?php 

if (isset($_POST['adjust_product']) && $_POST['adjust_product'] != "") {
    // execute some code
	$productToAdjust = $_POST['adjust_product'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace('#[^0-9]#i', '', $quantity); // remove everything, except numbers
	//set the maximum quantity
	if ($quantity >= 100) { 
		$quantity = 99; 
	}
	//set the minimum
	if ($quantity < 1) { 
		$quantity = 1; 
		}
	//if not defined, set to 1
	if ($quantity == "") { 
		$quantity = 1; 
	}
	$i = 0;
	foreach ($_SESSION["cart_storage"] as $each_item) {  //search the cart to find the product to adjust
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "product_id" && $value == $productToAdjust) {
					  //adjust quantity
					  array_splice($_SESSION["cart_storage"], $i-1, 1, array(array("product_id" => $productToAdjust, "quantity" => $quantity)));
				  } 
		      } 
	} 
}
?>

<!-- 09/04 robertson - this function removes an item of te cart, passing its index -->

<?php 
if (isset($_POST['remove']) && $_POST['remove'] != "") {
    // Access the array and run code to remove that array index
 	$index = $_POST['remove'];
	//if the cart has only one item, unset the variable cart_storage
	if (count($_SESSION["cart_storage"]) <= 1) {
		unset($_SESSION["cart_storage"]);
	//if the cart has more the one item, remove the index
	} else {
		unset($_SESSION["cart_storage"]["$index"]);
		sort($_SESSION["cart_storage"]);
	}
}
?>

<!-- 10/04 robertson - is responsible for populate the cart table, and also calculates the total amount -->
<?php 

$cartOutput = "";
$cartTotal = "";
$pp_checkout_btn = '';
$product_id_array = '';
if (!isset($_SESSION["cart_storage"]) || count($_SESSION["cart_storage"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
} else {
	// Start PayPal Checkout Button
	$pp_checkout_btn .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="you@youremail.com">';
	// Start the For Each loop
	$i = 0; 
    foreach ($_SESSION["cart_storage"] as $each_item) { 
		$product_id = $each_item['product_id'];
		$query = "SELECT * FROM products WHERE ID='$product_id' LIMIT 1";
		$result = mysql_query($query, $conn_core_clients) or die(mysql_error());
		while ($row = mysql_fetch_array($result)) {
			$name = $row["name"];
			$price = $row["price"];
			$description = $row["description"];
		}
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		// Dynamic Checkout Btn Assembly
		$x = $i + 1;
		$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $name . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $price . '">
        <input type="hidden" name="quantity_' . $x . '" value="' . $each_item['quantity'] . '">  ';
		// Create the product array variable
		$product_id_array .= "$product_id-".$each_item['quantity'].","; 
		// Dynamic table row assembly
		$cartOutput .= "<tr>";
		$cartOutput .= '<td><a href="product.php?id=' . $product_id . '">' . $name . '</a><br /><img src="product_images/' . $product_id . '.jpg" alt="' . $name. '" width="40" height="52" border="1" /></td>';
		$cartOutput .= '<td>' . $description . '</td>';
		$cartOutput .= '<td>$' . $price . '</td>';
		$cartOutput .= '<td><form action="cart.php" method="post">
		<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
		<input name="adjustButton' . $product_id . '" type="submit" value="Change" />
		<input name="adjust_product" type="hidden" value="' . $product_id . '" />
		</form></td>';
		//$cartOutput .= '<td>' . $each_item['quantity'] . '</td>';
		$cartOutput .= '<td>' . $pricetotal . '</td>';
		$cartOutput .= '<td><form action="cart.php" method="post"><input name="removeButton' . $product_id . '" type="submit" value="Remove" /><input name="remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
	;
	$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : ".$cartTotal." GBP</div>";
    // Finish the Paypal Checkout Btn
	$pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . '">
	<input type="hidden" name="notify_url" value="https://www.yoursite.com/storescripts/my_ipn.php">
	<input type="hidden" name="return" value="https://www.yoursite.com/checkout_complete.php">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="https://www.yoursite.com/paypal_cancel.php">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" src="bt_images/checkout.png" name="submit" alt="Checkout!">
	</form>';
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
 <div style="margin:24px; text-align:left;">
	
    <br />
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="18%" bgcolor="#C5DFFA"><strong>Product</strong></td>
        <td width="45%" bgcolor="#C5DFFA"><strong>Description</strong></td>
        <td width="10%" bgcolor="#C5DFFA"><strong>Price</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Quantity</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Total</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Remove</strong></td>
      </tr>
     <?php echo $cartOutput; ?>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
    </table>
    <?php echo $cartTotal; ?>
    <br />
<br />
<?php echo $pp_checkout_btn; ?>
    <br />
    <br />
    <a href="cart.php?cmd=emptycart">Click Here to Empty Your Shopping Cart</a>
    </div>
   <br />
	 
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>