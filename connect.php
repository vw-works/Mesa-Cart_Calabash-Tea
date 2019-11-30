<?
session_start();
$sessid = session_id();
$hostname = 'localhost';
$username = 'projectpixel';
$password = 'macch1';
$dbh = new PDO("mysql:host=$hostname;dbname=my_projectpixel", $username, $password);
$prefix = 'mesacart_';
$buyers = 'mesacart_buyers';
$cartitems = 'mesacart_cartitems';
$category = 'mesacart_category';
$ecadmin = 'mesacart_ecadmin';
$inv = 'mesacart_inv';
$orders = 'mesacart_orders';
$products = 'mesacart_products';
$spec = 'mesacart_spec';
$zipcodes = 'mesacart_zipcodes';
$attributes= 'mesacart_attributes';
$maincategory = 'mesacart_maincategory';
$coupons = 'mesacart_coupons';
$rating = 'mesacart_ratings';
$root = 'http://projectpixel.altervista.org/webd173_ecomm/mesacart/';

?>