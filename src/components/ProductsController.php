<?php

declare(strict_types=1);

namespace App\components;

class ProductsController
{
    public $data;

    public function __construct()
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
