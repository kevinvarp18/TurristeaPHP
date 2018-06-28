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
        require 'model/UsuarioModel.php';
        
        $sitioModel = new SitioModel();
        
        if(isset($_SESSION['correo'])){
            $usuarioModel = new UsuarioModel();
            $usuarioModel->obtenerCriteriosUsuario($_SESSION['correo']);
        }//Verifica si se está logueado, para consultar si ya hay criterios definidos por el usuario.
        
        $precio = $_SESSION['precio'];
        $tipo_viaje = $_SESSION['tipoLugar'];
        $ubicacion = $_SESSION['tipoViaje'];
        $consulta = $sitioModel->obtenerTodosLosSitios();
        $registros = [];
        $arrayPrecio = array(
            '100-1000' => 1,
            '1001-5000' => 2,
            '5001-15000' => 3,
        );
        $arraUbicacion = array(
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
                'ubicacion' => $arraUbicacion[$consulta[$i]->getUbicacion()],
            );
            
            array_push($registros, $sitioActual);
        }//Fin del for que recorre todos los registros que se trajeron de la consulta y los agrega a un arreglo.

        $vectorA = array('precio' => $precio, 'tipo_viaje' => $tipo_viaje,'ubicacion'=>$ubicacion);
        $variables = ['precio', 'tipo_viaje','ubicacion'];
        $resultado = euclides($vectorA, $registros, $variables);
        return $resultado;
    }//Fin de la función obtenerRecomendaciones, que obtiene todos los sitios turísticos que se tienen en la BD y de acuerdo a los datos del formulario de intereses insertados por el usuario en la aplicación, aplica el algoritmo de Euclides para obtener los sitios o el contenido de interes.

    public function obtenerSitios() {
        require 'model/SitioModel.php';
        require 'public/domain/Sitio.php';
        $modelo = new SitioModel();
        $consulta = $modelo->obtenerTodosLosSitios();
        $registros = [];

        for ($i = 0; $i < count($consulta); $i++) {
            $sitioActual = array(
                'precio' => utf8_encode($consulta[$i]->getPrecio()),
                'tipo_viaje' => utf8_encode($consulta[$i]->getTipo_de_viaje()),
                'titulo' => utf8_encode($consulta[$i]->getTitulo()),
                'imagen'=> utf8_encode($consulta[$i]->getImagen()),
                'video'=> utf8_encode($consulta[$i]->getVideo()),
                'descripcion' => utf8_encode($consulta[$i]->getDescripcion()),
                'latitud' => utf8_encode($consulta[$i]->getLatitud()),
                'longitud' => utf8_encode($consulta[$i]->getLongitud()),
                'ubicacion' => utf8_encode($consulta[$i]->getUbicacion()),
                );
            
            array_push($registros, $sitioActual);
        }//Fin del for que recorre todos los registros que se trajeron de la consulta y los agrega a un arreglo.

        echo json_encode(( array("sitios"=>$registros)));
    }//Fin de la función obtenerSitios que obtiene todos los sitios turísticos que se tienen registrados en la base de datos.
    
    public function insertarSitio(){
        require 'model/SitioModel.php';
        require 'public/useful/Bayes.php';
        
        /***************************** ****************************************/
        
        $sitioModel = new SitioModel();
        $ubicaciones = $sitioModel->obtenerDatosTabla_NC("SELECT * FROM tabla_nc WHERE tipo = ?", $_POST['ubicacion']);
        $precios = $sitioModel->obtenerDatosTabla_NC("SELECT * FROM tabla_nc WHERE precio = ?", $_POST['precio']);
        $n = $sitioModel->obtenerN();
        $priori = $sitioModel->obtenerPriori();
        $clase = '';
        $bayes = new Bayes(2, 1/3, 1/2, $n, $priori, $ubicaciones, $precios);
        $clase = $bayes->calcularBayes();
    }//Fin de la función insertarSitio.
    
}//Fin de la clase SitiosController.

?>

