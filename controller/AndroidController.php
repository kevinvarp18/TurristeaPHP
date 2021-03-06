<?php

class AndroidController {

    private $view;

    public function __construct() {
        $this->view = new View();
    }//Fin del constructor.

    public function login() {
        require 'model/UsuarioAndroidModel.php';
        require 'public/domain/Usuario.php';
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents("php://input"), true);
        $usuarioModel = new UsuarioAndroidModel();
        $usuarios = $usuarioModel->obtenerTodosLosUsuarios();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($body['email']);
        $usuarioActual->setContrasena($body['password']);
        $bandera = 0;
        $tipoUsuario = '';
        foreach ($usuarios as $usuario) {
            if (strcmp($usuario->getCorreo(), $usuarioActual->getCorreo()) === 0) {
                if (strcmp($usuario->getContrasena(), $usuarioActual->getContrasena()) === 0) {
                    $bandera = 1;
                    break;
                }//Fin del if que verifica si las contraseñas son iguales.
            }//Fin del if que verifica si los correos son iguales.
        }//Fin del foreach.

        if ($bandera === 1) {
            $respuesta = array("resultado" => "correcto");
            echo json_encode($respuesta);
        } else {
            $respuesta = array("resultado" => "incorrecto");
            echo json_encode($respuesta);
        }//else-if
    }//Fin de la función login que realiza la autenticación del usuario.

    public function obtenerRecomendaciones() {
        include 'public/useful/EuclidesAlgoritmo.php';
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

    public function registrarse() {
        require 'model/UsuarioAndroidModel.php';
        require 'public/domain/Usuario.php';
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents("php://input"), true);
        $usuarioModel = new UsuarioAndroidModel();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($body["email"]);
        $usuarioActual->setContrasena($body["password"]);
        $usuarioActual->setNombre($body["nombre"]);
        $usuarioActual->setEdad($body["edad"]);
        $usuarioActual->setGenero($body["genero"]);
        $resultado = $usuarioModel->insertarUsuario($usuarioActual);
        if ($resultado === 1) {
            $respuesta = array("resultado" => "guardado");
            echo json_encode($respuesta);
        } else {
            $respuesta = array("resultado" => "Error(121)");
            echo json_encode($respuesta);
        }//Fin del if que verifica si el usuario se pudo registrar exitosamente o no.
    }//Fin de la función registrarse, que intenta agregar un nuevo usuario en la base de datos, en caso de que este no exista.
    
    public function actualizarDatos(){
        require 'model/UsuarioAndroidModel.php';
        require 'public/domain/Usuario.php';
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents("php://input"), true);
        $usuarioModel = new UsuarioAndroidModel();
        $usuarioActual = new Usuario();
        $usuarioActual->setCorreo($body['email']);
        $usuarioActual->setContrasena($body['password']);
        $usuarioActual->setNombre($body['nombre']);
        $usuarioActual->setTipoUsuario('u');
        $usuarioActual->setEdad($body['edad']);
        $resultado = $usuarioModel->actualizarUsuario($usuarioActual);
        
        if($resultado === 1)
            echo json_encode(array("resultado"=>1));
        else
            echo json_encode(array("resultado"=>$body));

    }//Fin de la función actualizarDatos, que actualiza los datos de un usuario específico.

}//Fin de la clase AndroidController.
