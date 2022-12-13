<?php

// Front Controllers
//phpinfo();
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
//require_once(ROOT.'/vendor/autoload.php');
//require_once(ROOT.'/framework/Components/Autoload.php');
require_once(ROOT . '/framework/Config/internal_settings.php');

use framework\Components\Router;
use framework\Config\exceptions\DbException;
use framework\Config\exceptions\RouteException;

//use kostya012\Logger;

require_once(ROOT . '/framework/Database/Db.php');

try {
    // 3. Establishing a database connection

    // 4. Call Router

    $router = new Router();
    $router->run();

    //$today = date("d_m_Y");

    //$log = new Logger($today, 'log');

    require_once 'resources/views/layouts/footer.php';
} catch (RouteException | DbException $e) {
    exit($e->getMessage());
}
