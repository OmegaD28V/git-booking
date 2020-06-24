<?php
    if (isset($_GET["res"])) {
        $res = $_GET["res"];
        $restaurante = Controlador::selResControlador($res);
    }
?>

<div class="contenedor-formulario">
    <div class="multi-form">
        <h2>Imágenes</h2>

        <div class="line-form"></div>

        <div class="form-group">
            <div class="slider">
                <img class="prevImagen" src="" alt="img" loading="lazy" width="300" height="300">
            </div>
        </div>

        <div class="line-form"></div>

        <div class="form-group"></div>
            <label for=""><?=$restaurante["nombre"]?></label>
        <div>

        <div class="line-form"></div>
        
        <form class="form-group" name="subirImagen" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="imageRes">Archivo JPG o PNG</label>
                <input name="imageRes" type="file" id="imageRes" required></input>
                <input name="res" type="hidden" value="<?=$res?>" required></input>
            </div>
            
            <div class="input-group">
                <input id="btnRegistrarImagen" name="btnRegistrarImagen" type="submit" value="Subir Imagen"></input>
                <?php
                    $subirImagen = Controlador::subirImgResControlador();
                    if (isset($_GET["upI"])) {
                        if ($_GET["upI"] == "true") {
                            ?>
                            <script type="text/javascript" src="js/notImgUpload.js"></script>
                            <?php
                        }
                    }elseif (isset($_GET["upI"])) {
                        if ($_GET["upI"] == "false") {
                            ?>
                            <script type="text/javascript" src="js/notError.js"></script>
                            <?php
                        }
                    }
                ?>
            </div>
        </form>
    </div>
</div>