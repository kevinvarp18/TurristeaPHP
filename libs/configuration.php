<?php
    require 'libs/Config.php';
    $config = Config::singleton();
    $config->set('controllerFolder', 'controller/');
    $config->set('modelFolder', 'model/');
    $config->set('viewFolder', 'view/');
    $config->set('dbhost', '127.0.0.1');
    $config->set('dbname', 'pruebas');
    $config->set('dbuser', 'root');
    $config->set('dbpass', '');
?>
