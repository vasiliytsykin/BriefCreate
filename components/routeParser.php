<?php

require_once "components/routeInfo.php";

class routeParser
{

    private function getUriPath($uri){
        
        if (!empty($uri))
            return trim(parse_url($uri, PHP_URL_PATH), '/');
    }

    public function parse($uri){
        
        if ($uri != '/')
            return $this->parse_path($this->getUriPath($uri));
            
        return $this->get_defaults();
    }

    private function parse_path($path){
        
        $segments = explode('/', $path);
        if (count($segments) % 2)
            throw new Exception();

        $controllerName = array_shift($segments) . "Controller";
        $actionName = array_shift($segments);
        $parameters = $this->get_parameters($segments);
            
        return new routeInfo($controllerName, $actionName, $parameters);
    }
    
    private function get_parameters(array $pathTail){

        $parameters = array();
        for ($i = 0; $i < count($pathTail); $i++)
            $parameters[$pathTail[$i]] = $pathTail[++$i];
        
        return $parameters;
        
    }
    
    private function get_defaults(){
        
        return new routeInfo('mainController', 'get_form', array());
    }
}