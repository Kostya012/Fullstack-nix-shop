<?php

declare(strict_types=1);

namespace framework\Components;

defined('VG_ACCESS') or die('Access denied');

use framework\Config\exceptions\RouteException;

class Router
{
    // connection trait;
    use BaseMethods;

//    use Singleton;

    private array $routes;
    private int $countRoutes;

    public function __construct()
    {
        $routesPath = ROOT . '/framework/Config/routes.php';
        $this->routes = include($routesPath);
        $this->countRoutes = count($this->routes);
    }

    /**
     * Returns request string
     * @return string
     */
    private function getUri(): string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return '';
    }

    /**
     * @throws RouteException
     */
    public function run(): void
    {
        // получити строку запроса
        $uri = $this->getUri();
//        echo '</br>URI: ' . $uri . '</br>';

        // перевірити запрос у routes
        $count = 0;
        foreach ($this->routes as $uriPattern => $path) {
            ++$count;
            // порівнюємо $uriPattern з $uri
            if (preg_match("~$uriPattern~", $uri)) {
//                echo '<br/>Де шукаємо (запит, який набрав користувач): ' . $uri;
//                echo '<br/>Що шукаємо (співпадіння з правил): ' . $uriPattern;
//                echo '<br/>Хто обробляє: ' . $path;

                // Отримуємо внутрішній шлях з зовнішнього згідно правил
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

//                echo '<br/><br/>Необхідно зформувати: ' . $internalRoute;

                // якщо співпадіння є, визначити який контролер і action опрацьовує запит
//                $segments = explode('/', $path);
                $segments = explode('/', $internalRoute);

                // get name controller from array first change then delete from array
                // array_shift отримує перший елемент масива потім видаляє його з масива
                $controllerName = array_shift($segments) . 'Controller';
                // upper Case first
                $controllerName = ucfirst($controllerName);
                // get action name
                $actionName = 'action' . ucfirst(array_shift($segments));
//                echo '<br/>';
//                echo 'Controller name: ' . $controllerName;
//                echo '<br/>';
//                echo 'Action name: ' . $actionName;
//                echo '<br/>';
//                echo '<br/>параметри у масиві segments';

                $parameters = $segments;

                // параметри у масиві
//                echo '<pre>';
//                print_r($parameters);
//                echo '</pre>';

                // підключити файл класа контролера
                $controllerFile = ROOT . '/App/Controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
//                    echo '<br/>';
//                    echo 'файл підключено: ' . $controllerFile;
                } else {
//                    $this->writeLog("File Controller not exist  $controllerFile");
                    throw new RouteException('File Controller not exist: ' . $controllerFile, 1);
//                    echo '<br/>';
//                    echo 'файл контролер not';
                }

                if (method_exists($controllerName, $actionName)) {
                    // створити об'єкт, визвати метод (тобто action)
                    $controllerObject = new $controllerName();

//                $result = $controllerObject->$actionName($parameters);
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                    if ($result != null) {
                        break;
                    } else {
                        $this->writeLog("File Controller return false: $controllerFile");
                        throw new RouteException('File Controller return false: ' . $controllerFile, 0);
//                        echo '<br/>';
//                        echo 'File Controller return false:';
                    }
                } else {
                    $this->writeLog("Entries a non-existent page: $controllerFile");
//                    echo '<br/>';
//                    echo 'action have not: ';
                }
            }

            // якщо останній роутс не підходить, то показуєм домашню сторінку
            if ($this->countRoutes <= $count) {
//                $this->writeLog("Entries a non-existent page or not correct page");
                throw new RouteException('Entries a non-existent page or not correct page: ' . $uri, 0);
//                echo '<br/>якщо останній роутс не підходить, то показуєм домашню сторінку';
                $controllerName = 'HomeController';
                $actionName = 'actionIndex';
//                echo '<br/>';
//                echo 'Controller name: ' . $controllerName;
//                echo '<br/>';
//                echo 'Action name: ' . $actionName;
//                echo '<br/>';
//                echo '<br/>';

                // підключити файл класа контролера
                $controllerFile = ROOT . '/App/Controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
//                    echo '<br/>';
//                    echo 'файл підключено: ' . $controllerFile;
                } else {
                    throw new RouteException('File Controller not exist: ' . $controllerFile, 1);
//                    echo '<br/>';
//                    echo 'файл контролер not';
                }

                // створити об'єкт, визвати метод (тобто action)
                $controllerObject = new $controllerName();

                $result = $controllerObject->$actionName();

                if ($result != null) {
                    break;
                } else {
                    throw new RouteException('Action indexAction return false from HomeController', 1);
                }
            }
        }
    }
}
