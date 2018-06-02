<?php
include_once 'public/header.php';
?>

<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Agregar administrador</h3>
            <div class="contact" id="contact">
                <div class="contact-form">
                    <form action="?controller=Administrador&action=agregarAdmin" method="post">
                        <input id="email" name="email" class="email" type="email" placeholder="Correo" required=""><br>
                        <input id="password" name="password" type="password" placeholder="Contraseña" required=""><br><br>
                        <input type="submit" value="Agregar" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'public/footer.php';
?>
