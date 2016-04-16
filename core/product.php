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
	<?php $idPassed = $_GET["id"];
	include("get_product.php"); ?>
      <h1><?php echo $name ?></h1>
  
   	
   
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="19%" valign="top"> <a href="product_images/<?php echo $id; ?>.jpg"><img src="product_images/<?php echo $id; ?>.jpg" width="200" height="300" alt="<?php echo $name; ?>" /><br />
     </a></td>
    <td width="81%" valign="top"><h3><?php echo $name; ?></h3>
      <p>Unit price: <?php echo "&pound ".$price; ?><br />
        <br />
        <p> Nationality: <br /><?php echo "$nationality"; ?> <br />
         <p> Category:<br /> <?php echo "$category"; ?> <br />
         <p> Weight:<br /> <?php echo "$weight"; ?> <br />
         <p> Special Offer:<br /> <?php echo "$specialoffer"; ?> <br />
    	<p> Description: <br /> <?php echo "$description"; ?> <br /><br /><br />
     
        </p>
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="product_id" id="product_id" value="<?php echo $idPassed; ?>" />
        <input type="submit" name="button" id="button" value="Add to Shopping Cart" />
      </form>
      </td>
    </tr>
</table>
	 
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>