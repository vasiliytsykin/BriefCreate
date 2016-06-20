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

        try {
            $recorder->push_to_db($session);
            $this->show_report($session);
        }
        catch (Exception $e){

            echo "что то пошло не так";
        }
    }

    private function show_report(array $session){

        $folder = "share";
        $file = "report.php";
        require_once ("share/_layout.php");
    }
}