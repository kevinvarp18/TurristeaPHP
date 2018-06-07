<?php

class AndroidController {

    private $view;

    public function __construct() {
        $this->view = new View();
    }

//fin del constructor.

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
    }

//Fin de la función index.

    public function obtenerRecomendaciones() {
        include 'EuclidesAlgoritmo.php';
        require 'model/SitioModel.php';
        require 'public/domain/Sitio.php';
        $modelo = new SitioModel();
        $precio = $_GET['precio'];
        $tipo_viaje = $_GET['tipo_viaje'];
        $consulta = $modelo->obtenerTodosLosSitios();
        $registros = [];
        $arrayPrecio = array(
            '100-1000' => 1,
            '1001-5000' => 2,
            '5001-15000' => 3,
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
                'descripcion' => utf8_encode($consulta[$i]->getDescripcion()),
                'latitud' => utf8_encode($consulta[$i]->getLatitud()),
                'longitud' => utf8_encode($consulta[$i]->getLongitud()),
                'clase' => utf8_encode($consulta[$i]->getUbicacion()));
            array_push($registros, $sitioActual);
        }

        $vectorA = array('precio' => $precio, 'tipo_viaje' => $tipo_viaje);
        $variables = ['precio', 'tipo_viaje'];

        $resultado = euclides($vectorA, $registros, $variables);
        $final;
        echo json_encode(( array("sitios"=>$resultado)));
    }

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
        }
    }

//Fin de la función registrarse.
}
