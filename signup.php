<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));
require_once 'vendor/autoload.php';

//for header
{
  $hiconIndex = '';
  $hiconCart = '';
  $hiconSignIn = '';
  $hiconSignUp = ' active';
  $article = 'Sign Up';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

require_once 'resources/views/signup.php';
require_once 'resources/views/layouts/footer.php';
?>
