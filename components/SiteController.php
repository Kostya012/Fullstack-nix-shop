<?php

class SiteController
{
    public $data;

    function __construct()
    {
        $this->data = Db::getData('main');
    }

    public function actionIndex()
    {
        $data = $this->data;
        require_once(ROOT . '/resources/views/index.php');
        return true;
    }

}
