<?php

include_once ROOT. '/App/Models/Products.php';

//for header
{
    $hiconIndex = '';
    $hiconCart = '';
    $hiconSignIn = '';
    $hiconSignUp = '';
    $article = 'Products';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

class ProductsController
{
    public $data;

//    public function __construct()
//    {
//        $this->data = Db::getData('product-list');
//    }

    public function actionProducts()
    {
        $data = $this->data;
        require_once(ROOT . '/resources/views/products.php');
        return true;
    }

    public function actionIndex()
    {
        echo 'from action Index';
//        $data = $this->data;
//        require_once(ROOT . '/resources/views/products.php');
        return true;
    }
    public function actionView($category, $id)
    {
//        echo '</br>';
//        echo 'From action View in products-details';
//        echo '</br>';
//        echo ' Вхідні params in action View:';
//        echo '<pre>';
//        print_r($params);
//        echo '</pre>';
//
//        echo '</br>' . 'Перший параметр: ' . $params[0];
//        echo '</br>' . 'Другий параметр: ' . $params[1];

        echo '</br>' . 'Category: ' . $category;
        echo '</br>' . 'Id: ' . $id;

//        $data = $this->data;
//        require_once(ROOT . '/resources/views/product-details.php');
        return true;
    }
}
