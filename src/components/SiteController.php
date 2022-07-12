<?php

declare(strict_types=1);

namespace App\components;

class SiteController
{
    public $data;

    public function __construct()
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
