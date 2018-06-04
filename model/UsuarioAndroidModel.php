<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioAndroidModel
 *
 * @author Alfonso
 */
class UsuarioAndroidModel {
    
    private $db;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }//Fin del constructor.

    
    public function insertarUsuario($usuario){
        $query = $this->db->prepare("call sp_registrar_usuario('".$usuario->getCorreo().
                "','".$usuario->getContrasena()."','".$usuario->getNombre()."',".$usuario->getEdad().
                ",'".$usuario->getGenero()."')");
        $query->execute();
        $resultado = $query->rowCount();
        return $resultado;
    }//Fin de la función insertarUsuario.
}
