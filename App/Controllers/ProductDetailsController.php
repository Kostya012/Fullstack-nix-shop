<?php

declare(strict_types=1);

namespace App\Controllers;

class ProductDetailsController
{
    public $data;

    public function __construct()
    {
        $this->data = Db::getData('product-details');
    }

    public function actionProductDetails()
    {
        $data = $this->data;
        require_once(ROOT . '/resources/views/product-details.php');
        return true;
    }
}
