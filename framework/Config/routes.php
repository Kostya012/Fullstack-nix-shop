<?php

defined('VG_ACCESS') or die('Access denied');

return array(
    'cart' => 'cart/cart', // actionIndex in CartController
    'products/([a-z]+)/page-([0-9]+)' => 'products/products/$1/$2', // actionProducts($1, $2) in ProductsController
    'products/([a-z]+)/([0-9]+)' => 'products/view/$1/$2', // actionView in ProductsController
    'products/([a-z]+)' => 'products/products/$1', // actionProducts($1) in ProductsController
    'products' => 'products/index', // actionIndex in ProductsController
    'categories' => 'products/index', // actionIndex in ProductsController
    'products-details' => 'products/details', // actionDetails in ProductsController
    'login' => 'login/index', // actionIndex in LoginController
    'signup' => 'signup/index', // actionIndex in SignupController
    'cabinet/([a-z]+)' => 'cabinet/$1', // action$1 in CabinetController
    'cabinet' => 'cabinet/index', // actionIndex in CabinetController
    'logout' => 'cabinet/logout', // actionLogout in CabinetController
    'admin' => 'admin/index', // actionIndex in AdminController
    'home' => 'home/index', // actionIndex in HomeController
);