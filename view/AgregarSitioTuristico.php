<?php
include_once 'public/header.php';
?>

<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Editar sitio turístico</h3>
            <div class="contact" id="contact">
                <div class="contact-form">
                    <form action="?controller=Sitios&action=insertarSitio" method="post">
                        <span>Nombre del sitio:</span><br>
                        <input id="titulo" name="titulo" type="text" required=""><br><br>
                        <span>Descripci&oacute;n:</span><br>
                        <textarea id="descripcion" name="descripcion" required></textarea><br><br>
                        <span>Precio:</span><br>
                        <input id="precio" name="precio" type="number" required=""><br><br>
                        <span>¿Tipo de lugar?</span><br>
                        <select name="ubicacion" id="ubicacion">
                            <option value="0">Seleccione una opción</option>
                            <option value="Rural">Rural</option>
                            <option value="Urbano">Urbano</option>
                        </select><br><br>
                        <span>Imagen:</span><br><br>
                        <center><input id="imagen" name="imagen" type="file" required=""></center><br><br>
                        <span>Link del video:</span><br>
                        <input id="video" name="video" type="text" required=""><br><br>
                        <span>Direcci&oacute; del lugar:</span><br>
                        <input id="nombreLugar" name="nombreLugar" type="text" required=""><br><br>
                        <input id="btnBuscar" type="button" value="Buscar"><br><br>
                        <span>Latitud:</span><br>
                        <input id="latitud" name="latitud" type="text" required="" readonly><br><br>
                        <span>Longitud:</span><br>
                        <input id="longitud" name="longitud" type="text" required="" readonly><br><br>
                        <input type="submit" value="Guardar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="public/js/mapaJS.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1JuYmoq83Om5mLz0qyg_k1viClteC2NU&callback=initMap"></script>

<?php
include_once 'public/footer.php';
?>
