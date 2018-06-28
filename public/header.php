<?php
    if (session_status() != 2 ) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Turristea</title
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="Dream Travel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href="public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" >
        <link rel="stylesheet" href="public/css/font-awesome.min.css" />
        <link href="public/css/style.css" rel='stylesheet' type='text/css' media="all">
        <link rel="stylesheet" href="public/css/lightbox.css">
        <link href="//fonts.googleapis.com/css?family=Encode+Sans+Condensed:300,400,500,600,700" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    </head>
    <body>
        <div class="banner">
            <div class="top-nav">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="?controller=Principal&action=index">Inicio</a></li>
                            <?php if (!isset($_SESSION['tipoUsuario']) || (isset($_SESSION['tipoUsuario']) && strcmp($_SESSION['tipoUsuario'], 'u') === 0) ) { ?>
                                <li><a href="?controller=Principal&action=contenidoTuristico&numPagina=1">Contenido Turístico</a></li>
                                <li><a href="?controller=Principal&action=sitiosInteres&numPagina=1">Sitios interés</a></li>
                                <li><a href="?controller=Principal&action=formularioInteresesView">Formulario intereses</a></li>
                                <li><a href="?controller=Principal&action=MapaSitio">Mapa sitio</a></li>
                                <li><a href="?controller=Principal&action=creditos">Informaci&oacute;n</a></li>
                                <?php if (!isset($_SESSION['tipoUsuario'])) { ?>
                                    <li><a href="?controller=Principal&action=iniciarSesion">Iniciar Sesi&oacute;n</a></li>
                                    <li><a href="?controller=Principal&action=registrarse">Registrarse</a></li>
                                <?php } else { ?>
                                    <li><a href="?controller=Usuario&action=actualizarDatosView">Actualizar datos</a></li>
                                    <li><a href="?controller=Usuario&action=cerrarSesion">Cerrar sesi&oacute;n</a></li>
                                <?php } ?>
                            <?php } else { ?>
                                <li><a href="?controller=Administrador&action=agregarSitioTuristico">Agregar contenido</a></li>
                                <li><a href="?controller=Administrador&action=agregarAdministradorView">Agregar administrador</a></li>
                                <li><a href="?controller=Usuario&action=actualizarDatosView">Actualizar datos</a></li>
                                <li><a href="?controller=Usuario&action=cerrarSesion">Cerrar sesi&oacute;n</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="w3-agile-logo">
                    <div class=" head-wl">
                        <div class="headder-w3">
                            <h1><a href="?controller=Principal&action=index">Turristea</a></h1>
                        </div>
                        <div class=" tele">
                            <p><span  class="fa fa-phone" aria-hidden="true"></span> (+506) 25560189</p>
                            <h6>Costa Rica, Turrialba</h6>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="w3layouts-text">
                    <h2><span>Bienvenido(s) turista(s)</span></h2>
                    <div class="border"></div>
                    <p>¿Tenés dudas sobre a donde viajar? Entra a Turristea y nosotros nos encargaremos de mostrarte los sitios más destacados y aledaños al cant&oacute;n de Turrialba.</p>
                </div>
            </div>
        </div>
