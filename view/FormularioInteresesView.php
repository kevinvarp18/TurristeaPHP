<?php
include_once 'public/header.php';
?>

<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Formulario de intereses</h3>
            <div class="contact" id="contact">
                <div class="contact-form">
                    <form action="?controller=Usuario&action=formularioIntereses" method="post">
                        <span>¿De cuanto dinero dispones?</span><br>
                        <input id="dinero" name="dinero" type="number" required=""><br><br>
                        <span>¿Tipo de lugar?</span><br>
                        <select name="lugar" id="lugar">
                            <option value="0">Seleccione una opción</option>
                            <option value="U">Urbano</option>
                            <option value="M">Montañoso</option>
                        </select><br><br>
                        <span>¿Que te gustaría hacer en este momento?</span><br>
                        <select name="abc" id="abc">
                            <option value="0">Seleccione una opción</option>
                            <option value="1">Visitar un sitio o atractivo turístico</option>
                            <option value="2">Realizar una actividad turística</option>
                        </select><br><br>
                        <input type="submit" value="Guardar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'public/footer.php';
?>
