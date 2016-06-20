<?php

require_once "components/routeInfo.php";

class router
{
    private $controllerName;
    private $actionName;
    private $parameters;
    
    public function __construct()
    {
        $this->controllerName = 'mainController';
        $this->actionName = 'get_form';
        $this->parameters = array();
    }
    
    public function run()
    {
        $routeInfo = new routeInfo();

        $controllerFile = "controllers/" . $routeInfo->controllerName . ".php";
            if (file_exists($controllerFile))
                include_once($controllerFile);
        
        $action = new ReflectionMethod($routeInfo->controllerName, $routeInfo->actionName);
        $action->invokeArgs(new $routeInfo->controllerName, array($routeInfo->parameters));
    }
}