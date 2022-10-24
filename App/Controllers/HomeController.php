<?php

//declare(strict_types=1);
//namespace App\Controllers;

include_once ROOT. '/App/Models/Home.php';

//for header
{
    $hiconIndex = ' active';
    $hiconCart = '';
    $hiconSignIn = '';
    $hiconSignUp = '';
    $article = 'Home page';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

class HomeController
{
//    public $data;

//    public function __construct()
//    {
//        $this->data = Db::getData('main');
//    }

    public function actionIndex()
    {
//        $data = $this->data;
        $latestProducts = array();
        $latestProducts = Home::getLatestProducts();

        echo '</br>actionIndex->getPromotionalOffers</br>';
        echo '<pre>';
        print_r($latestProducts);
        echo '</pre>';

        $promotionalOffers = array();
        $promotionalOffers = Home::getPromotionalOffers();

        echo '</br>actionIndex->getPromotionalOffers</br>';
        echo '<pre>';
        print_r($promotionalOffers);
        echo '</pre>';

        $recommendedProducts = array();
        $recommendedProducts = Home::getRecommendedProducts();

        echo '</br>actionIndex->getRecommendedProducts</br>';
        echo '<pre>';
        print_r($recommendedProducts);
        echo '</pre>';
        $data = $recommendedProducts;

        require_once(ROOT . '/resources/views/index.php');
        return true;
    }
}

//require_once 'resources/views/layouts/footer.php';