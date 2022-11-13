<?php

//declare(strict_types=1);
//
//namespace App\Controllers;

include_once ROOT . '/App/Models/Category.php';
include_once ROOT . '/App/Models/User.php';

//for header
{
    $GLOBALS['hiconIndex'] = '';
    $GLOBALS['hiconProducts'] = '';
    $GLOBALS['hiconCart'] = '';
    $GLOBALS['hiconSignIn'] = '';
    $GLOBALS['hiconSignUp'] = ' active';
    $GLOBALS['hiconUser'] = '';
    $GLOBALS['article'] = 'Sign up';
}

//require_once 'resources/views/layouts/header.php';
//require_once 'resources/views/layouts/aside.php';

class SignupController
{
//    public $data;

//    public function __construct()
//    {
//
//        $this->data = Db::getData('login-id');
//    }

    public function actionIndex()
    {
        //$total = $this->getSum();
//        $data = $this->data;
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $hiconUser;
        global $article;

        $categories = array();
        $categories = Category::getCategories();

        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Name must not be less than 2 characters';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Not correct email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Password must not be less than 6 characters';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'This email is already in use';
            }
            if ($errors == false) {
                $result = User::register($name, $email, $password);
            }

        }

        require_once(ROOT . '/resources/views/signup.php');
        return true;
    }
}
