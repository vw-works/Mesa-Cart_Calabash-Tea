<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
    
<?php
    require 'ipn.php';
?>
    
</head>
<body>
<!-- Add to cart -->
<form action = "https://www.sandbox.paypal.com/cgi-bin/webscr" method = "post" target = "paypal">
<input type = "hidden" name = "add" value = "1" /> 
<input type = "hidden" name = "cmd" value = "_cart" /> 
<input type = "hidden" name = "business" value = "vwong029-facilitator@gmail.com" /> 
<input type = "hidden" name = "item_name" value = "Mr Microphone" />
<input type = "hidden" name = "amount" value = "13.99" /> 
<input type = "hidden" name = "no_shipping" value = "2" /> 
<input type = "hidden" name = "mc_currency" value = "USD" /> 
<input type = "hidden" name = "bn" value = "PP-ShopCartBF" /> 
<input type = "image" name = "submit" src = "http://mm214.com/buttons/addtocart.gif" />
</form> 

<!-- View Cart -->
<form action = "https://www.sandbox.paypal.com/us/cgi-bin/webscr" method = "post" target = "paypal">
<input type = "hidden" name = "cmd" value = "_cart" /> 
<input type = "hidden" name = "business" value = "vwong029-facilitator@gmail.com" /> 
<input type = "hidden" name = "display" value = "1" /> 
<input type = "image" name = "submit" src = "http://mm214.com/buttons/viewcart.gif" />
</form>



<!-- Buy Now -->
<form action = "https://www.sandbox.paypal.com/us/cgi-bin/webscr" method = "post" target = "paypal">
<input type = "hidden" name = "cmd" value = "_ext-enter" />
<input type = "hidden" name = "redirect_cmd" value = "_xclick" /> 
 <input type = "hidden" name = "cancel_return" value = "http://mm214.com/somethingcheaper.html" /> 
  <input type = "hidden" name = "return" value = "http://mm214.com/maincart.html" /> 
<input type = "hidden" name = "business" value = "vwong029-facilitator@gmail.com" /> 
<input type = "hidden" name = "item_name" value = "Mr Microphone" />
<input type = "hidden" name = "amount" value = "13.99" />
<input type = "hidden" name = "item_number" value = "3" />
<input type = "hidden" name = "notify_url" value = "http://mm214.com/somethingcheaper.php" />
<input type = "image" name = "submit" src = "http://mm214.com/buttons/buynow.gif" />
</form>

</body>
</html>
