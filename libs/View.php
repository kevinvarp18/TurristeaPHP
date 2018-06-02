<?php

class View {

    public function __construct() {
        ;
    }//__construct

    public function show($nombreVista, $vars=array()){
        $config=Config::singleton();
        $path=$config->get('viewFolder').$nombreVista.'.php';
        if(is_file($path) == FALSE){
            trigger_error('Pagina '.$path.' no existe', E_USER_NOTICE);
            return FALSE;
        }//if
        if(is_array($vars)){
            foreach ($vars as $key=>$value) {
                $key=$value;
            }//foreach
        }//if
        include $path;
    }//show

}//View
