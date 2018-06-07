<?php
    require 'libs/Config.php';
    $config = Config::singleton();
    $config->set('controllerFolder', 'controller/');
    $config->set('modelFolder', 'model/');
    $config->set('viewFolder', 'view/');
    $config->set('dbhost', '163.178.107.130:3306');
    $config->set('dbname', 'dbTurris');
    $config->set('dbuser', 'laboratorios');
    $config->set('dbpass', 'UCRSA.118');
?>
