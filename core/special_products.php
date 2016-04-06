<?php 
// Run a select query to get my letest 6 items
// Connect to the MySQL database  
include "Connections/conn_core_clients.php"; 
mysql_select_db($database_conn_core_clients, $conn_core_clients);
$dynamicList = "";
$query = "SELECT * FROM products ORDER BY specialoffer DESC LIMIT 6";
$result = mysql_query($query, $conn_core_clients) or die(mysql_error());
$productCount = mysql_num_rows($result); // count the output amount
$row = mysql_fetch_array($result);
if ($productCount > 0) {
	
             
	do {
    $id = $row["ID"];
	$name = $row["name"];
	$price = $row["price"];
	?> 
			<div id="box" align="center">
            <a href="product.php?id=<?php echo $id?>">
            	<img style="border:#666 1px solid;" src="<?php echo"product_images/$id"?>.jpg" alt="<?php echo $name?>" width="150" height="220" border="0"/>
         		<?php echo  $name?><br />
            	<?php echo  "£ $price "?><br />
            	<a href="product.php?id=<?php echo $id?>">View Product Details</a>
			</a>
 
			</div>
<?php } while($row = mysql_fetch_array($result));


    
} else {
	  echo "We have no products listed in our store yet" ;
}
mysql_close();
?>
