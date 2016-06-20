<?php


class routeInfo
{
    private $controllerName;
    private $actionName;
    private $parameters;
    
    public function __construct($controllerName, $actionName, array $parameters)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->parameters = $parameters;
    }
    
    public function __get($name)
    {
        return $this->$name;
    }
}