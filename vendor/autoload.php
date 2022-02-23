<?php
// Only (PHP 5 >= 5.1.0, PHP 7, PHP 8)
function my_autoloader($class_name)
{
    # List all the class directories in the array.
    $array_paths = array(
        // '/models/',
        '/components/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}

spl_autoload_register('my_autoloader');