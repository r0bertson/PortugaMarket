<?php 

//require_once("phpmailer/class.phpmailer.php");

//define('GUSER', 'portugamarket@gmail.com');	// <-- Insira aqui o seu GMail
//define('GPWD', 'portuga123');		// <-- Insira aqui a senha do seu GMail

// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "Connections/conn_core_clients.php";
    //include "email.php";

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
					//'$row['name']' , '$row['description']' , '$row['weight']' , '$row['quantity']' , '$row['specialoffer']' , '$row['nationality']' , '$row['category']',  '$row['emailSuplier']' ");
				
				$result2 = mysql_query($query, $conn_core_clients) or die(mysql_error());

			//Send an email to supplier
				//Pegar o email e descricao e do banco de dados e salvar em EmailSupplier

				$Text 		= "We need 20 of the: `$name`- `$description`  \n";

	/*			function smtpmailer($to, $from, $from_name, $subject, $body) { 
					global $error;
					$mail = new PHPMailer();
					$mail->IsSMTP();		// Ativar SMTP
					$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
					$mail->SMTPAuth = true;		// Autenticação ativada
					$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
					$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
					$mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
					$mail->Username = GUSER;
					$mail->Password = GPWD;
					$mail->SetFrom($from, $from_name);
					$mail->Subject = $subject;
					$mail->Body = $body;
					$mail->AddAddress($to);
					if(!$mail->Send()) {
						$error = 'Mail error: '.$mail->ErrorInfo; 
						return false;
					} else {
						$error = 'Message send!';
						return true;
					}
				}*/

				// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
				//o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

				 if (smtpmailer($row[`emailSuplier`], GUSER, 'Portuga Market', 'Supply', $Text)) {

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