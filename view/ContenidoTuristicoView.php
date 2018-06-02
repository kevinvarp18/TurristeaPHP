<?php
include_once 'public/header.php';
?>

<div class="about" id="about">
    <div class="container">
        <div class="about-info">
            <h3>Contenido Turístico</h3>
        </div>
        <div class="about-top-grids">
            <div class="col-md-12 about-top-grid">
                <h4>Sitio Turístico <?php echo $vars; ?></h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Galería</h3>
            <div class="col-md-4 gallery-grids">
                <a href="images/g1.jpg" class="gallery-box" data-lightbox="example-set" data-title="">
                    <img src="public/images/g1.jpg" alt="" class="img-responsive zoom-img">
                </a>
            </div>
            <div class="col-md-4 gallery-grids">
                <a href="images/g2.jpg" class="gallery-box" data-lightbox="example-set" data-title="">
                    <img src="public/images/g2.jpg" alt="" class="img-responsive zoom-img">
                </a>
            </div>
            <div class="col-md-4 gallery-grids">
                <a href="images/g3.jpg" class="gallery-box" data-lightbox="example-set" data-title="">
                    <img src="public/images/g3.jpg" alt="" class="img-responsive zoom-img">
                </a>
            </div>

            <div class="col-md-6 gallery-grids grid-mdl">
                <a href="images/g4.jpg" class="gallery-box" data-lightbox="example-set" data-title="">
                    <img src="public/images/g4.jpg" alt="" class="img-responsive zoom-img">
                </a>
            </div>
            <div class="col-md-6 gallery-grids grid-mdl">
                <a href="images/g5.jpg" class="gallery-box" data-lightbox="example-set" data-title="">
                    <img src="public/images/g5.jpg" alt="" class="img-responsive zoom-img">
                </a>
            </div>
            <div class="clearfix"></div>
        </div><br><br>
        <div class="gallery-info">
            <h3 class="title">¿Dónde encontrarlo?</h3>
            <center>
                <div id="map" style="width:640px;height:480px;margin-top:5px;margin-left:1px;"></div>
            </center>
        </div>
    </div>
</div>
<div class="navegacion">
    <span>Página <?php echo $vars; ?> de 5</span><br>
    <?php
        for ($i = 1; $i <= 5; $i++) {
            if ($vars === $i) {
    ?>
                <span class="current"><?php echo $i; ?></span>
    <?php   } else { ?>
                <a href="?controller=Principal&action=contenidoTuristico&numPagina=<?php echo $i; ?>" class="inactive"><?php echo $i; ?></a>
   <?php    }//Fin del if.
        }//Fin del for.
    ?>
</div>

<script src="public/js/mapaJS.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1JuYmoq83Om5mLz0qyg_k1viClteC2NU&callback=initMap"></script>

<?php
include_once 'public/footer.php';
?>
