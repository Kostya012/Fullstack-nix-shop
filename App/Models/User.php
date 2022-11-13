<?php

class User
{
    /**
     * Register new user
     * @param string $name
     * @param string $email
     * @param string $password
     * @return bool
     */
    public static function register(string $name, string $email, string $password):bool
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO users (name, email, password) '
            . 'VALUES (:name, :email, :password)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * check Name: must not be less than 2 characters
     * @param $name string
     * @return bool
     */
    public static function checkName(string $name):bool
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * check Email
     * @param $email string
     * @return bool
     */
    public static function checkEmail(string $email):bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * check Email Exists
     * @param string $email
     * @return bool
     */
    public static function checkEmailExists(string $email):bool
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    }

    /**
     * check Password: must not be less than 6 characters
     * @param $password string
     * @return bool
     */
    public static function checkPassword(string $password):bool
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Check if a user exists with given Email and Password
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public static function checkUserData(string $email, string $password):mixed
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        if ($user) {
            return $user['id'];
        }
        return false;
    }

    public static function edit($id, $name, $password)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE users SET name = :name, password = :password WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function auth(int $userId): void
    {
        $_SESSION['user'] = $userId;
    }

    /**
     * @return void
     */
    public static function checkLogged()
    {
        // if there  is a session, return the user ID
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /login");
    }

    public static function getUserById($id)
    {
        $db = Db::getConnection();
//        $sql = 'SELECT name FROM users WHERE id = :userId';
        $sql = 'SELECT * FROM users WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);

        // indicate, that we want to receive data in the form of an array
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
}