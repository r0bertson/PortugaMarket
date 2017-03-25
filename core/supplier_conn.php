<?php 

require_once("phpmailer/class.phpmailer.php");
require_once("phpmailer/email.php");

// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "Connections/conn_core_clients.php";
    //include "phpmailer/email.php";

	$idPassed = $_GET['id']; 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$query = "SELECT * FROM products WHERE ID='$idPassed' LIMIT 1";
	$result = mysql_query($query, $conn_core_clients) or die(mysql_error());
	$productCount = mysql_num_rows($result); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($result)){ 
			if( $row["quantity"] < 5){
			 $id= $row["ID"];
			 $name = $row["name"];
			 $price = $row["price"];
			 $description = $row["description"];
			 $nationality = $row["nationality"];
			 $category = $row["category"];
			 $weight = $row["weight"];
			 $emailSupplier = $row["emailSupplier"];
				//if has less than 5, adds the product in the table supplier
				$query2 = "INSERT INTO `supplier` VALUES('$id', '$name', '$price', '$description', '$nationality', '$category', '$weight', '$emailSupplier' )";
				
				$result2 = mysql_query($query, $conn_core_clients) or die(mysql_error());

			//Send an email to supplier
				//Pegar o email e descricao e do banco de dados e salvar em EmailSupplier

				$Text 		= "We need 20 of the: `$name`- `$description`  \n";
				
				 if (smtpmailer($emailSupplier, GUSER, 'Portuga Market', 'Supply', $Text)) {

					Header("location:http://www.dominio.com.br/obrigado.html"); // Mensagem de acerto?
				}
				if (!empty($error)) echo $error;


				//Adds 20 in the quantity in the table products
				$query2 = "UPDATE `products` SET quantity = (`$quantity`+20) WHERE id = `$id` " ;

				$result = mysql_query($query, $conn_core_clients) or die(mysql_error());

			}
			
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