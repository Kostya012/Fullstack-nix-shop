<?php
// Front Controllers

// 1. Main settings
// set security key
define('VG_ACCESS', true);

header('Content-Type:text/html;charset=utf-8');
session_start();
// show errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Connection files of systems
define('ROOT', dirname(__FILE__));
//echo ROOT;
require_once (ROOT.'/vendor/autoload.php');
//require_once (ROOT.'/framework/Components/Autoload.php');

use Framework\Components\Router;
//use kostya012\Logger;

require_once (ROOT.'/framework/Database/Db.php');



// 3. Establishing a database connection

// 4. Call Router

$router = new Router();
$router->run();

//$today = date("d_m_Y");
//
//$log = new Logger($today, 'log');





//for header
//{
//  $hiconIndex = ' active';
//  $hiconCart = '';
//  $hiconSignIn = '';
//  $hiconSignUp = '';
//  $article = 'Home page';
//}

//require_once 'resources/views/layouts/header.php';
//require_once 'resources/views/layouts/aside.php';

//$index = new SiteController();
//$index->actionIndex();

require_once 'resources/views/layouts/footer.php';
?>