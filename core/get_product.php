<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "Connections/conn_core_clients.php"; 
	$idPassed = $_GET['id']; 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$query = "SELECT * FROM products WHERE ID='$idPassed' LIMIT 1";
	$result = mysql_query($query, $conn_core_clients) or die(mysql_error());
	$productCount = mysql_num_rows($result); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($result)){ 
			 $id= $row["ID"];
			 $name = $row["name"];
			 $price = $row["price"];
			 $description = $row["description"];
			 $nationality = $row["nationality"];
			 $category = $row["category"];
			 $weight = $row["weight"];
			 $specialoffer = $row["specialoffer"];
			 
			 //search for category name
			 $query = "SELECT name FROM category WHERE ID='$category' LIMIT 1";
			 $result = mysql_query($query, $conn_core_clients) or die(mysql_error());
			 $row1 = mysql_fetch_array($result);
			 $category = $row1["name"];
			 //search for special offer
			 $query = "SELECT name FROM specialoffers WHERE ID='$specialoffer' LIMIT 1";
			 $result = mysql_query($query, $conn_core_clients) or die(mysql_error());
			 $row2 = mysql_fetch_array($result);
			 $specialoffer = $row2["name"];
			 
			 	 //search for special offer
			 $query = "SELECT country FROM nationality WHERE ID='$nationality' LIMIT 1";
			 $result = mysql_query($query, $conn_core_clients) or die(mysql_error());
			 $row3 = mysql_fetch_array($result);
			 $nationality = $row3["country"];
			 
         }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}
mysql_close();
?>
