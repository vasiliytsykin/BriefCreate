<?php

require_once "components/recorder.php";

class mainController
{
    public function get_form($parameters)
    {
        
        $recorder = new recorder();
        $recorder->record();

        if(empty($parameters))
            $file = "client_data.php";
        else
            $file = $parameters['id'] . ".php";
        
        $folder = 'forms';
        
        include_once("share/_layout.php");
    }
}