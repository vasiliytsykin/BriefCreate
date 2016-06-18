<?php

class mainController
{
    private $form;
    
    public function get_form($parameters)
    {
        if(empty($parameters))
            $form = "client_data.php";
        else
            $form = $parameters['id'] . ".php";
        
        include_once("share/_layout.php");
    }
}