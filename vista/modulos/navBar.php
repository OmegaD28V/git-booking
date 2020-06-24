<?php
  $usuario = "Acceder";
  $linkUsuario = "index.php?page=UsuarioLogin";
  if (isset($_SESSION["login"]) && isset($_SESSION["user"])) {
    if ($_SESSION["login"] == "verificado") {
      $usuario = $_SESSION["user"];
    }
  }
?>
<nav class="container">

  <!-- Links -->
    <ul class="nav nav-justified py-2 nav-pills">
    <?php
        if (isset($_GET["page"])) {
            if ($_GET["page"] == "Inicio" || $_GET["page"] == "BookDatos") {
                ?>
        <li class="nav-item">
            <a class="nav-link active" href="index.php?page=Inicio">Inicio</a>
            <?php
                if (isset($_SESSION["cli"])) {
                    ?>
            <input class="d-none" id="cli-nav" value="<?=$_SESSION["cli"]?>"></input>
                    <?php                    
                }
            ?>
        </li>
                <?php
            }else{
                ?>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=Inicio">Inicio</a>
            <?php
                if (isset($_SESSION["cli"])) {
                    ?>
            <input class="d-none" id="cli-nav" value="<?=$_SESSION["cli"]?>"></input>
                    <?php                    
                }
            ?>
        </li>
                <?php
            }

            if($_GET["page"] == "Books"){
                ?>
        <li class="nav-item">
            <a class="nav-link active" href="index.php?page=Books">Mis reservaciones</a>
        </li>
                <?php
            }else {
                ?>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=Books">Mis reservaciones</a>
        </li>
                <?php 
            }
            if ($usuario == "Acceder") {
                ?>
            <li class="nav-item">
                <a class="nav-link" href="<?=$linkUsuario?>"><?=$usuario?></a>
            </li>
                <?php
            }else {
                ?>
            <li class="nav-item">
                <button type="button" class="btn btn-outline-primary dropdown-toggle w-75" data-toggle="dropdown"><?=$usuario?></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="index.php?page=Inicio">Reservar ahora</a>
                    <a class="dropdown-item" href="index.php?page=Books">Mis reservaciones</a>
                    <a class="dropdown-item" href="index.php?page=Salir">Salir</a>
                </div>
            </li>
                    <?php
            }
        }else {
            ?>
        <li class="nav-item">
            <a class="nav-link active" href="index.php?page=Inicio">Inicio</a>
            <?php
                if (isset($_SESSION["cli"])) {
                    ?>
            <input class="d-none" id="cli-nav" value="<?=$_SESSION["cli"]?>"></input>
                    <?php                    
                }
            ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=Books">Mis reservaciones</a>
        </li>

        <?php
        if ($usuario == "Acceder") {
            ?>
        <li class="nav-item">
            <a class="nav-link" href="<?=$linkUsuario?>"><?=$usuario?></a>
        </li>
            <?php
        }else {
            ?>
        <li class="nav-item">
            <button type="button" class="btn btn-outline-primary dropdown-toggle w-75" data-toggle="dropdown"><?=$usuario?></button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="index.php?page=Inicio">Reservar ahora</a>
                <a class="dropdown-item" href="index.php?page=Books">Mis reservaciones</a>
                <a class="dropdown-item" href="index.php?page=Salir">Salir</a>
            </div>
        </li>
                <?php
            }

        }
    ?>

        

</nav>