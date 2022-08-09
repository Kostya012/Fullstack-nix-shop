<?php

declare(strict_types=1);

namespace App\Controllers;

class Db
{
    public static function getData($nameFile)
    {
        $paramsPath = ROOT . '/database/' . $nameFile . '.php';
        return include($paramsPath);
    }
}
