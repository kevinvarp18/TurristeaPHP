<?php

class Config {
    private $vars;
    private static $instance;
    
    private function _construct(){
        $this->vars=array();
    }//_construct
    
    public function set($nombreAtributo, $valor){
        if(!isset($this->vars[$nombreAtributo])){
            $this->vars[$nombreAtributo]=$valor;
        }//if
    }//set
    
    public function get($nombreAtributo){
        if(isset($this->vars[$nombreAtributo])){
            return $this->vars[$nombreAtributo];
        }//if
    }//get
    
    
    public static function singleton(){
        if(!isset(self::$instance)){//self::$instance se refiere a la clase en donde esta siendo llamado para ver si ya se instancio
            $tempClass=__CLASS__;//__CLASS__ da el nombre de la clase en la que esta
            self::$instance=new $tempClass;
        }//if
        return self::$instance;
    }//singleton
    
}//Config

?>