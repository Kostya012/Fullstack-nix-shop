<?php

include_once ROOT. '/App/Models/Products.php';

//for header
{
    $hiconIndex = '';
    $hiconProducts = ' active';
    $hiconCart = '';
    $hiconSignIn = '';
    $hiconSignUp = '';
    $article = 'Categories';
}

require_once 'resources/views/layouts/header.php';
require_once 'resources/views/layouts/aside.php';

class ProductsController
{
//    public $data;

//    public function __construct()
//    {
//        $this->data = Db::getData('product-list');
//    }

    public function actionProducts($category)
    {
//        $data = $this->data;
        $categoriesProducts = array();
        $categoriesProducts = Products::getCategoriesProducts();
        foreach ($categoriesProducts as $key => $value) {
            if ($value['name'] == $category) {
                $products = array();
                $products['article'] = $value['name'];
                $products += Products::getCountProducts($value['id']);
                $products['lists'] = Products::getProducts($value['id']);
                $data = $products;

//                echo '<pre>';
//                echo print_r($data);
//                echo '</pre>';

                require_once(ROOT . '/resources/views/products.php');
                return true;
            }
        }
        return false;
    }

    public function actionIndex()
    {
//        echo 'from action Index';
        $categoriesProducts = array();
        $categoriesProducts = Products::getCategoriesProducts();
//        echo '</br>actionIndex->getCategoriesProducts</br>';
//        echo '<pre>';
//        print_r($categoriesProducts);
//        echo '</pre>';
//        $data = $this->data;

        $data = $categoriesProducts;
        require_once(ROOT . '/resources/views/categories.php');
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

//        echo '</br>' . 'Category: ' . $category;
//        echo '</br>' . 'Id: ' . $id;

        $productById = array();
        $productById = Products::getProductById($id);

//        $data = $this->data;
        $data = $productById;
        require_once(ROOT . '/resources/views/product-details.php');
        return true;
    }
}
