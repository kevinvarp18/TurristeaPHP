<?php

    class FrontController{
        static function main(){
            require 'libs/View.php';
            require 'libs/configuration.php';
            if(!empty($_GET['controller'])){
                $controllerName=$_GET['controller'].'Controller';
            }else{
                $controllerName='PrincipalController';
            }//if-else
            if(!empty($_GET['action'])){
                $nombreAccion=$_GET['action'];
            }else{
                $nombreAccion = 'index';
            }//if-else
            $rutaController=$config->get('controllerFolder').$controllerName.'.php';
            if(is_file($rutaController)){
                require $rutaController;
            }else{
                die('Controlador no encontrado - 404 not found');
            }//if-else
            if(is_callable(array($controllerName, $nombreAccion))==FALSE){
                trigger_error($controllerName.'->'.$nombreAccion.' no existe', E_USER_NOTICE);
                return FALSE;
            }//if
            $controller=new $controllerName();
            $controller->$nombreAccion();
        }//main
    }//FrontController

?>
