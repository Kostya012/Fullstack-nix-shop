<?php
return array(
    'products/([a-z]+)/([0-9]+)' => 'products/$1/$2', // action$1 in ProductsController
    'products/([a-z]+)' => 'products/$1', // action$1 in ProductsController
    'products' => 'products/index', // actionIndex in ProductsController
    'products-details' => 'products/details', // actionDetails in ProductsController
    'login' => 'login/index', // actionIndex in LoginController
    'signup' => 'signup/index', // actionIndex in SignupController
);