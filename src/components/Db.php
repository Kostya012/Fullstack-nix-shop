<?php

declare(strict_types=1);

namespace App\components;

class Db
{
    public static function getData($nameFile)
    {
        $paramsPath = ROOT . '/database/' . $nameFile . '.php';
        return include($paramsPath);
    }
}
