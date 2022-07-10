<?php

require_once 'vendor/autoload.php';

use App\components\SiteController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));

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

$index = new SiteController();
$index->actionIndex();

require_once 'resources/views/layouts/footer.php';
?>