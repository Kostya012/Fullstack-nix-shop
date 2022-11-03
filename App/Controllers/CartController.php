<?php

/**
 * Controllers for Cart
 */

//declare(strict_types=1);
//
//namespace App\Controllers;

//include_once ROOT. '/App/Models/Home.php';

include_once ROOT. '/App/Controllers/Dbold.php';
//
//for header
{
    $hiconIndex = '';
    $hiconProducts = '';
    $hiconCart = ' active';
    $hiconSignIn = '';
    $hiconSignUp = '';
    $article = 'Shopping cart';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

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
        $total = $this->getSum();
        $data = $this->data;
        require_once(ROOT . '/resources/views/cart.php');
        return true;
    }
}
