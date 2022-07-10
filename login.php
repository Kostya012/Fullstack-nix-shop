<?php

require_once 'vendor/autoload.php';

use App\models\Session;
use App\components\LoginController;

Session::start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));

//for header
{
  $hiconIndex = '';
  $hiconCart = '';
  $hiconSignIn = ' active';
  $hiconSignUp = '';
  $article = 'Sign in';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

$login = new LoginController();
$login->actionLogin();

//require_once 'resources/views/login.php';
require_once 'resources/views/layouts/footer.php';
?>
