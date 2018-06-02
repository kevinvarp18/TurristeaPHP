<?php
include_once 'public/header.php';
?>

<div class="about" id="about">
    <div class="container">
        <div class="about-info">
            <h3>Mis favoritos</h3>
        </div>
        <?php for($i=1; $i <= 5; $i++) { ?>
            <div class="about-top-grids">
                <div class="col-md-12 about-top-grid">
                    <h4>Sitio Turístico <?php echo $i; ?></h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <a href="?controller=Principal&action=contenidoTuristico&numPagina=<?php echo $i; ?>" class="inactive">Leer más</a>
                    <br><br>
                </div>
                <div class="clearfix"> </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include_once 'public/footer.php';
?>
