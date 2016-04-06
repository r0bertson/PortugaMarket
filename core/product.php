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
      <h1>PRODUCT</h1>
      <p>HERE WILL BE THE PAGE OF THE PRODUCT</p>
   	
    <?php $idPassed = $_GET["id"];
	include("get_product.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="19%" valign="top"><img src="product_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $name; ?>" /><br />
      <a href="product_images/<?php echo $id; ?>.jpg">View Full Size Image</a></td>
    <td width="81%" valign="top"><h3><?php echo $name; ?></h3>
      <p><?php echo "$".$price; ?><br />
        <br />
        <?php echo "$nationality $category"; ?> <br />
<br />
        <?php echo $description; ?>
<br />
        </p>
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
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