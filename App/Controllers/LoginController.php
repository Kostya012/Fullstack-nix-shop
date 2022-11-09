<?php

//declare(strict_types=1);
//
//namespace App\Controllers;

include_once ROOT . '/App/Models/Category.php';

//for header
{
    $GLOBALS['hiconIndex'] = '';
    $GLOBALS['hiconProducts'] = '';
    $GLOBALS['hiconCart'] = '';
    $GLOBALS['hiconSignIn'] = ' active';
    $GLOBALS['hiconSignUp'] = '';
    $GLOBALS['article'] = 'Sign in';
}

//require_once 'resources/views/layouts/header.php';
//require_once 'resources/views/layouts/aside.php';

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
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $article;

        $categories = array();
        $categories = Category::getCategories();

        //$total = $this->getSum();
//        $data = $this->data;
        require_once(ROOT . '/resources/views/login.php');
        return true;
    }
}
