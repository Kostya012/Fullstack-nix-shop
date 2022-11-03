<?php

require_once 'vendor/autoload.php';

use App\components\CartController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));

//for header
{
  $hiconIndex = '';
  $hiconProducts = '';
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
