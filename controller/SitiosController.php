<?php

class SitiosController {

    private $view;

    public function __construct() {
        $this->view = new View();
    }//fin del constructor.
    
    public function obtenerRecomendaciones() {
        include 'public/useful/Euclides.php';
        require 'model/SitioModel.php';
        require 'public/domain/Sitio.php';
        
        $sitioModel = new SitioModel();
        
        if(isset($_SESSION['correo'])){
            $usuarioModel = new UsuarioModel();
            $usuarioModel->obtenerCriteriosUsuario($_SESSION['correo']);
        }
        
        if(isset($_SESSION['precio']) || isset($_SESSION['tipo_viaje']) || isset($_SESSION['ubicacion'])){
            $precio = $_SESSION['precio'];
            $tipo_viaje = $_SESSION['tipo_viaje'];
            $ubicacion = $_SESSION['ubicacion'];
            $consulta = $sitioModel->obtenerTodosLosSitios();
            $registros = [];
            $arrayPrecio = array(
                '100-1000' => 1,
                '1001-5000' => 2,
                '5001-15000' => 3,
            );
            $arrayUbicacion = array(
                'Rural'=>1,
                'Urbano'=>2
            );
            $arrayTipoViaje = array(
                'Negocio' => 1,
                'Familiar' => 2,
                'Deportivo' => 3,
                'Cultural' => 4,
            );

            for ($i = 0; $i < count($consulta); $i++) {
                $sitioActual = array(
                    'precio' => $arrayPrecio[$consulta[$i]->getPrecio()],
                    'tipo_viaje' => $arrayTipoViaje[$consulta[$i]->getTipo_de_viaje()],
                    'titulo' => $consulta[$i]->getTitulo(),
                    'imagen'=>$consulta[$i]->getImagen(),
                    'video'=>$consulta[$i]->getVideo(),
                    'descripcion' => $consulta[$i]->getDescripcion(),
                    'latitud' => $consulta[$i]->getLatitud(),
                    'longitud' => $consulta[$i]->getLongitud(),
                    'ubicacion' => $arrayUbicacion[$consulta[$i]->getUbicacion()],
                );

                array_push($registros, $sitioActual);
            }//Fin del for que recorre todos los registros que se trajeron de la consulta y los agrega a un arreglo.

            $vectorA = array('precio' => $precio, 'tipo_viaje' => $tipo_viaje,'ubicacion'=>$ubicacion);
            $variables = ['precio', 'tipo_viaje','ubicacion'];
            $resultado = euclides($vectorA, $registros, $variables);
            return $resultado;
        }else{
            return 0;
        }//Verifica si se está logueado, para consultar si ya hay criterios definidos por el usuario.
    }//Fin de la función obtenerRecomendaciones, que obtiene todos los sitios turísticos que se tienen en la BD y de acuerdo a los datos del formulario de intereses insertados por el usuario en la aplicación, aplica el algoritmo de Euclides para obtener los sitios o el contenido de interes.

    public function insertarSitio(){
        require 'public/domain/Sitio.php';
        require 'model/SitioModel.php';
        require 'public/useful/Bayes.php';
        
        $rangoPrecio = '';
        
        if((intval($_POST['precio']) >= 100 && intval($_POST['precio']) <= 1000) || intval($_POST['precio']) < 100){
            $rangoPrecio = '100-1000';
        }else if (intval($_POST['precio']) >= 1001 && intval($_POST['precio']) <= 5000){
            $rangoPrecio = '1001-5000';
        }else if ((intval($_POST['precio']) >= 5001 && intval($_POST['precio']) <= 15000) || intval($_POST['precio']) > 15000){
            $rangoPrecio = '5001-15000';
        }//Verifica dentro de un rango la cantidad de dinero que dispone el usuario.

        $sitio = new Sitio();
        $sitio->setTitulo($_POST['titulo']);
        $sitio->setDescripcion($_POST['descripcion']);
        $sitio->setPrecio($rangoPrecio);
        $sitio->setUbicacion($_POST['ubicacion']);
        $sitio->setImagen("public/images/".$_POST['imagen']);
        $sitio->setVideo($_POST['video']);
        $sitio->setLatitud($_POST['latitud']);
        $sitio->setLongitud($_POST['longitud']);
        
        /***************************** ****************************************/
        
        $sitioModel = new SitioModel();
        $ubicaciones = $sitioModel->obtenerDatosTabla_NC("SELECT * FROM tabla_nc WHERE tipo = ?", $_POST['ubicacion']);
        $precios = $sitioModel->obtenerDatosTabla_NC("SELECT * FROM tabla_nc WHERE tipo = ?", $rangoPrecio);
        $n = $sitioModel->obtenerN();
        $priori = $sitioModel->obtenerPriori();
        $bayes = new Bayes(2, 1/3, 1/2, $n, $priori, $ubicaciones, $precios);
        $sitio->setTipo_de_viaje($bayes->calcularBayes());
        $resultado = $sitioModel->insertarSitio($sitio);
        
        if($resultado === 1)
            $this->view->show("PrincipalView");
        else
            $this->view->show("AgregarSitioTuristico");
        
    }//Fin de la función insertarSitio.
    
}//Fin de la clase SitiosController.

?>

