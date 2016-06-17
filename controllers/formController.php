<?php

class formController
{
    private $form;
    
    public function index($parameters)
    {
        if(empty($parameters))
            $form = "client_data.php";
        else
            $form = $parameters[0] . ".php";
        
        include_once("share/_layout.php");
        return true;
    }
}