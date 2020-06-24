<?php
    require_once "modelo/conexion.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://kit.fontawesome.com/088ef51476.js" crossorigin="anonymous"></script>
    <style>
    /* Make the image fully responsive */
    .carousel-inner img {
        width: 100%;
        height: 100%;
    }
    </style>
    <title>Reservaciones</title>
</head>
<body>
    <div class="container-fluid border border-bottom border-2px" style="background-color: #fcaea9">
        <div class="text-center bg-red">
            <h3 style="display: inline-block; vertical-align: -webkit-baseline-middle" class="text-center py-3 text-white">Reservaciones</h3>
            <img src="img/logo.png" style="width: 200px; display: inline-block bg-none">
        </div>
        <?php
            include "vista/modulos/navBar.php";
        ?>
    </div>

    <div class="container-fluid" style="background: #ffffff">
        <div class="container py-5" style="text-align: -webkit-center">
            <?php
                $mvc = new Controlador();
                $mvc -> enlacesControlador();
            ?>
        </div>
    </div>
    <script src="vista/scripts/validaciones.js"></script>
    <script src="js/hiddenPassword.js"></script>
</body>
</html>