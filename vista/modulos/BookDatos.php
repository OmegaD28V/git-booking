<?php
    if (!isset($_SESSION["login"]) && isset($_SESSION["user"]) && isset($_SESSION["cli"])) {
        echo '<script>window.location = "index.php?page=UsuarioLogin";</script>';
    }else {
        if ($_SESSION["login"] != "verificado") {
            echo '<script>window.location = "index.php?page=UsuarioLogin";</script>';
        }else{
            if (isset($_GET["res"])) {
                $res = $_GET["res"];
                $cli = $_SESSION["cli"];
                $restaurante = Controlador::selResControlador($res);
                $usuario = Controlador::selClienteControlador($cli);
                $areas = Controlador::selAreasControlador($res);
                if ($restaurante == null) {
                    echo '<script>window.location = "index.php?page=Inicio&selRes=null";</script>';    
                }
            }else{
                echo '<script>window.location = "index.php?page=Inicio&selRes=null";</script>';
            }
        }
    }
?>
<div class="d-flex justify-content-center">
<form class="p-5 border border-dark rounded-sm shadow" method="post">
    <h3 style="margin: -10px 0 0 0; text-align: center">Datos de reservación:</h3>
    <div style="height: 1px;width: 100%;background-color: black;margin: 10px 0px 40px 0px;"></div>
        <div class="form-group text-justify">
            <label for="res">Reservación en:</label>
            <input style="min-width: 400px;" type="text" class="form-control" name="res" id="res" value="<?=$restaurante["nombre"]?>" disabled>
            <input type="hidden" name="idres" id="idres" value="<?=$res?>">
        </div>
        
        <div class="form-group text-justify">
            <label for="name">A nombre de:</label>
            <input style="min-width: 400px;" type="text" class="form-control" name="name" id="name" value="<?=$usuario["nombre"]?> <?=$usuario["apellido"]?>" disabled>
            <input type="hidden" name="idcliente" id="idcliente" value="<?=$cli?>">
        </div>
        <div class="form-group text-justify">
            <label for="lastname">Correo Electrónico:</label>
            <input style="min-width: 400px;" type="email" class="form-control" name="lastname" id="lastname" value="<?=$usuario["correo"]?>" disabled>
        </div>
        <div class="form-group text-justify">
            <label for="phone">Teléfono:</label>
            <input style="min-width: 400px;" type="tel" class="form-control" name="phone" id="phone" value="<?=$usuario["telefono"]?>" disabled>
        </div>
        
        <div class="form-group text-justify">
            <label for="area">Área:</label>
            <select class="form-control" id="area" name="area" required>
                <option selected value="">Seleccionar área</option>
                <?php
                    foreach ($areas as $key => $value) {
                        ?>
                <option id="valor-area" value="<?=$value["idres_area"]?>"><?=$value["area"]?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group text-justify">
            <label for="mesa">Mesa:</label>
            <select class="form-control" id="mesa" name="mesa" required>
                <option selected value="">Elija un área</option>
                
            </select>
        </div>
        <div class="form-group text-justify">
            <div>
                <label style="display: inline-block; min-width: 200px" for="date">Fecha:</label>
                <label style="display: inline-block; min-width: 200px" for="time">Hora:</label>
            </div>
            <div>
            <input style="display: inline-block; max-width: 200px;" type="date" class="form-control" name="date" id="date" required>
            <input type="hidden" id="datetime" name="datetime">
            <input type="hidden" id="abierto" name="abierto" value="<?=$restaurante["abierto"]?>">
            <input type="hidden" id="cerrado" name="cerrado" value="<?=$restaurante["cerrado"]?>">
            <div id="div-time" style="display: inline-block; min-width: 200px">
            </div>
            </div>
        </div>
        
        <div style="justify-content: flex-end" class="input-group">
            <button style="" type="submit" class="btn btn-primary w-100 mt-2">Reservar</button>
            <?php
                $registro = Controlador::reservarControlador();
            ?>
        </div>
        
        <?php
            if (isset($_GET["step1"])) {
                if ($_GET["step1"] == "true") {
                    ?>
                    <script type="text/javascript" src="js/step1T.js"></script>
                    <?php
                }elseif ($_GET["step1"] == "false") {
                    ?>
                    <script type="text/javascript" src="js/step1F.js"></script>
                    <?php
                }
            }elseif (isset($_GET["step2"])) {
                if ($_GET["step2"] == "false") {
                    ?>
                    <script type="text/javascript" src="js/step2F.js"></script>
                    <?php
                }
            }
        ?>
    </form>
</div>