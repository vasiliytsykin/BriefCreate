<?php


class errorController
{
    public function get_error_page()
    {
        $folder = "share";
        $file = "error.php";
        require_once ("share/_layout.php");
    }
}