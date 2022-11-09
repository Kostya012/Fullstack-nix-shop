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
    $GLOBALS['hiconSignIn'] = '';
    $GLOBALS['hiconSignUp'] = ' active';
    $GLOBALS['article'] = 'Sign up';
}

//require_once 'resources/views/layouts/header.php';
//require_once 'resources/views/layouts/aside.php';

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
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $article;

        $categories = array();
        $categories = Category::getCategories();

        require_once(ROOT . '/resources/views/signup.php');
        return true;
    }
}
