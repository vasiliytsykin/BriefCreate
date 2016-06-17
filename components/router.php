<?php


class router
{
    private $routes;
    
    public function __construct()
    {
        $routesPath = "config/routes.php";
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI']))
            return trim($_SERVER['REQUEST_URI'], '/');
    }
    
    public function run()
    {

        $uri = $this->getURI();

        foreach ($this->routes as $pattern => $path)
            if(preg_match("~$pattern~", $uri))
            {
                $internalPath = preg_replace("~$pattern~", $path, $uri);

                $segments = explode('/', $internalPath);
                $controllerName = array_shift($segments) . "Controller";
                $actionName = array_shift($segments);

                $parameters = $segments;

                $controllerFile = "controllers/" . $controllerName . ".php";
                if (file_exists($controllerFile))
                    include_once($controllerFile);

                $controller = new $controllerName;
                $result = $controller->$actionName($parameters);
                if($result != null)
                    break;
            }
    }
}