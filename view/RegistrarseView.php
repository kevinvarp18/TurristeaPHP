<?php
include_once 'public/header.php';
?>

<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Registrarse</h3>
            <div class="contact" id="contact">
                <div class="contact-form">
                    <form action="?controller=Usuario&action=registrarse" method="post">
                        <input id="email" name="email" class="email" type="email" placeholder="Correo" required=""><br>
                        <input id="password" name="password" type="password" placeholder="Contraseña" required=""><br>
                        <input id="nombre" name="nombre" type="text" placeholder="Nombre completo" required=""><br>
                        <input id="edad" name="edad" type="number" placeholder="Edad" required=""><br>
                        <select name="genero" id="genero">
                            <option value="N">Seleccione un género</option>
                            <option value="M">Hombre</option>
                            <option value="F">Mujer</option>
                        </select><br>
                        <input type="submit" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'public/footer.php';
?>
