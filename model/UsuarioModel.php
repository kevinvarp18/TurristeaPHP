<?php

class UsuarioModel {

    private $db;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }//Fin del constructor.

    public function obtenerTodosLosUsuarios() {
        $query = $this->db->prepare("SELECT * FROM tbUsuario");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $rows = count($data);
        $usuarioArray = [];

        for ($i = 0; $i < $rows; $i++) {
            $usuarioTemp = new Usuario();
            $usuarioTemp->setCorreo($data[$i]["TC_Correo"]);
            $usuarioTemp->setContrasena($data[$i]["TC_Contrasena"]);
            $usuarioTemp->setTipoUsuario($data[$i]["TC_TipoUsuario"]);

            array_push($usuarioArray, $usuarioTemp);
        }/* Fin del for i, que inserta en un arreglo todos los registros de los 
        usuarios que existen en la base de datos. */
        
        return $usuarioArray;
    }/* Fin del la función obtenerTodosLosUsuarios, que retorna el arreglo con 
    todos registros de los usuarios que existen en su respectiva tabla de la  base 
    de datos. */
    
    public function insertarUsuario($usuario){
        $query = $this->db->prepare("call sp_registrar_usuario('".$usuario->getCorreo()."','".$usuario->getContrasena()."','".$usuario->getNombre()."',".$usuario->getEdad().",'".$usuario->getGenero()."')");
        $query->execute();
        $resultado = $query->rowCount();
        return $resultado;
    }//Fin de la función insertarUsuario.
    
    public function obtenerDatosUsuario($correo){
        $query = $this->db->prepare("SELECT * FROM tbUsuario WHERE TC_Correo = ?");
        $query->execute(array($correo));
        $data = $query->fetch();
        $query->closeCursor();
        
        $usuario = new Usuario();
        $usuario->setCorreo($data["TC_Correo"]);
        $usuario->setContrasena($data["TC_Contrasena"]);
        $usuario->setNombre($data["TC_NombreCompleto"]);
        $usuario->setEdad($data["TN_Edad"]);
        $usuario->setGenero($data["TC_Genero"]);
        
        return $usuario;
    }//Fin de la función obtenerDatosUsuario.
    
    public function actualizarUsuario($usuario){
        $query = $this->db->prepare("call sp_actualizar_usuario('".$usuario->getCorreo()."','".$usuario->getContrasena()."','".$usuario->getTipoUsuario()."','".$usuario->getNombre()."',".$usuario->getEdad().",'".$usuario->getGenero()."')");
        $query->execute();
        $resultado = $query->rowCount();
        return $resultado;
    }//Fin de la función actualizarUsuario.
    
}//Fin de la clase UsuarioModel.
