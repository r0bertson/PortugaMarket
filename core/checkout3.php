<?php session_start(); //start the session first
require_once("Connections/conn_core_clients.php");   //necessary mysql database connection
?>
<?php require_once('Connections/conn_loyalty.php'); ?>
<?php require_once('Connections/conn_payment.php'); ?>
<?php require_once("phpmailer/email.php"); ?>


<!-- 10/04 robertson - populate the table and the information of purchase -->
<?php 

$output = "";
$extrapoints = '';
$total = '';
$product_id_array = '';
if((isset($_SESSION['loyal_discount'])) && ($_SESSION['loyal_discount'] != 0)){
	$lp_number = $_SESSION['loyal_id'];
	$lp_pwd = $_SESSION['loyal_pwd'];
	$loyal_discount = $_SESSION['loyal_discount'];
}
else{
	$lp_number = '';
	$lp_pwd = '';
	$loyal_discount = 0;
}
$discount = 0;

if (!isset($_SESSION["cart_storage"]) || count($_SESSION["cart_storage"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
} else {
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
			$discount = $discount + ( $quantity_discounted * $price );
			$pricetotal = $price * ($each_item['quantity'] - $quantity_discounted);			
		}
		else if($specialoffer == 4){
			//HALF PRICE
			$discount = $discount + ($each_item['quantity'] * $price)/2;
			$pricetotal = ($price * $each_item['quantity'])/2;			
		}
		else if($specialoffer == 5){
			//100 LP
			$extrapoints += 100 * $each_item['quantity'];
			$pricetotal = ($price * $each_item['quantity']);			
		}
		else{
			$pricetotal = ($price * $each_item['quantity']);
		}
		
		$total = $pricetotal + $total;
		// Dynamic Checkout Btn Assembly
		$x = $i + 1;
		
		$product_id_array .= "$product_id-".$each_item['quantity'].","; 
		// Dynamic table row assembly
		$output .= "<tr>";
		
		//Display the picture linking to the page of product
		$output .= '<td><a href="product.php?id=' . $product_id . '">' . $name . '</a><br /><img src="product_images/' . $product_id . '.jpg" alt="' . $name. '" width="40" height="52" border="1" /></td>';
		
		//display the individual price
		$output .= '<td>&pound '. $price . '</td>';
		
		//Button and textfield to perfom a change in the quantity of a product
		$output .= '<td>' . $each_item['quantity'] . '</td>';
		
		//display the total charged for the products (the total quantity of it)
		$output .= '<td>&pound ' . $pricetotal . '</td>';
		$output .= '</tr>';
		$i++; 

    }
	$newTotal =  $_SESSION['newTotal'];
	$points_earned = floor($extrapoints + $newTotal);
	$discount = "<div style='font-size:18px; margin-top:12px;' align='right'>Promotion discount applied : ".$discount." GBP</div>";
	$loyal_discount = "<div style='font-size:18px; margin-top:12px;' align='right'>Loyal discount applied : ".$loyal_discount." GBP</div>";
	$total = "<div style='font-size:18px; margin-top:12px;' align='right'>Products total : ".$total." GBP</div>";
	$newTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Purchase total : ".$newTotal." GBP</div>";
	$extrapoints = "<div style='font-size:18px; margin-top:12px;' align='right'>Points earned : ".$points_earned." LP</div>";
}
?>



