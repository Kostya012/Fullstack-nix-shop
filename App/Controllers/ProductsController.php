<?php

use Framework\Components\Pagination;

include_once ROOT . '/App/Models/Category.php';
include_once ROOT . '/App/Models/Products.php';
include_once ROOT . '/framework/Components/Pagination.php';
include_once ROOT . '/App/Models/User.php';

//for header
{
    $GLOBALS['hiconIndex'] = '';
    $GLOBALS['hiconProducts'] = ' active';
    $GLOBALS['hiconCart'] = '';
    $GLOBALS['hiconSignIn'] = '';
    $GLOBALS['hiconSignUp'] = '';
    $GLOBALS['hiconUser'] = '';
    $GLOBALS['article'] = 'Categories';
}

//require_once 'resources/views/layouts/header.php';
//require_once 'resources/views/layouts/aside.php';

class ProductsController
{
//    public $data;

//    public function __construct()
//    {
//        $this->data = Db::getData('product-list');
//    }

    public function actionProducts($category, $current_page = 1)
    {
//        echo '</br>actionProducts</br>';
//        echo '</br>Category = ' . $category;
//        echo '</br>Page = ' . $current_page;

//        $data = $this->data;
//        $data = $this->data;
        //for header
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $hiconUser;

        $categories = array();
        $categories = Category::getCategories();

        foreach ($categories as $key => $value) {
            if ($value['name'] == $category) {
                //for header
                $article = ucfirst($value['name']);

                $products = array();
                $products['article'] = $value['name'];
                $products['count'] = Products::getCountProducts($value['id']);
                $total = $products['count'];

//                echo '</br> alle seite = ' . $total;

                $pagination = new Pagination($total, $current_page, Products::SHOW_BY_DEFAULT, '/page-');

                $products['lists'] = Products::getProductsByCategory($value['id'], $current_page);
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
        //for header
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $article;

        $categories = array();
        $categories = Category::getCategories();

//        $categoriesProducts = array();
//        $categoriesProducts = Products::getCategoriesProducts();
//        echo '</br>actionIndex->getCategoriesProducts</br>';
//        echo '<pre>';
//        print_r($categoriesProducts);
//        echo '</pre>';
//        $data = $this->data;

        $data = $categories;
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

        //for header
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;

        $categories = array();
        $categories = Category::getCategories();

        $productById = array();
        $productById = Products::getProductById($id);

//        $data = $this->data;
        $article = ucfirst($productById['category']);
        $data = $productById;
        require_once(ROOT . '/resources/views/product-details.php');
        return true;
    }
}
