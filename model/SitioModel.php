<?php

class SitioModel {
    private $db;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }//Fin del constructor.
    
    public function insertarSitio($sitio){
        $query = $this->db->prepare("call sp_registrar_sitio('".$sitio->getPrecio()."', '".$sitio->getUbicacion()."', '".$sitio->getTipo_de_viaje()."', '".$sitio->getDescripcion()."', '".$sitio->getTitulo()."', '".$sitio->getLatitud()."', '".$sitio->getLongitud()."', '".$sitio->getImagen()."', '".$sitio->getVideo()."')");
        $query->execute();
        $resultado = $query->rowCount();
        return $resultado;
    }//Fin de la función insertarSitio.

    public function obtenerTodosLosSitios() {
        $query = $this->db->prepare("SELECT * FROM sitios");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $rows = count($data);
        $sitiosArray = [];
        for ($i = 0; $i < $rows; $i++) {
            $sitio = new Sitio();
            $sitio->setId($data[$i]["id"]);
            $sitio->setDescripcion($data[$i]["descripcion"]);
            $sitio->setLatitud($data[$i]["latitud"]);
            $sitio->setLongitud($data[$i]["longitud"]);
            $sitio->setTipo_de_viaje($data[$i]["tipo_viaje"]);
            $sitio->setTitulo($data[$i]["titulo"]);
            $sitio->setPrecio($data[$i]["precio"]);
            $sitio->setUbicacion($data[$i]["ubicacion"]);
            $sitio->setVideo($data[$i]["video"]);
            $sitio->setImagen($data[$i]["imagen"]);

            array_push($sitiosArray, $sitio);
        }/* Fin del for i, que inserta en un arreglo todos los registros de los 
        usuarios que existen en la base de datos. */
        
        return $sitiosArray;
    }/* Fin del la función obtenerTodosLosSitios, que retorna el arreglo con 
    todos registros de los sitios turísticos que existen en su respectiva tabla de la  base 
    de datos. */
    
    public function obtenerSitio($id){
        $query = $this->db->prepare("SELECT * FROM sitios WHERE id = ?");
        $query->execute(array($id));
        $data = $query->fetch();
        $query->closeCursor();
        $sitio = new Sitio();
        $sitio->setId($id);
        $sitio->setPrecio($data["precio"]);
        $sitio->setUbicacion($data["ubicacion"]);
        $sitio->setTipo_de_viaje($data["tipo_viaje"]);
        $sitio->setDescripcion($data["descripcion"]);
        $sitio->setTitulo($data["titulo"]);
        $sitio->setLatitud($data["latitud"]);
        $sitio->setLongitud($data["longitud"]);
        $sitio->setImagen($data["imagen"]);
        $sitio->setVideo($data["video"]);
        return $sitio;
    }//Fin de la función obtenerSitio.

    public function obtenerDatosTabla_NC($consulta, $dato){
        $query = $this->db->prepare($consulta);
        $query->execute(array($dato));
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $rows = count($data);
        $array = [];
        for ($i = 0; $i < $rows; $i++) {
            $tabla_nc_temp = [];
            array_push($tabla_nc_temp, $data[$i]["numero"]);
            array_push($tabla_nc_temp, $data[$i]["tipo"]);
            array_push($tabla_nc_temp, $data[$i]["tipo_viaje"]);
            array_push($array, $tabla_nc_temp);
        }
        
        return $array;
    }//Fin de la funcion obtenerUbicaciones.
    
    public function obtenerN(){
        $query = $this->db->prepare("SELECT * FROM tabla_n");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $rows = count($data);
        $array = [];
        for ($i = 0; $i < $rows; $i++) {
            $tabla_n_temp = [];
            array_push($tabla_n_temp, $data[$i]["numero"]);
            array_push($tabla_n_temp, $data[$i]["tipo_viaje"]);
            array_push($array, $tabla_n_temp);
        }
        
        return $array;
    }//Fin de la funcion obtenerN.
    
    public function obtenerPriori(){
        $query = $this->db->prepare("SELECT * FROM tabla_priori");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $rows = count($data);
        $array = [];
        for ($i = 0; $i < $rows; $i++) {
            $tabla_priori_temp = [];
            array_push($tabla_priori_temp, $data[$i]["priori"]);
            array_push($tabla_priori_temp, $data[$i]["tipo_viaje"]);
            array_push($array, $tabla_priori_temp);
        }
        return $array;
    }//Fin de la funcion obtenerPriori.
            
}//Fin de la clase SitioModel.
