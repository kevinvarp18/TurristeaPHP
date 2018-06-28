<?php
include_once 'public/header.php';
?>

<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Formulario de intereses</h3>
            <div class="contact" id="contact">
                <div class="contact-form">
                    <form action="?controller=Usuario&action=criteriosFormulario" method="post">
                        <span>¿De cuanto dinero dispones?</span><br>
                        <input id="dinero" name="dinero" type="number" required=""><br><br>
                        <span>¿Tipo de viaje?</span><br>
                        <select name="tipoViaje" id="tipoViaje">
                            <option value="0">Seleccione una opción</option>
                            <option value="Cultural">Cultural</option>
                            <option value="Deporte">Deporte</option>
                            <option value="Familiar">Familiar</option>
                            <option value="Negocio">Negocio</option>
                        </select><br><br>
                        <span>¿Tipo de lugar?</span><br>
                        <select name="ubicacion" id="ubicacion">
                            <option value="0">Seleccione una opción</option>
                            <option value="Rural">Rural</option>
                            <option value="Urbano">Urbano</option>
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
