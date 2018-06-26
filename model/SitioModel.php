<?php

class SitioModel {
    private $db;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }//Fin del constructor.

    public function obtenerTodosLosSitios() {
        
        $query = $this->db->prepare("SELECT * FROM sitios;");
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
}//Fin de la clase SitioModel.
