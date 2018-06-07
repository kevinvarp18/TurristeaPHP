<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sitio
 *
 * @author Alfonso
 */
class Sitio {
 private $id;   
 private $precio;
 private $ubicacion;
 private $imagen;
 private $latitud;
 private $longitud;
 private $tipo_de_viaje;
 private $descripcion;
 private $titulo;

    
    function Sitio(){
        $this->id=0;
        $this->precio=0;
        $this->ubicacion="";
        $this->latitud=0;
        $this->longitud=0;
        $this->tipo_de_viaje="";
        $this->descripcion="";
        $this->titulo="";
        $this->imagen="";
    }
    
    function getId() {
        return $this->id;
    }
    
    function getPrecio() {
        return $this->precio;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }

    function getTipo_de_viaje() {
        return $this->tipo_de_viaje;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getLatitud() {
        return $this->latitud;
    }

    function getLongitud() {
        return $this->longitud;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setId($id) {
        $this->id = $id;
    }
    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function setTipo_de_viaje($tipo_de_viaje) {
        $this->tipo_de_viaje = $tipo_de_viaje;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setLatitud($latitud) {
        $this->latitud = $latitud;
    }

    function setLongitud($longitud) {
        $this->longitud = $longitud;
    }
}//end class
