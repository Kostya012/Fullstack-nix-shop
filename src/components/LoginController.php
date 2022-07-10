<?php

namespace App\components;

class LoginController
{
    public $data;

    public function __construct()
    {

        $this->data = Db::getData('login-id');
    }

    public function actionLogin()
    {
        //$total = $this->getSum();
        $data = $this->data;
        require_once(ROOT . '/resources/views/login.php');
        return true;
    }
}
