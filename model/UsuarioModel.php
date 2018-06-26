<?php

class UsuarioModel {

    private $db;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }//Fin del constructor.

    public function obtenerTodosLosUsuarios() {
        $query = $this->db->prepare("SELECT * FROM usuario");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $rows = count($data);
        $usuarioArray = [];
        for ($i = 0; $i < $rows; $i++) {
            $usuarioTemp = new Usuario();
            $usuarioTemp->setCorreo($data[$i]["email"]);
            $usuarioTemp->setContrasena($data[$i]["password"]);
            $usuarioTemp->setTipoUsuario($data[$i]["tipoUsuario"]);
            array_push($usuarioArray, $usuarioTemp);
        }/* Fin del for i, que inserta en un arreglo todos los registros de los 
        usuarios que existen en la base de datos. */
        
        return $usuarioArray;
    }/* Fin del la función obtenerTodosLosUsuarios, que retorna el arreglo con 
    todos registros de los usuarios que existen en su respectiva tabla de la  base 
    de datos. */
    
    public function insertarUsuario($usuario){
        $query = $this->db->prepare("INSERT INTO usuario(email, nombre, tipoUsuario, edad, genero, password) VALUES (?, ?, ?, ?, ?, ?)");
        $query->execute(array($usuario->getCorreo(), $usuario->getNombre(), 'u', $usuario->getEdad(), $usuario->getGenero(), $usuario->getContrasena()));
        $resultado = $query->rowCount();
        return $resultado;
    }//Fin de la función insertarUsuario.
    
    public function obtenerDatosUsuario($correo){
        $query = $this->db->prepare("SELECT * FROM usuario WHERE email = ?");
        $query->execute(array($correo));
        $data = $query->fetch();
        $query->closeCursor();
        $usuario = new Usuario();
        $usuario->setCorreo($data["email"]);
        $usuario->setContrasena($data["password"]);
        $usuario->setNombre($data["nombre"]);
        $usuario->setEdad($data["edad"]);
        $usuario->setGenero($data["genero"]);
        return $usuario;
    }//Fin de la función obtenerDatosUsuario.
    
    public function actualizarUsuario($usuario){
        $query = $this->db->prepare("UPDATE usuario SET nombre = ?, edad = ?, genero = ?, password = ? WHERE email = ?");
        $query->execute(array($usuario->getNombre(), $usuario->getEdad(), $usuario->getGenero(), $usuario->getContrasena(),$usuario->getCorreo()));
        $resultado = $query->rowCount();
        return $resultado;
    }//Fin de la función actualizarUsuario.
    
    public function insertarIntereses($idUsuario, $rangoPrecio, $tipoLugar, $tipoViaje){
        $query = $this->db->prepare("INSERT INTO interesesusuario (idCliente, precio, ubicacion, tipo_viaje) VALUES (?, ?, ?, ?)");
        $query->execute(array($idUsuario, $rangoPrecio, $tipoLugar, $tipoViaje));
        $resultado = $query->rowCount();
        return $resultado;
    }//Fin de la función actualizarUsuario.
    
}//Fin de la clase UsuarioModel.
