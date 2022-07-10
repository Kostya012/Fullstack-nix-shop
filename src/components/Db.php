<?php

namespace App\components;

class Db
{
    public static function getData($nameFile)
    {
        $paramsPath = ROOT . '/database/' . $nameFile . '.php';
        return include($paramsPath);
    }
}
