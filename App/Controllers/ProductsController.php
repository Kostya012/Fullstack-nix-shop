<?php

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
}
