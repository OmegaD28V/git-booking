<?php
    if (!(isset($_SESSION["login"]) && isset($_SESSION["user"]) && isset($_SESSION["cli"]))) {
        echo '<script>window.location = "index.php?page=UsuarioLogin";</script>';
    }else {
        if ($_SESSION["login"] != "verificado") {
            echo '<script>window.location = "index.php?page=UsuarioLogin";</script>';
        }else{
            $usuario = $_SESSION["user"];
        }
    }
    $restaurantes = Controlador::selRessControlador();
?>

<div class="card bg-none text-dark mb-5 mt-0">
    <h1 class="card-title">Elija su restaurante</h1>
</div>
<div id="demo" class="carousel slide" style="width: 30%" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <?php
            foreach ($restaurantes as $key => $value) {
                if ($key == 0) {
                    ?>
        <li data-target="#demo" data-slide-to="<?=$key?>" class="active"></li>
                    <?php
                }
                ?>
        <li data-target="#demo" data-slide-to="<?=$key?>" class=""></li>
                <?php
            }
        ?>
    </ul>
    
    <!-- The slideshow -->
    <div class="carousel-inner">
        <?php
            foreach ($restaurantes as $key => $value) {
                if ($key == 0) {
                    ?>
        <div class="carousel-item active">
            <a href="index.php?page=BookDatos&res=<?=$value["idres"]?>"><img style="widht: 600px; max-height: 600px" src="<?=$value["imagen"]?>" alt="<?=$value["nombre"]?>" width="600" height="600"></a>
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h4 class="card-title"><?=$value["nombre"]?></h4>
                    <p class="card-text text-justify"><?=$value["calle"]?>, <?=$value["numero"]?>, <?=$value["colonia"]?>, <?=$value["localidad"]?></p>
                    <p class="card-text text-justify">Referencia: <?=$value["referencia"]?></p>
                    <p class="card-text text-justify">De: <?=$value["dias"]?>, en horario de: <?=$value["abierto"]?> - <?=$value["cerrado"]?></p>
                </div>
            </div>
        </div>
                    <?php
                }else {
                    ?>
        <div class="carousel-item">
            <a href="index.php?page=BookDatos&res=<?=$value["idres"]?>"><img style="widht: 600px; max-height: 600px" src="<?=$value["imagen"]?>" alt="<?=$value["nombre"]?>" width="600" height="600"></a>
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h4 class="card-title"><?=$value["nombre"]?></h4>
                    <p class="card-text text-justify"><?=$value["calle"]?>, <?=$value["numero"]?>, <?=$value["colonia"]?>, <?=$value["localidad"]?></p>
                    <p class="card-text text-justify">Referencia: <?=$value["referencia"]?></p>
                    <p class="card-text text-justify">De: <?=$value["dias"]?>, en horario de: <?=$value["abierto"]?> - <?=$value["cerrado"]?></p>
                </div>
            </div>
        </div>
                    <?php
                }
            }
        ?>
    </div>
    
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

<?php
    if (isset($_GET["selRes"])) {
        if ($_GET["selRes"] == "null") {
            ?>
        <script type="text/javascript" src="js/noRes.js"></script>
            <?php
        }
    }elseif (isset($_GET["book"])) {
        if ($_GET["book"] == "true") {
            ?>
        <script type="text/javascript" src="js/booked.js"></script>
            <?php
        }
    }
?>