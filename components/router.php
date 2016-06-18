<?php


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

    private function getUriPath()
    {
        if(!empty($_SERVER['REQUEST_URI']))
            return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }
    
    public function run()
    {
        if($_SERVER['REQUEST_URI'] != '/')
        {
            try{
                $uriPath = $this->getUriPath();
                $segments = explode('/', $uriPath);
                if(count($segments) % 2)
                    throw new Exception();

                $this->controllerName = array_shift($segments) . "Controller";
                $this->actionName = array_shift($segments);

                for ($i = 0; $i < count($segments); $i++)
                    $this->parameters[$segments[$i]] = $segments[++$i];

            }
            catch (Exception $e) {

            }

        }
        $controllerFile = "controllers/" . $this->controllerName . ".php";
            if (file_exists($controllerFile))
                include_once($controllerFile);
        
        $action = new ReflectionMethod($this->controllerName, $this->actionName);
        $action->invokeArgs(new $this->controllerName, array($this->parameters));
    }
}