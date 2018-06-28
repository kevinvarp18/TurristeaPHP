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
            $this->view->show("PrincipalView");
        }else{
            $this->view->show("IniciarSesionView");
        }//Si se autenticó al usuario, inicia session.
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
    
    public function criteriosFormulario(){
        require 'controller/SitiosController.php';
        require 'model/UsuarioModel.php';
        session_start();
        $rangoPrecio = '';
        $resultado = 2;
        
        if((intval($_POST['dinero']) >= 100 && intval($_POST['dinero']) <= 1000) || intval($_POST['dinero']) < 100){
            $rangoPrecio = '100-1000';
        }else if (intval($_POST['dinero']) >= 1001 && intval($_POST['dinero']) <= 5000){
            $rangoPrecio = '1001-5000';
        }else if ((intval($_POST['dinero']) >= 5001 && intval($_POST['dinero']) <= 15000) || intval($_POST['dinero']) > 15000){
            $rangoPrecio = '5001-15000';
        }//Verifica dentro de un rango la cantidad de dinero que dispone el usuario.
        
        if(isset($_SESSION['correo'])){
            $usuarioModel = new UsuarioModel();
            $resultado = $usuarioModel->insertarIntereses($_SESSION['correo'], $rangoPrecio, $_POST['ubicacion'], $_POST['tipoViaje']);
        }else{
            $resultado = 0;
        }//Verifica si es un usuario registrado o no.
        
        $_SESSION['precio'] = $rangoPrecio;
        $_SESSION['ubicacion'] = $_POST['ubicacion'];
        $_SESSION['tipo_viaje'] = $_POST['tipoViaje'];
        $_SESSION['criterios'] = 1;
        
        if($resultado === 2){
            $this->view->show("FormularioInteresesView");
        }else{
            $sitiosController = new SitiosController();
            $sitios = $sitiosController->obtenerRecomendaciones();
            $this->view->show("SitiosInteresView", array('sitio' => $sitios[0],'numPagina' => 1));
        }//Si se insertó los criterios del usuario, lo lleva a mostrar la recomendación.
        
    }//Fin de la función criteriosFormulario.

  }//Fin de la clase UsuarioController.
?>
