<?php session_start()?>
<?php 
// Run a select query to get my letest 6 items
// Connect to the MySQL database  
include "Connections/conn_core_clients.php"; 
$category_name = '';
$products_ = "";
if (isset($_GET["page_category"]) && $_GET["page_category"] != "") {
	$pageCategory = $_GET["page_category"];
	
	if($pageCategory == "freshfood"){
		$category_name = "Fresh Food";
		$query = "SELECT * FROM products WHERE category = '1' ORDER BY specialoffer DESC";
	}
	else if($pageCategory == 'drinks'){
			$category_name = "Drinks";
		$query = "SELECT * FROM products WHERE category = '2' ORDER BY specialoffer DESC";
	}
	else if($pageCategory == 'clothing'){
			$category_name = "Clothing";
		$query = "SELECT * FROM products WHERE category = '3' ORDER BY specialoffer DESC";
	}
	else{
	$query = "SELECT * FROM products ORDER BY specialoffer DESC";
	}
	mysql_select_db($database_conn_core_clients, $conn_core_clients);
	
	$result = mysql_query($query, $conn_core_clients) or die(mysql_error());
	$productCount = mysql_num_rows($result); // count the output amount
	$row = mysql_fetch_array($result);
	$currency = "&pound";
	if ($productCount > 0) {
		do {
    		$id = $row["ID"];
			$name = $row["name"];
			$price = $row["price"];    
			$products_ .= '<div id="box" align="center">
            <a href="product.php?id=' . $id . '">
            	<img style="border:#666 1px solid;" src="product_images/' . $id . '.jpg" alt="' . $name . '" width="150" height="220" border="0"/>
         		   ' . $name . '<br />
            	  ' . $currency . '  ' . $price . ' <br />
            	<a href="product.php?id=' . $id . '">View Product Details</a>
			</a>
 
			</div>'; } while($row = mysql_fetch_array($result));
	} else {
	  echo "We have no products listed in this category" ;
	}
}else{
	echo "We have no products listed in this category" ;
}
mysql_close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Products - PORTUGA MARKET</title>
<link href="stylenew.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
  <?php include('header.php'); ?>
  <div id="main">
    <div id="left">
      <h1><?php echo $category_name;?></h1>
      <p>HERE WILL BE SHOWN PRODUCTS WITH DISCOUNTS</p>
      <?php echo $products_ ;?> </div>
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>