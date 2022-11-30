<?php
defined('VG_ACCESS') or die('Access denied');

const COOKIE_VERSION = '1.0.0';
const COOKIE_TIME = 70;
const BLOCK_TIME = 3;

use framework\Config\exceptions\RouteException;

/**
 * @throws \framework\Config\exceptions\RouteException
 */
function autoloadMainClasses($classes_name)
{
    $classes_name = str_replace('\\', '/', $classes_name);

    if (!@include_once $classes_name . '.php') {
        echo 'Class: ' . $classes_name . '</br>';
//        throw new \framework\Config\exceptions\RouteException('Not correct name file for connect - ' . $classes_name);
        throw new RouteException('Not correct name file for connect - ' . $classes_name);
    }
}

spl_autoload_register('autoloadMainClasses');
