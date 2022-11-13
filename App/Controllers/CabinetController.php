<?php

include_once ROOT . '/App/Models/Category.php';
include_once ROOT . '/App/Models/User.php';

//for header
{
    $GLOBALS['hiconIndex'] = '';
    $GLOBALS['hiconProducts'] = '';
    $GLOBALS['hiconCart'] = '';
    $GLOBALS['hiconSignIn'] = '';
    $GLOBALS['hiconSignUp'] = '';
    $GLOBALS['hiconUser'] = ' active';
    $GLOBALS['article'] = 'User account';
}

class CabinetController
{
    public function actionIndex()
    {
        $userId = User::checkLogged();
//        echo 'userId = ' . $userId;

        // get information about User from Database
        $user = User::getUserById($userId);

        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $hiconUser;
        global $article;

        $categories = array();
        $categories = Category::getCategories();

        require_once(ROOT . '/resources/views/cabinet.php');
        return true;
    }

    public function actionEdit()
    {
        // get id from session
        $userId = User::checkLogged();

        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $hiconUser;
        $GLOBALS['article'] = 'Account editing';
        global $article;

        $categories = array();
        $categories = Category::getCategories();

        // get information about user
        $user = User::getUserById($userId);

        $name = $user['name'];
        $password = $user['password'];

        $result = false;
        if (isset($_POST['submit'])) {
            $name = htmlspecialchars($_POST['name']);
            $password = htmlspecialchars($_POST['password']);

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Name must not be less than 2 characters';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Password must not be less than 6 characters';
            }
            if ($errors == false) {
                $result = User::edit($userId, $name, $password);
            }
        }
        require_once(ROOT . '/resources/views/edit.php');
        return true;
    }

    public function actionHistory()
    {}

    public function actionLogout()
    {
        unset($_SESSION['user']);
        header('Location: /home');
    }
}