
<?php 
// Run a select query to get my letest 6 items
// Connect to the MySQL database  
include "Connections/conn_core_clients.php"; 
mysql_select_db($database_conn_core_clients, $conn_core_clients);
$dynamicList = "";
$query = "SELECT * FROM products ORDER BY specialoffer DESC LIMIT 6";
$result = mysql_query($query, $conn_core_clients) or die(mysql_error());
$productCount = mysql_num_rows($result); // count the output amount
if ($productCount > 0) {
	$dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding="6"><tr>';
	while($row = mysql_fetch_array($result)){ 
             $id = $row["ID"];
			 $name = $row["name"];
			 $price = $row["price"];
			 $dynamicList .= '
        <td>		
          <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="product_images/' . $id . '.jpg" alt="' . $name . '" width="77" height="102" border="1" /></a></td>
          <td width="83%" valign="top">' . $name . '<br />
            $' . $price . '<br />
            <a href="product.php?id=' . $id . '">View Product Details</a></td>
        </td>
      ';
	  
}
 $dynamicList .= '</tr></table>';
    
} else {
	$dynamicList = "We have no products listed in our store yet";
}
mysql_close();
?>

