<?php

/**
 * A SESSION Wrapper class.
 *
 * @category Session
 * @version  1.0.0
 */

namespace App\models;

class Session
{
//    protected static $sessionLife = 1200;

    public static function start()
    {
        session_start();
        if (!isset($_SESSION['time'])) {
//            ini_set('session.gc_maxlifetime', self::$sessionLife);
            self::set('ua', $_SERVER['HTTP_USER_AGENT']);
            self::set('time', date('H:i:s'));
        }

        if ($_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT']) {
            die('Wrong browser');
        }
        return true;
    }

    public static function set($Key, $value)
    {
        $_SESSION[$Key] = $value;
    }

    public static function has($Key)
    {
//        return (bool)(isset($_SESSION[$Key])) ? $_SESSION[$Key] : false;
        return array_key_exists($Key, $_SESSION);
    }

    public static function get($Key)
    {
        return (isset($_SESSION[$Key])) ? $_SESSION[$Key] : false;
    }

    public static function del($Key)
    {
        if (isset($_SESSION[$Key])) {
            unset($_SESSION[$Key]);
        }
        return true;
    }

    public static function destroy()
    {
        if (isset($_SESSION)) {
            session_destroy();
        }
        return true;
    }
}
