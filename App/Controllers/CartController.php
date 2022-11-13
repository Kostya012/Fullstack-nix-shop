<?php

/**
 * Controllers for Cart
 */

//declare(strict_types=1);
//
//namespace App\Controllers;

//include_once ROOT. '/App/Models/Home.php';

include_once ROOT . '/App/Models/Category.php';
include_once ROOT . '/App/Models/User.php';

include_once ROOT. '/App/Controllers/Dbold.php';
//
//for header
{
    $GLOBALS['hiconIndex'] = '';
    $GLOBALS['hiconProducts'] = '';
    $GLOBALS['hiconCart'] = ' active';
    $GLOBALS['hiconSignIn'] = '';
    $GLOBALS['hiconSignUp'] = '';
    $GLOBALS['hiconUser'] = '';
    $GLOBALS['article'] = 'Shopping cart';
}

//require_once 'resources/views/layouts/header.php';
//require_once 'resources/views/layouts/aside.php';

class CartController
{
    public $data;

    public function __construct()
    {
        $this->data = Dbold::getData('shopping-cart');
    }

    protected function getSum()
    {
        $sum = 0;
        foreach ($this->data as $arr) {
            $sum += $arr['price'];
        }
        return $sum;
    }

    public function actionCart()
    {
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $hiconUser;
        global $article;

        $categories = array();
        $categories = Category::getCategories();

        $total = $this->getSum();
        $data = $this->data;
        require_once(ROOT . '/resources/views/cart.php');
        return true;
    }
}
