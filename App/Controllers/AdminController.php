<?php

//declare(strict_types=1);

//namespace App\Controllers;

//include_once ROOT . '/App/Models/Category.php';
//include_once ROOT . '/App/Models/Home.php';
//include_once ROOT . '/App/Models/User.php';

use framework\Model\BaseModel;

//include_once ROOT . '/framework/Model/BaseModel.php';

//for header
$GLOBALS['hiconIndex'] = '';
$GLOBALS['hiconProducts'] = '';
$GLOBALS['hiconCart'] = '';
$GLOBALS['hiconSignIn'] = '';
$GLOBALS['hiconSignUp'] = '';
$GLOBALS['hiconUser'] = '';
$GLOBALS['article'] = 'Admin page';

class AdminController
{
//    public $data;

//    public function __construct()
//    {
//        $this->data = Db::getData('main');
//    }

    public function actionIndex()
    {
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $hiconUser;
        global $article;

        $db = BaseModel::instance();
        echo '<pre>';
        print_r($db);
        echo '</pre>';
        exit('I am admin panel');

        $categories = array();
        $categories = Category::getCategories();

        $data = array();
        $latestProducts = array();
        $latestProducts = Home::getLatestProducts();

//        echo '</br>actionIndex->getPromotionalOffers</br>';
//        echo '<pre>';
//        print_r($latestProducts);
//        echo '</pre>';

        $data['latestProducts'] = $latestProducts;

        $promotionalOffers = array();
        $promotionalOffers = Home::getPromotionalOffers();

        $data['promotionalOffers'] = $promotionalOffers;

        $recommendedProducts = array();
        $recommendedProducts = Home::getRecommendedProducts();

        $data['recommendedProducts'] = $recommendedProducts;

//        require_once(ROOT . '/resources/views/index.php');
        return true;
    }
}

//require_once 'resources/views/layouts/footer.php';
