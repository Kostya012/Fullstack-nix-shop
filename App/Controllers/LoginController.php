<?php

//declare(strict_types=1);
//
//namespace App\Controllers;

//for header
{
    $hiconIndex = '';
    $hiconProducts = '';
    $hiconCart = '';
    $hiconSignIn = ' active';
    $hiconSignUp = '';
    $article = 'Sign in';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

class LoginController
{
//    public $data;

//    public function __construct()
//    {
//
//        $this->data = Db::getData('login-id');
//    }

    public function actionIndex()
    {
        //$total = $this->getSum();
//        $data = $this->data;
        require_once(ROOT . '/resources/views/login.php');
        return true;
    }
}
