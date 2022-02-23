<?php

class Db
{

    public static function getData($nameFile)
    {
        $paramsPath = ROOT . '/database/' . $nameFile . '.php';
        $data = include($paramsPath);
        return $data;
    }

}
