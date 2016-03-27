<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UWL LOYALTY SCHEME LOGIN FORM</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include('header.php'); ?>
<div id="main">
    <div id="left">
      <h1>Login Form</h1>
      <fieldset>
        <legend>Login below to access your personal area        </legend>
        <form id="form1" name="form1" method="post" action="">
          <p><span id="sprytextfield1">
          <label for="email">Email</label>
          <input name="email" type="text" id="email" size="40" maxlength="40" />
          <span class="textfieldRequiredMsg">An email address is required.</span><span class="textfieldInvalidFormatMsg">Please enter a valid email address.</span></span></p>
          <p>
            <label for="pwd"></label>
            <span id="sprytextfield2">
            <label for="pwd2">Password</label>
            <input name="pwd" type="text" id="pwd2" size="10" maxlength="15" />
          <span class="textfieldRequiredMsg">A password is required (up to 15 characters)</span></span></p>
          <p><input type="submit" name="submit" id="submit" value="Login" />
          </p>
</form>
      </fieldset>
      <p></p>
      <p></p>
    </div>
</div>
<?php include('footer.php'); ?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>