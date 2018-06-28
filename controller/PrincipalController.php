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
        require 'model/SitioModel.php';
        require 'public/domain/Sitio.php';
        
        $numeroPagina = intval($_GET['numPagina']);
        $sitioModel = new SitioModel();
        $sitio = $sitioModel->obtenerSitio($numeroPagina);
        $this->view->show("ContenidoTuristicoView", array('sitio' => $sitio,'numPagina' => $numeroPagina));
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
        require 'controller/SitiosController.php';
        require 'model/UsuarioModel.php';
        $sitiosController = new SitiosController();
        $numeroPagina = intval($_GET['numPagina']);
        if(isset($_SESSION['criterios'])){
            $sitios = $sitiosController->obtenerRecomendaciones();
            $this->view->show("SitiosInteresView", array('sitio' => $sitios[$numeroPagina-1],'numPagina' => $numeroPagina));
        }else if(isset($_SESSION['correo'])){
            $sitios = $sitiosController->obtenerRecomendaciones();
            if($sitios === 0){
                $this->view->show("FormularioInteresesView");
            }else{
                $this->view->show("SitiosInteresView", array('sitio' => $sitios[$numeroPagina-1],'numPagina' => $numeroPagina));
            }//Verifica si ya hay criterios previamente marcados por el usuario o no.
        }else{
            $this->view->show("FormularioInteresesView");
        }/* Si ya fueron definidos los criterios marcados por el usuario, entonces
            recomienda los sitios. Sino, verifica si es un usuario logueado para
            consultar si ya existen criterios previamente marcados, sino, entonces
            devuelve la vista de formulario de intereses para que sea previamente
            llenado.
         */
    }//Fin de la función sitiosInteres.

  }//Fin de la clase UsuarioController.
?>