<!-- 15/04  - THE CODE BELOW WILL UPDATE THE LOYALTY SCHEME DATABASES -->
<?php 
$username = $_SESSION['MM_Username'];
if(($lp_number != '')&&($lp_pwd != '')){
	//if points were used, set to 0
	$points = 0;
	$query = "UPDATE loyaltyscheme.clients SET clients.points = '$points' WHERE ID='$lp_number'";
	$result = mysql_query($query, $conn_loyalty) or die(mysql_error());
}
$query = "SELECT * FROM clients WHERE email='$username' LIMIT 1";
$result = mysql_query($query, $conn_core_clients) or die(mysql_error());
$row_result = mysql_fetch_assoc($result);
if($row_result['loyalnumber'] !=''){
	$lnumber = $row_result['loyalnumber'];
	$today = date("m.d.y"); 
	if(($lp_number != '')&&($lp_pwd != '')){
		$points_deducted = $_SESSION['loyal_discount']*100;
		$query2 = "INSERT INTO loyaltyscheme.history (ID, date, points) VALUES ('$lnumber','$today','-$points_deducted')";
		$result = mysql_query($query2, $conn_loyalty) or die(mysql_error());
	}
	//the client set the loyalnumber in members area, so any purchase will generate loyalty points
	$query = "UPDATE loyaltyscheme.clients SET points = points + '$points_earned' WHERE ID='$lnumber'";
	$result = mysql_query($query, $conn_loyalty) or die(mysql_error());
	   
	//update history of points
	$query2 = "INSERT INTO loyaltyscheme.history (ID, date, points) VALUES ('$lnumber','$today','$points_earned')";
	$result = mysql_query($query2, $conn_loyalty) or die(mysql_error());
}
?>

<!-- 
16/04 - the following code will udpate the payment database

-->
<?php 

	foreach ($_SESSION["cart_storage"] as $each_item) { 
		$product_id = $each_item['product_id'];
		$query = "SELECT * FROM products WHERE ID='$product_id' LIMIT 1";
		$result = mysql_query($query, $conn_core_clients) or die(mysql_error());

		$quantityBuy = $each_item['quantity'];

		while ($row = mysql_fetch_array($result)) {
			$quantity = $row["quantity"] - $quantityBuy;
			$id= $row["ID"];
			$name = $row["name"];
			$price = $row["price"];
			$description = $row["description"];
			$nationality = $row["nationality"];
			$category = $row["category"];
			$weight = $row["weight"];
			$emailSupplier = $row["emailSupplier"];
		}


		$query2 = "UPDATE core_db.products SET quantity = quantity - '$quantityBuy' WHERE ID='$product_id'";
		$result = mysql_query($query2, $conn_core_clients) or die(mysql_error());
		

		if( $quantity < 5){
		 
		 	//Adds 20 in the quantity in the table products
			$query = "UPDATE `products` SET quantity = ('$quantity'+20) WHERE id = '$id' " ;

			$result = mysql_query($query, $conn_core_clients) or die(mysql_error());

			//if has less than 5, adds the product in the table supplier
			$query = "INSERT INTO core_db.supplier (`ID`,`IDproduct`, `name`, `description`, `weight`, `quantity`, `specialoffer`, `nationality`, `category`, `price`, `emailSupplier`) VALUES('','$id', '$name',  '$description', '$weight', '$quantity', '$specialoffer', '$nationality', '$category', '$price', '$emailSupplier')";
			
			$result = mysql_query($query, $conn_core_clients) or die(mysql_error());

		//Send an email to supplier
			//Pegar o email e descricao e do banco de dados e salvar em EmailSupplier
/*

			$Text = "We need 20 of the: '$name'- '$description'\n";
			
		
			if (smtpmailer($emailSupplier, 'portugamarket@gmail.com', 'Portuga Market', 'Supply', $Text)) {

				Header("location:http://www.dominio.com.br/obrigado.html"); // Mensagem de acerto?
			}
*/
			if (!empty($error)) echo $error;

			
		}
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
 <h> Your order was placed! </h>
    <br />
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" bgcolor="#C5DFFA"><strong>Product</strong></td>
        <td width="10%" bgcolor="#C5DFFA"><strong>Price</strong></td>
        <td width="10%" bgcolor="#C5DFFA"><strong>Quantity</strong></td>
        <td width="10%" bgcolor="#C5DFFA"><strong>Total</strong></td>
      </tr>
     <?php echo $output; ?>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
    </table>
    <?php echo $discount; ?>
    <?php echo $loyal_discount; ?>
  
    <?php echo $newTotal; ?> 
     <?php echo $extrapoints; ?>
    <br />
<br />
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