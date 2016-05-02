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
	if ($quantity >= 5) { 
		$quantity = 5; 
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
$discount = 0;
$extrapoints = 0;
if (!isset($_SESSION["cart_storage"]) || count($_SESSION["cart_storage"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
} else {
	// Start PayPal Checkout Button
	$pp_checkout_btn .= '<form action="pre_checkout.php" method="post">';
	// Start the For Each loop
	$i = 0; 
    foreach ($_SESSION["cart_storage"] as $each_item) { 
		$product_id = $each_item['product_id'];
		$query = "SELECT * FROM products WHERE ID='$product_id' LIMIT 1";
		$result = mysql_query($query, $conn_core_clients) or die(mysql_error());
		$pricetotal = 0; //initialize pricetotal
		while ($row = mysql_fetch_array($result)) {
			$name = $row["name"];
			$price = $row["price"];
			$description = $row["description"];
			$specialoffer = $row["specialoffer"];
		}
		//DISCOUNTS ARE APPLIED IN THE NEXT IF STATEMENTS
		//(3-for-2, 2) (buy-1-get-1-free, 3) (half-price, 4) (100 lp, 5)
		if($specialoffer == 1){
			//NO SPECIAL OFFER
			$pricetotal = ($price * $each_item['quantity']);
		}
		else if(($specialoffer == 2) && ($each_item['quantity'] > 2)){
			//3 FOR 2
			$quantity_discounted = floor($each_item['quantity']/3);	
			$discount = $discount + $quantity_discounted * $price;
			$pricetotal = $price * ($each_item['quantity'] - $quantity_discounted);		
		}
		else if(($specialoffer == 3) && ($each_item['quantity'] > 1)){
			//BUY 1 GET 1 FREE
			$quantity_discounted = floor($each_item['quantity']/2);	
			$discount = $discount + $quantity_discounted * $price;
			$pricetotal = $price * ($each_item['quantity'] - $quantity_discounted);			
		}
		else if($specialoffer == 4){
			//HALF PRICE
			$discount = $discount + ($each_item['quantity'] * $price)/2;
			$pricetotal = ($price * $each_item['quantity'])/2;			
		}
		else if($specialoffer == 5){
			//100 LP
			$extrapoints += 100 * $each_item['quantity'] ;
			$pricetotal = ($price * $each_item['quantity']);			
		}
		else{
			$pricetotal = ($price * $each_item['quantity']);
		}
		
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
		
		//Display the picture linking to the page of product
		$cartOutput .= '<td><a href="product.php?id=' . $product_id . '">' . $name . '</a><br /><img src="product_images/' . $product_id . '.jpg" BORDER="0" alt="' . $name. '" width="40" height="52" border="1" /></td>';
		//display description
		$cartOutput .= '<td>' . $description . '</td>';
		
		//display the individual price
		$cartOutput .= '<td>&pound '. $price . '</td>';
		
		//Button and textfield to perfom a change in the quantity of a product
		$cartOutput .= '<td><form action="cart.php" method="post">
		<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
		<input name="adjustButton' . $product_id . '" type="submit" value="Change" />
		<input name="adjust_product" type="hidden" value="' . $product_id . '" />
		</form></td>';
		
		//display the total charged for the products (the total quantity of it)
		$cartOutput .= '<td>&pound ' . $pricetotal . '</td>';
		$cartOutput .= '<td><form action="cart.php" method="post"><input name="removeButton' . $product_id . '" type="submit" value="Remove" /><input name="remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
	
	$_SESSION['cartTotal'] = $cartTotal;
	$_SESSION['discount'] = $discount;
	$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : ".$cartTotal." &pound </div>";
	$discount = "<div style='font-size:18px; margin-top:12px;' align='right'>Discount applied : ".$discount." &pound </div>";
    // Finish the Paypal Checkout Btn
	
	$pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . '">
	<input type="hidden" name="cartTotal" value="' . $cartTotal . '">
	<input type="hidden" name="discount" value="' . $discount . '">
	<input type="hidden" name="extrapoints" value="' . $extrapoints . '">
	<input type="image" src="bt_images/checkout.png" name="submit" alt="Checkout!">
	</form>';
	
	$_SESSION['extrapoints'] = $extrapoints;
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
	<a href="cart.php?cmd=emptycart">Click Here to Empty Your Shopping Cart</a>
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
    <?php echo $discount; ?>
    <br />
<br />
<?php echo $pp_checkout_btn; ?>
    <br />
    <br />
    </div>
   <br />
	 
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>