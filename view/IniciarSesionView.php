<?php
include_once 'public/header.php';
?>

<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Iniciar Sesión</h3>
            <div class="contact" id="contact">
                <div class="contact-form">
                    <form action="?controller=Usuario&action=login" method="post">
                        <input id="email" name="email" class="email" type="email" placeholder="Correo" required=""><br>
                        <input id="password" name="password" type="password" placeholder="Contraseña" required=""><br><br>
                        <input type="submit" value="Ingresar" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'public/footer.php';
?>
