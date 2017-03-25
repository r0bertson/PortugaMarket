	<?php session_start()?>

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
      <h1>SPECIAL DEALS</h1>
      <p align="center">OUR CURRENT SPECIAL OFFERS</p>
   	
    <?php include("special_products.php"); ?>

	 
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>