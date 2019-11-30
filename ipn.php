<?php
error_reporting(E_ALL);
$currency = $_POST['mc_currency'];
//I need to see all the variables and values you know, info from paypal!!!!
foreach ($_POST as $key=>$value){
  $content .= $key.' '.$value;
}

$fh = fopen('receipts.txt',w);
fwrite($fh,$content);
fclose($fh);

mail('vwisatwork@gmail.com','paypal vars',$content,"Content-type: text/html");
echo "hi";
?>