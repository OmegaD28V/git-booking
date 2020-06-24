<!-- <div class="container py-5"> -->
    <div class="d-flex justify-content-center">
        <form class="p-5 border border-dark rounded-sm shadow" method="post">
        <h3 style="margin: -10px 0 0 0; text-align: center">Iniciar Sesión</h3>
        <div style="height: 1px;width: 100%;background-color: black;margin: 10px 0px 40px 0px;"></div>
        <div class="alert alert-info"><span>Inicie sesión para hacer una reservación</span></div>
            <div class="form-group text-justify">
                <label for="email">Correo Electrónico</label>
                <input style="min-width: 400px;" type="email" class="form-control" name="email" id="correo" required>
            </div>
            <div class="form-group text-justify">
                <label style="display: block" for="password2">Contraseña</label>
                <input style="min-width: 400px; max-width: 310px; display: inline-block" type="password" class="form-control" name="password" id="password2" required>
                <label style="display: inline-block; margin-bottom: 5px" for="check-password2" class="btn btn-outline-info bg-none" id="btn-password2">Mostrar</label>
                <input type="checkbox" class="d-none" name="check-password2" id="check-password2" onChange="hiddenPassword2()">
            </div>
            <div style="justify-content: flex-end" class="input-group">
                <button style="" type="submit" class="btn btn-success w-100 mt-2">Entrar</button>
                <?php
                    $registro = Controlador::entrarClienteControlador(); 
                ?>
            </div>
            <div style="justify-content: flex-end" class="input-group">
                <a href="index.php?page=UsuarioRegistro" class="btn btn-outline-primary w-100 mt-2">No estoy registrad@</a>
            </div>
            
            <?php
                if (isset($_GET["step0"])) {
                    if ($_GET["step0"] == "false") {
                        ?>
                        <script type="text/javascript" src="js/step0F.js"></script>
                        <?php
                    }
                }if (isset($_GET["step0"])) {
                    if ($_GET["step0"] == "true") {
                        ?>
                        <script type="text/javascript" src="js/step0T.js"></script>
                        <?php
                    }
                }elseif (isset($_GET["step1"])) {
                    if ($_GET["step1"] == "false") {
                        ?>
                        <script type="text/javascript" src="js/step1F.js"></script>
                        <?php
                    }
                }elseif (isset($_GET["exit"])) {
                    if ($_GET["exit"] == "true") {
                        ?>
                        <script type="text/javascript" src="js/exit.js"></script>
                        <?php
                    }
                }
            ?>
        </form>
    </div>  
<!-- </div> -->