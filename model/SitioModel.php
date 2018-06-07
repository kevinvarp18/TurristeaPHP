<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SitioModel
 *
 * @author Alfonso
 */
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
            array_push($sitiosArray, $sitio);
        }/* Fin del for i, que inserta en un arreglo todos los registros de los 
        usuarios que existen en la base de datos. */
        
        return $sitiosArray;
    }/* Fin del la función obtenerTodosLosUsuarios, que retorna el arreglo con 
    todos registros de los usuarios que existen en su respectiva tabla de la  base 
    de datos. */
}
