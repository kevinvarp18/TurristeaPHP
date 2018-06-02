<?php

class SPDO extends PDO {
    private static $instance=null;
    
    public function __construct() {
        $config=  Config::singleton();
        parent::__construct('mysql:host='.$config->get('dbhost').';dbname='.$config->get('dbname'),
                $config->get('dbuser'), $config->get('dbpass'));
    }//__construct
    
    public static function singleton(){
        if(self::$instance==NULL){
            self::$instance=new self();
        }//if
        return self::$instance;
    }//singleton
    
}//SPDO

?>