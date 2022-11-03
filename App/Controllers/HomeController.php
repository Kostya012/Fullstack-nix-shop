<?php

//declare(strict_types=1);
//namespace App\Controllers;

include_once ROOT. '/App/Models/Home.php';

//for header
{
    $hiconIndex = ' active';
    $hiconProducts = '';
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
        $data = array();
        $latestProducts = array();
        $latestProducts = Home::getLatestProducts();

//        echo '</br>actionIndex->getPromotionalOffers</br>';
//        echo '<pre>';
//        print_r($latestProducts);
//        echo '</pre>';

        $data['latestProducts'] = $latestProducts;

//        echo '</br>actionIndex->getPromotionalOffers</br>';
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';

        $promotionalOffers = array();
        $promotionalOffers = Home::getPromotionalOffers();

        $data['promotionalOffers'] = $promotionalOffers;

//        echo '</br>actionIndex->getPromotionalOffers</br>';
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';

        $recommendedProducts = array();
        $recommendedProducts = Home::getRecommendedProducts();

        $data['recommendedProducts'] = $recommendedProducts;

//        echo '</br>actionIndex->getRecommendedProducts</br>';
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        $data = $recommendedProducts;

        require_once(ROOT . '/resources/views/index.php');
        return true;
    }
}

//require_once 'resources/views/layouts/footer.php';