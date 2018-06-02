<?php
include_once 'public/header.php';
?>

<div id="gallery" class="gallery">
    <div class="container">
        <div class="gallery-info">
            <h3 class="title">Editar sitio turístico</h3>
            <div class="contact" id="contact">
                <div class="contact-form">
                    <form action="?controller=Administrador&action=actualizarSitio" method="post">
                        <input id="nombre" name="nombre" type="text" value="<?php echo 'Sitio turístico '.$vars; ?>" required><br>
                        <textarea id="descripcion" name="descripcion" required>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</textarea><br><br>
                        <input type="submit" value="Actualizar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'public/footer.php';
?>
