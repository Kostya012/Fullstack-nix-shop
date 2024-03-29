<?php

function __autoload($class_name)
{
    $array_paths = array(
        '/framework/Components/',
        '/framework/Database/',
        '/App/model/',
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}