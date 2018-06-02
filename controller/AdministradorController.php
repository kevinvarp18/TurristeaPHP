<?php
class AdministradorController {

    private $view;

    public function __construct() {
        $this->view = new View();
    }//fin del constructor.

    public function agregarAdministradorView(){
        $this->view->show("AgregarAdministradorView");
    }//Fin de la función agregarAdministradorView.
    
    public function administrarContenido(){
        $this->view->show("AdministrarContenidoView");
    }//Fin de la función administrarContenido.
    
    public function editarSitioTuristico(){
        $numPagina = $_GET['numPagina'];
        $this->view->show("EditarSitioTuristicoView", $numPagina);
    }//Fin de la función editarSitioTuristico.

  }//Fin de la clase UsuarioController.
?>
