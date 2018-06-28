<?php
class AdministradorController {

    private $view;

    public function __construct() {
        $this->view = new View();
    }//fin del constructor.

    public function agregarAdministradorView(){
        $this->view->show("AgregarAdministradorView");
    }//Fin de la función agregarAdministradorView.
    
    public function agregarAdmin(){
        require 'model/UsuarioModel.php';
        require 'public/domain/Usuario.php';
            
        $usuarioModel = new UsuarioModel();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($_POST['email']);
        $usuarioActual->setContrasena($_POST['password']);
        $usuarioActual->setNombre('');
        $usuarioActual->setEdad(0);
        $usuarioActual->setGenero('');
        $resultado = $usuarioModel->insertarAdministrador($usuarioActual);
        if($resultado === 1)
            $this->view->show("PrincipalView");
        else
            $this->view->show("RegistrarseView");
    }//Fin de la función agregarAdmin
    
    public function agregarSitioTuristico(){
        $this->view->show("AgregarSitioTuristico");
    }//Fin de la función administrarContenido.
    
    public function editarSitioTuristico(){
        $numPagina = $_GET['numPagina'];
        $this->view->show("EditarSitioTuristicoView", $numPagina);
    }//Fin de la función editarSitioTuristico.

  }//Fin de la clase UsuarioController.
?>
