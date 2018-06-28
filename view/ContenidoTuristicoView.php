<?php include_once 'public/header.php'; ?>

<div class="about" id="about">
    <div class="container">
        <div class="about-info">
            <h3>Contenido Turístico</h3>
        </div>
        <div class="about-top-grids">
            <div class="col-md-12 about-top-grid">
                <h4><?php echo $vars['sitio']->getTitulo(); ?></h4>
                <p><?php echo $vars['sitio']->getDescripcion(); ?></p>
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
                <img src="<?php echo $vars['sitio']->getImagen(); ?>" alt=""><br><br>
                <iframe width="640" height="480" src="<?php echo $vars['sitio']->getVideo(); ?>"></iframe>
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
    <span>Página <?php echo $vars['numPagina']; ?> de <?php echo $vars['numPagina'] + 5; ?></span><br>
    <?php
        for ($i = $vars['numPagina'] - 1; $i <= ($vars['numPagina'] + 5); $i++) {
            if ($vars['numPagina'] === $i) {
    ?>
                <span class="current"><?php echo $i; ?></span>
    <?php   } else if ($i > 0) { ?>
                <a href="?controller=Principal&action=contenidoTuristico&numPagina=<?php echo $i; ?>" class="inactive"><?php echo $i; ?></a>
    <?php
            }//Fin del if.
        }//Fin del for.
    ?>
</div>

<script src="public/js/mapaJS.js" type="text/javascript"></script>
<script>
    latitudSitio = <?php echo $vars['sitio']->getLatitud(); ?>;
    longitudSitio = <?php echo $vars['sitio']->getLongitud(); ?>;
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1JuYmoq83Om5mLz0qyg_k1viClteC2NU&callback=initMap"></script>

<?php include_once 'public/footer.php'; ?>
