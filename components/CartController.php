<?php

class CartController
{
    public $data;

    function __construct()
    {
        $this->data = Db::getData('shopping-cart');
    }

    protected function getSum() {
        $sum = 0;
        foreach ($this->data as $arr) {
            $sum += $arr['price'];
        }
        return $sum;
    }

    public function actionCart()
    {
        $total = $this->getSum();
        $data = $this->data;
        require_once(ROOT . '/resources/views/cart.php');
        return true;
    }

}
