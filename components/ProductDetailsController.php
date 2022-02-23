<?php

class ProductDetailsController
{
    public $data;

    function __construct()
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
