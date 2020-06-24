<?php
    if (!isset($_SESSION["login"]) && isset($_SESSION["user"]) && isset($_SESSION["cli"])) {
        echo '<script>window.location = "index.php?page=UsuarioLogin";</script>';
    }else {
        if ($_SESSION["login"] != "verificado") {
            echo '<script>window.location = "index.php?page=UsuarioLogin";</script>';
        }else{
            $cli = $_SESSION["cli"];
            $books = Controlador::selBooksControlador($cli);
        }
    }
?>
<div class="d-flex justify-content-center">
    <?php
        if ($books == null) {
            ?>
            <div class="alert alert-warning w-100"><span>Nada para mostrar</span></div>
            <?php
        }else{
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Restaurante</th>
                <th>Cliente</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Área</th>
                <th>Mesa</th>
                <th>Registro</th>
                <th>Reservación</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($books as $key => $value) {
                    $area = Controlador::selAreaBookControlador($value["idres_area"]);
                    $capacidad = Controlador::selMesaBookControlador($value["idres_area_mesa"]);
                    if ($value["status"] == 1) {
                        $estado = "En espera";
                    }elseif($value["status"] == 2){
                        $estado = "Terminada";
                    }
                    ?>
            <tr>
                <td><?=$value["res"]?></td>
                <td><?=$value["cli"].' '.$value["apellido"]?></td>
                <td><?=$value["correo"]?></td>
                <td><?=$value["telefono"]?></td>
                <td><?=$area["area"]?></td>
                <td><?='Para '.$capacidad["capacidad"].' personas'?></td>
                <td><?=$value["registro"]?></td>      
                <td><?=$value["fecha_hora"]?></td>      
                <td><div class="alert alert-info"><span><?=$estado?></span></div></td>      
                <td>
                    <?php
                        if ($value["status"] == 1  ) {
                            ?>
                    <div class="btn-group mt-1">
                        <a href="index.php?page=BookEditar&book=<?=$value["idbook"]?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                        <form action="" method="post">
                            <input type="hidden" name="book" value="<?=$value["idbook"]?>">
                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            <?php
                                $cancelarBook = new Controlador();
                                $cancelarBook -> cancelarBookControlador();
                            ?>
                        </form>
                    </div>
                            <?php
                        }else {
                            ?>
                    <div class="alert alert-warning"><span>Nada por hacer</span></div>
                            <?php
                        }
                    ?>
                </td>
            </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <?php
        }
        if (isset($_GET["selBook"])) {
            if ($_GET["selBook"] == "null") {
            ?>
        <script type="text/javascript" src="js/noBook.js"></script>
            <?php
            }
        }elseif (isset($_GET["update"])) {
            if ($_GET["update"] == "true") {
            ?>
        <script type="text/javascript" src="js/bookUpdate.js"></script>
            <?php
            }
        }elseif (isset($_GET["drop"])) {
            if ($_GET["drop"] == "true") {
            ?>
        <script type="text/javascript" src="js/dropT.js"></script>
            <?php
            }elseif ($_GET["drop"] == "false") {
            ?>
        <script type="text/javascript" src="js/dropF.js"></script>
            <?php
            }
        }
    ?>
</div>