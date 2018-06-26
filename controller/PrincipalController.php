<?php
class PrincipalController {

    private $view;
    
    public function __construct() {
        $this->view = new View();
    }//fin del constructor.
    
    public function index(){
        $this->view->show("PrincipalView");
    }//Fin de la función index.
    
    public function contenidoTuristico(){
        $numeroPagina = intval($_GET['numPagina']);
        $this->view->show("ContenidoTuristicoView", $numeroPagina);
    }//Fin de la función contenidoTuristico.
    
    public function creditos(){
        $this->view->show("CreditosView");
    }//Fin de la función creditos.
    
    public function formularioInteresesView(){
        $this->view->show("FormularioInteresesView");
    }//Fin de la función formularioInteresesView.
    
    public function iniciarSesion(){
    	$this->view->show("IniciarSesionView");
    }//Fin de la función iniciarSesion.
    
    public function mapaSitio(){
        $this->view->show("MapaSitioView");
    }//Fin de la función mapaSitio.

    public function registrarse(){
        $this->view->show("RegistrarseView");
    }//Fin de la función registrarse.
    
    public function sitiosInteres(){
        session_start();
        if(isset($_SESSION['intereses']))
            $this->view->show("SitiosInteresView", 1);
        else
            $this->view->show("FormularioInteresesView");
    }//Fin de la función sitiosInteres.

  }//Fin de la clase UsuarioController.
?>
