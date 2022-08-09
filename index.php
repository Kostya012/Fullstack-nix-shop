<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));
require_once 'vendor/autoload.php';

//for header
{
  $hiconIndex = ' active';
  $hiconCart = '';
  $hiconSignIn = '';
  $hiconSignUp = '';
  $article = 'Home page';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

$index = new SiteController;
$index->actionIndex();

require_once 'resources/views/layouts/footer.php';
?>