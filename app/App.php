<?php
/**
 * App Class Doc 
 * App Router File
 * PHP version 8.0.9
 *
 * @category App
 * @package  App
 * @author   Younès Ziadi <ziadi.mail.pro@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://younes-ziadi.com/blog/
 */

require "app/Utils/autoload.php";

/**
 * App Class Doc 
 * App Router Class
 * PHP version 8.0.9
 *
 * @category App
 * @package  App
 * @author   Younès Ziadi <ziadi.mail.pro@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://younes-ziadi.com/blog/
 */

final class App
{
    /**
     * Returns correct page to user
     *
     * @return void
     */
    public static function process(): void
    {
        $controllerName = "Home";
        $action = "view";

        session_start();
        date_default_timezone_set("Europe/Paris");

        if (\Utils\Http::getParam("page", "get")) {
            $controllerName = ucfirst(strtolower(\Utils\Http::getParam("page", "get")));
        }

        if (\Utils\Http::getParam("action", "get")) {
            $action = \Utils\Http::getParam("action", "get");
        }

        $controllerName = "\Controllers\\" . $controllerName;
        if (!class_exists($controllerName)) {
            $controllerName = "\Controllers\\Home";
            $controller = new $controllerName();
            $controller->view();
            return;
        }
        $controller = new $controllerName();

        if (!method_exists($controller, $action)) {
            unset($controller);

            $controllerName = "\Controllers\\Home";
            $controller = new $controllerName();
            $controller->view();
            return;
        }
        $controller->$action();
    }
}