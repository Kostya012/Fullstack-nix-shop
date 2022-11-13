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
    $GLOBALS['hiconSignIn'] = ' active';
    $GLOBALS['hiconSignUp'] = '';
    $GLOBALS['hiconUser'] = '';
    $GLOBALS['article'] = 'Sign in';
}

//require_once 'resources/views/layouts/header.php';
//require_once 'resources/views/layouts/aside.php';

class LoginController
{
//    public $data;

//    public function __construct()
//    {
//
//        $this->data = Db::getData('login-id');
//    }

    public function actionIndex()
    {
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $hiconUser;
        global $article;

        $categories = array();
        $categories = Category::getCategories();

        $email = '';
        $password = '';
        $keepMe = false;

        if (isset($_POST['submit'])) {

            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            if (isset($_POST['keepMe'])) {
                echo '</br>keepMe';
                $keepMe = htmlspecialchars($_POST['keepMe']);
            }

            $errors = false;

//            if (!User::checkName($name)) {
//                $errors[] = 'Name must not be less than 2 characters';
//            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Not correct email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Password must not be less than 6 characters';
            }

            // Check if the user exists
            if (!$errors) {
                $userId = User::checkUserData($email, $password);
                if ($userId == false) {
                    $errors[] = 'You entered incorrect data';
                } else {
                    // if the data is correct, then remember the user (using the session)
                    User::auth($userId);
                    header("Location: /cabinet/");
                }
            }
//            if (User::checkEmailExists($email)) {
//                $errors[] = 'This email is already in use';
//            }
//            if ($errors == false) {
//                $result = User::register($name, $email, $password);
//            }

        }

        require_once(ROOT . '/resources/views/login.php');
        return true;
    }
}
