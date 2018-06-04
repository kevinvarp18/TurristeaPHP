<?php

class UsuarioAndroidController {
     private $view;

    public function __construct() {
        $this->view = new View();
    }//fin del constructor.

    
     public function registrarse(){
        require 'model/UsuarioAndroidModel.php';
        require 'public/domain/Usuario.php';
            
        $usuarioModel = new UsuarioAndroidModel();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($_REQUEST["email"]);
        $usuarioActual->setContrasena($_REQUEST["password"]);
        $usuarioActual->setNombre($_REQUEST["nombre"]);
        $usuarioActual->setEdad($_REQUEST["edad"]);
        $usuarioActual->setGenero($_REQUEST["genero"]);
        $resultado = $usuarioModel->insertarUsuario($usuarioActual);
        if($resultado === 1){
            $respuesta = array("resultado" => "guardado");
            echo json_encode($respuesta);
        }else{
            $respuesta = array("resultado" => "Error(121)");
            echo json_encode($respuesta);
        }
    }//Fin de la función registrarse.
}
