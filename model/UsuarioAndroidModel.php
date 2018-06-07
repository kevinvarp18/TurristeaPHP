<?php
/**
 * Description of UsuarioAndroidModel
 *
 * @author Alfonso
 */
class UsuarioAndroidModel {
    
    private $db;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }//Fin del constructor.

    public function insertarUsuario($usuario){
        $query = $this->db->prepare("call sp_registrar_usuario('".$usuario->getCorreo().
                "','".$usuario->getContrasena()."','".$usuario->getNombre()."',".$usuario->getEdad().
                ",'".$usuario->getGenero()."')");
        $query->execute();
        $resultado = $query->rowCount();
        return $resultado;
    }//Fin de la función insertarUsuario.
    
     public function actualizarUsuario($usuario){ 
        $query = $this->db->prepare("call sp_actualizar_usuario('".$usuario->getCorreo()."','".$usuario->getContrasena()."','".$usuario->getNombre()."',".$usuario->getEdad().")");
        $query->execute();
        $resultado = $query->rowCount();
        return $resultado;
    }//Fin de la función actualizarUsuario.
    
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
            array_push($usuarioArray, $usuarioTemp);
        }/* Fin del for i, que inserta en un arreglo todos los registros de los 
        usuarios que existen en la base de datos. */
        
        return $usuarioArray;
    }/* Fin del la función obtenerTodosLosUsuarios, que retorna el arreglo con 
    todos registros de los usuarios que existen en su respectiva tabla de la  base 
    de datos. */
    
}//end class
