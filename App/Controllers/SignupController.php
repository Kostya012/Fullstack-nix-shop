<?php

//declare(strict_types=1);
//
//namespace App\Controllers;

//for header
{
    $hiconIndex = '';
    $hiconProducts = '';
    $hiconCart = '';
    $hiconSignIn = '';
    $hiconSignUp = ' active';
    $article = 'Sign up';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

class SignupController
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
        require_once(ROOT . '/resources/views/signup.php');
        return true;
    }
}
