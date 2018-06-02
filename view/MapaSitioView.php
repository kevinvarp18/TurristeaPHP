<?php
include_once 'public/header.php';
?>

<div class="about" id="about">
    <div class="container">
        <div class="about-info">
            <h3>Mapa del Sitio</h3>
        </div>
        <div class="about-top-grids">
            <div class="col-md-12 about-top-grid">
                <p>A continuación podrá observar el mapa del sitio donde se puede visualizar de una manera estructurada como está compuesta la página, un grafo cuyos nodos representan las páginas y al hacer click en cada nodo se puede ir a esa página en particular.</p><br><br>
                <a href="?controller=Principal&action=index">Inicio</a><br>
                <?php if (!isset($_SESSION['tipoUsuario']) || (isset($_SESSION['tipoUsuario']) && strcmp($_SESSION['tipoUsuario'], 'u') === 0)) { ?>
                    <a href="?controller=Principal&action=index">Contenido Turístico</a><br>
                    <?php for($i = 1; $i <= 5; $i++){ ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?controller=Principal&action=contenidoTuristico&numPagina=<?php echo $i; ?>">Sitio turístico <?php echo $i; ?></a><br>
                    <?php } ?>
                    <a href="?controller=Principal&action=index">Sitios de interés</a><br>
                    <?php for($i = 1; $i <= 5; $i++){ ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?controller=Principal&action=sitiosInteres&numPagina=<?php echo $i; ?>">Sitio de interés <?php echo $i; ?></a><br>
                    <?php } ?>
                    <a href="?controller=Principal&action=formularioInteresesView">Formulario de interés</a><br>
                    <a href="?controller=Principal&action=creditos">Información</a><br>
                    <a href="?controller=Principal&action=calificanos">Opinión</a><br>
                    <?php if (!isset($_SESSION['tipoUsuario'])) { ?>
                        <a href="?controller=Principal&action=iniciarSesion">Iniciar sesión</a><br>
                        <a href="?controller=Principal&action=registrarse">Registrarse</a><br>
                    <?php } else { ?>
                        <a href="?controller=Usuario&action=misFavoritos">Favoritos</a><br>
                        <a href="?controller=Usuario&action=actualizarDatosView">Actualizar datos</a><br>
                        <a href="?controller=Usuario&action=cerrarSesion">Cerrar sesi&oacute;n</a><br>
                    <?php } ?>
                <?php } else { ?>
                    <a href="?controller=Administrador&action=administrarContenido">Editar contenido</a><br>
                    <a href="?controller=Administrador&action=agregarAdministradorView">Agregar administrador</a><br>
                    <a href="?controller=Usuario&action=actualizarDatosView">Actualizar datos</a><br>
                    <a href="?controller=Usuario&action=cerrarSesion">Cerrar sesi&oacute;n</a><br>
                <?php } ?>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div>
    <center>
        <img src="public/images/diagrama.jpeg" width="70%" height="70%">
    </center>
</div><br><br>


<?php
include_once 'public/footer.php';
?>
