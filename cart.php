<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));
require_once 'vendor/autoload.php';

//for header
{
  $hiconIndex = '';
  $hiconCart = ' active';
  $hiconSignIn = '';
  $hiconSignUp = '';
  $article = 'Shopping cart';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

$cart = new CartController;
$cart->actionCart();
require_once 'resources/views/layouts/footer.php';
?>
