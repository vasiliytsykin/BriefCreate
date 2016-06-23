<?php

require_once "components/recorder.php";

class briefController
{
    public function create()
    {
        $recorder = new recorder();
        $recorder->record();
        
        $session = $_SESSION;
        session_destroy();
        $id = $recorder->get_last_id('briefdb', 'brief');

        try {
            $recorder->push_to_db('briefdb', 'brief', $session);
            header("Location: /brief/show_report/id/$id");
        }
        catch (Exception $e){

            echo "что то пошло не так";
        }


    }

    public function show_report(array $parameters){
        
        $recorder = new recorder();
        $data = $recorder->fetch_from_db('briefdb', 'brief',$parameters['id']);
        
        $folder = "share";
        $file = "report.php";
        $uri = "http://" . $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];
        require_once ("share/_layout.php");
    }
}