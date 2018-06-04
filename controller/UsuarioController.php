<?php
class UsuarioController {

    private $view;

    public function __construct() {
        $this->view = new View();
    }//fin del constructor.

    public function login(){
        require 'model/UsuarioModel.php';
        require 'public/domain/Usuario.php';
            
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->obtenerTodosLosUsuarios();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($_POST['email']);
        $usuarioActual->setContrasena($_POST['password']);
        $bandera = 0;
        $tipoUsuario = '';
        
        foreach($usuarios as $usuario){
            if(strcmp($usuario->getCorreo(), $usuarioActual->getCorreo()) === 0){
                if(strcmp($usuario->getContrasena(), $usuarioActual->getContrasena()) === 0){
                    $bandera = 1;
                    $tipoUsuario = $usuario->getTipoUsuario();
                    break;
                }//Fin del if que verifica si las contraseñas son iguales.
            }//Fin del if que verifica si los correos son iguales.
        }//Fin del foreach.
        
        if($bandera === 1){
            session_start();
            $_SESSION['tipoUsuario'] = $tipoUsuario;
            $_SESSION['correo'] = $_POST['email'];
        }//Si se autenticó al usuario, inicia session.
        $this->view->show("PrincipalView");
    }//Fin de la función index.

    public function cerrarSesion(){
        session_start();
	session_destroy();
    	$this->view->show("PrincipalView");
    }//Fin de la función iniciarSesion.

    public function registrarse(){
        require 'model/UsuarioModel.php';
        require 'public/domain/Usuario.php';
            
        $usuarioModel = new UsuarioModel();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($_POST['email']);
        $usuarioActual->setContrasena($_POST['password']);
        $usuarioActual->setNombre($_POST['nombre']);
        $usuarioActual->setEdad($_POST['edad']);
        $usuarioActual->setGenero($_POST['genero']);
        $resultado = $usuarioModel->insertarUsuario($usuarioActual);
        echo $_POST['email'];
        if($resultado === 1)
            $this->view->show("PrincipalView");
        else
            $this->view->show("RegistrarseView");
    }//Fin de la función registrarse.
    
    public function actualizarDatosView(){
        require 'model/UsuarioModel.php';
        require 'public/domain/Usuario.php';
        session_start();
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->obtenerDatosUsuario($_SESSION['correo']);
        $this->view->show("ActualizarDatosView", $usuario);
    }//Fin de la función actualizarDatosView
    
    public function actualizarDatos(){
        require 'model/UsuarioModel.php';
        require 'public/domain/Usuario.php';
            
        $usuarioModel = new UsuarioModel();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($_POST['email']);
        $usuarioActual->setContrasena($_POST['password']);
        $usuarioActual->setNombre($_POST['nombre']);
        $usuarioActual->setTipoUsuario('u');
        $usuarioActual->setEdad($_POST['edad']);
        $usuarioActual->setGenero($_POST['genero']);
        $resultado = $usuarioModel->actualizarUsuario($usuarioActual);
        
        if($resultado === 1)
            $this->view->show("PrincipalView");
        else
            $this->view->show("ActualizarDatosView");
    }//Fin de la función actualizarDatos.
    
    public function formularioIntereses(){
        session_start();
        $_SESSION['intereses'] = 1;
        $this->view->show("SitiosInteresView", 1);
    }//Fin de la función formularioIntereses.
    
    public function misFavoritos(){
        $this->view->show("FavoritosView");
    }//Fin de la función misFavoritos.

  }//Fin de la clase UsuarioController.
?>
