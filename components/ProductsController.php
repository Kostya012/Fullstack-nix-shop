<?php

class ProductsController
{
    public $data;

    function __construct()
    {
        $this->data = Db::getData('product-list');
    }

    public function actionProducts()
    {
        $data = $this->data;
        require_once(ROOT . '/resources/views/products.php');
        return true;
    }

}
