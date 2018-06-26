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
        $modelo = new SitioModel();
        $precio = $_GET['precio'];
        $tipo_viaje = $_GET['tipo_viaje'];
        $ubicacion = $_GET['ubicacion'];
        $consulta = $modelo->obtenerTodosLosSitios();
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
                'precio' => utf8_encode($arrayPrecio[$consulta[$i]->getPrecio()]),
                'tipo_viaje' => utf8_encode($arrayTipoViaje[$consulta[$i]->getTipo_de_viaje()]),
                'titulo' => utf8_encode($consulta[$i]->getTitulo()),
                'imagen'=>$consulta[$i]->getImagen(),
                'video'=>utf8_encode($consulta[$i]->getVideo()),
                'descripcion' => utf8_encode($consulta[$i]->getDescripcion()),
                'latitud' => utf8_encode($consulta[$i]->getLatitud()),
                'longitud' => utf8_encode($consulta[$i]->getLongitud()),
                'ubicacion' => utf8_encode($arraUbicacion[$consulta[$i]->getUbicacion()]),
                );
            
            array_push($registros, $sitioActual);
        }//Fin del for que recorre todos los registros que se trajeron de la consulta y los agrega a un arreglo.

        $vectorA = array('precio' => $precio, 'tipo_viaje' => $tipo_viaje,'ubicacion'=>$ubicacion);
        $variables = ['precio', 'tipo_viaje','ubicacion'];

        $resultado = euclides($vectorA, $registros, $variables);
        $final;
        echo json_encode(( array("sitios"=>$resultado)));
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
}

?>

