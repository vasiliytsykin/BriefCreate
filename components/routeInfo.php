<?php


class routeInfo
{
    public $controllerName;
    public $actionName;
    public $parameters;

    public function __construct()
    {
        $this->create_info();
    }

    private function getUriPath()
    {
        if (!empty($_SERVER['REQUEST_URI']))
            return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    private function create_info()
    {

        if ($_SERVER['REQUEST_URI'] != '/') {
            try {
                $uriPath = $this->getUriPath();
                $segments = explode('/', $uriPath);
                if (count($segments) % 2)
                    throw new Exception();

                $this->controllerName = array_shift($segments) . "Controller";
                $this->actionName = array_shift($segments);

                for ($i = 0; $i < count($segments); $i++)
                    $this->parameters[$segments[$i]] = $segments[++$i];

            } catch (Exception $e) {

            }
        }
        
        else{
            $this->controllerName = 'mainController';
            $this->actionName = 'get_form';
            $this->parameters = array();
        }
    }
}