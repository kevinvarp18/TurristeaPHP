<?php

class Sitio {

    private $id;
    private $precio;
    private $ubicacion;
    private $imagen;
    private $video;
    private $latitud;
    private $longitud;
    private $tipo_de_viaje;
    private $descripcion;
    private $titulo;

    function Sitio() {
        $this->id = 0;
        $this->precio = 0;
        $this->ubicacion = "";
        $this->latitud = 0;
        $this->longitud = 0;
        $this->tipo_de_viaje = "";
        $this->descripcion = "";
        $this->titulo = "";
        $this->imagen = "";
        $this->video = "";
    }

    function getId() {
        return $this->id;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
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

    function getVideo() {
        return $this->video;
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

    function setVideo($video) {
        $this->video = $video;
    }

    function setLongitud($longitud) {
        $this->longitud = $longitud;
    }

}//Fin de la clase Sitio.
