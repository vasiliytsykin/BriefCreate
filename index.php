<?php

//  общие настройки

ini_set('display_errors', 1);
error_reporting(E_ALL);

// подключение файлов системы

require_once "components/router.php";

session_start();

// подключение к БД

/*
   router:
    анализ запроса,
    определение контроллера,
    подключить файл контроллера,
    передача управления контроллеру

*/

$router = new router();
$router->run();