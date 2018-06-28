<?php include_once 'public/header.php'; ?>

<div class="about" id="about">
    <div class="container">
        <div class="about-info">
            <h3>Contenido Turístico</h3>
        </div>
        <div class="about-top-grids">
            <div class="col-md-12 about-top-grid">
                <h4><?php echo $vars['sitio']['titulo']; ?></h4>
                <p><?php echo $vars['sitio']['descripcion']; ?></p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Observa el lugar</h3>
            <center>
                <img src="<?php echo $vars['sitio']['imagen']; ?>" alt=""><br><br>
                <iframe width="640" height="480" src="<?php echo $vars['sitio']['video']; ?>"></iframe>
            </center>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<br><br><br>
<div class="gallery-info">
    <h3 class="title">¿Dónde encontrarlo?</h3>
    <center>
        <div id="map" style="width:640px;height:480px;margin-top:5px;margin-left:1px;"></div>
    </center>
</div>
<div class="navegacion">
    <span>Página <?php echo $vars['numPagina']; ?> de 5</span><br>
    <?php
        for ($i = 1; $i <= 5; $i++) {
            if ($vars['numPagina'] === $i) {
    ?>
                <span class="current"><?php echo $i; ?></span>
    <?php   } else { ?>
                <a href="?controller=Principal&action=sitiosInteres&numPagina=<?php echo $i; ?>" class="inactive"><?php echo $i; ?></a>
   <?php    }//Fin del if.
        }//Fin del for.
    ?>
</div>

<script src="public/js/mapaJS.js" type="text/javascript"></script>
<script>
    latitudSitio = <?php echo $vars['sitio']['latitud']; ?>;
    longitudSitio = <?php echo $vars['sitio']['longitud']; ?>;
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1JuYmoq83Om5mLz0qyg_k1viClteC2NU&callback=initMap"></script>

<?php include_once 'public/footer.php'; ?>
