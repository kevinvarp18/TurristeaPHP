<?php

class UsuarioAndroidController {
     private $view;

    public function __construct() {
        $this->view = new View();
    }//fin del constructor.

     public function login(){
        require 'model/UsuarioAndroidModel.php';
        require 'public/domain/Usuario.php';
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents("php://input"), true);
        $usuarioModel = new UsuarioAndroidModel();
        $usuarios = $usuarioModel->obtenerTodosLosUsuarios();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($body['email']);
        $usuarioActual->setContrasena($body['password']);
        $bandera = 0;
        $tipoUsuario = '';
        foreach($usuarios as $usuario){
            if(strcmp($usuario->getCorreo(), $usuarioActual->getCorreo()) === 0){
                if(strcmp($usuario->getContrasena(), $usuarioActual->getContrasena()) === 0){
                    $bandera = 1;
                    break;
                }//Fin del if que verifica si las contraseñas son iguales.
            }//Fin del if que verifica si los correos son iguales.
        }//Fin del foreach.
        
        if($bandera === 1){
            $respuesta = array("resultado" => "correcto");
            echo json_encode($respuesta);
        }else{
            $respuesta = array("resultado" => "incorrecto");
            echo json_encode($respuesta);
        }//else-if
    }//Fin de la función index.
    
     public function registrarse(){
        require 'model/UsuarioAndroidModel.php';
        require 'public/domain/Usuario.php';
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents("php://input"), true);
        $usuarioModel = new UsuarioAndroidModel();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($body["email"]);
        $usuarioActual->setContrasena($body["password"]);
        $usuarioActual->setNombre($body["nombre"]);
        $usuarioActual->setEdad($body["edad"]);
        $usuarioActual->setGenero($body["genero"]);
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
