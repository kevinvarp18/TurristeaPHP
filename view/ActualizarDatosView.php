<?php
include_once 'public/header.php';
?>

<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Actualizar datos</h3>
            <div class="contact" id="contact">
                <div class="contact-form">
                    <form action="?controller=Usuario&action=actualizarDatos" method="post">
                        <input id="email" name="email" class="email" type="email" placeholder="Correo" value="<?php echo $vars->getCorreo(); ?>" readonly><br>
                        <input id="password" name="password" type="password" placeholder="Contraseña" value="<?php echo $vars->getContrasena(); ?>" required=""><br>
                        <input id="nombre" name="nombre" type="text" placeholder="Nombre completo" value="<?php echo $vars->getNombre(); ?>" required=""><br>
                        <input id="edad" name="edad" type="number" placeholder="Edad" value="<?php echo $vars->getEdad(); ?>" required=""><br>
                        <select name="genero" id="genero">
                            <option value="N">Seleccione un género</option>
                            <option value="M">Hombre</option>
                            <option value="F">Mujer</option>
                        </select><br>
                        <input type="submit" value="Actualizar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'public/footer.php';
?>
