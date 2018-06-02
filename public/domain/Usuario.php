<?php

    class Usuario {

        // ****************************** ATRIBUTOS ******************************

        private $correoElectronico;
        private $contrasena;
        private $tipoUsuario;
        private $nombre;
        private $edad;
        private $genero;

        // ***************************** CONSTRUCTOR *****************************

        function Usuario() {
            $this->correoElectronico = '';
            $this->contrasena = '';
            $this->tipoUsuario = '';
            $this->nombreCompleto = '';
            $this->edad = 0;
            $this->genero = '';
        }//Fin del constructor.

        // ************************** METODOS ACCESORES *************************

        public function getCorreo() {
            return $this->correoElectronico;
        }

        public function getContrasena(){
            return $this->contrasena;
        }

        public function getTipoUsuario() {
            return $this->tipoUsuario;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getEdad() {
            return $this->edad;
        }

        public function getGenero() {
            return $this->genero;
        }

        function setCorreo($correo) {
            $this->correoElectronico = $correo;
        }

        public function setContrasena($contrasena){
            $this->contrasena = $contrasena;
        }
        
        public function setTipoUsuario($tipoUsuario) {
            $this->tipoUsuario = $tipoUsuario;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function setEdad($edad) {
            $this->edad = $edad;
        }

        public function setGenero($genero) {
            $this->genero = $genero;
        }

        // *************************** OTRAS FUNCIONES **************************

        function getJsonData() {
            $var = get_object_vars($this);
            foreach ($var as &$value) {
                if (is_object($value) && method_exists($value, 'getJsonData')) {
                    $value = $value->getJsonData();
                }
            }
            return $var;
        }//Fin del método getJsonData.

    }//Fin de la clase Usuario.

?>