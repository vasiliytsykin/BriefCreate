<?php

require_once "components/routeParser.php";
require_once "controllers/errorController.php";

class router
{
    public function run()
    {
        $routeParser = new routeParser();


        try {
            $routeInfo = $routeParser->parse($_SERVER['REQUEST_URI']);
            $controllerFile = "controllers/" . $routeInfo->controllerName . ".php";
            include_once($controllerFile);
            $action = new ReflectionMethod($routeInfo->controllerName, $routeInfo->actionName);
            $action->invokeArgs(new $routeInfo->controllerName, array($routeInfo->parameters));
        }
        catch (Exception $e)
        {
            $error = new errorController();
            $error->get_error_page();
        }
    }
}