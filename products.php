<?php

require_once 'vendor/autoload.php';

use App\components\ProductsController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));

//for header
{
  $hiconIndex = '';
  $hiconCart = '';
  $hiconSignIn = '';
  $hiconSignUp = '';
  $article = 'Categories';
}
require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

$products = new ProductsController;
$products->actionProducts();
require_once 'resources/views/layouts/footer.php';
?>