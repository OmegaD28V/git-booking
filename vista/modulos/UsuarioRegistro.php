<div class="d-flex justify-content-center">
    <form class="p-5 border border-dark rounded-sm shadow" method="post">
    <h3 style="margin: -10px 0 0 0; text-align: center">Crear cuenta</h3>
    <div style="height: 1px;width: 100%;background-color: black;margin: 10px 0px 40px 0px;"></div>
    <div class="alert alert-info"><span>Crea una cuenta para poder reservar, es fácil y gratuita</span></div>
        <div class="form-group text-justify">
            <label for="name">Nombre</label>
            <input style="min-width: 400px;" type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group text-justify">
            <label for="lastname">Apellido</label>
            <input style="min-width: 400px;" type="text" class="form-control" name="lastname" id="lastname" required>
        </div>
        <div class="form-group text-justify">
            <label for="email">Correo Electrónico</label>
            <input style="min-width: 400px;" type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group text-justify">
            <label for="phone">Teléfono</label>
            <input style="min-width: 400px;" type="tel" class="form-control" name="phone" id="phone" required>
        </div>
        <div class="form-group text-justify">
            <label style="display: block" for="password">Contraseña</label>
            <input style="min-width: 200px; max-width: 310px; display: inline-block" type="password" class="form-control" name="password" id="password" required>
            <label style="display: inline-block; margin-bottom: 5px" for="check-password" class="btn btn-outline-info bg-none" id="btn-password">Mostrar</label>
            <input type="checkbox" class="d-none" name="check-password" id="check-password" onChange="hiddenPassword()">
        </div>
        <div class="form-group text-justify">
            <label for="repassword">Repetir contraseña</label>
            <input style="min-width: 200px;" type="password" class="form-control" name="repassword" id="repassword" required>
        </div>
        <div style="justify-content: flex-end" class="input-group">
            <button style="" type="submit" class="btn btn-success w-100 mt-2">Registrarse</button>
        </div>
        <div style="justify-content: flex-end;" class="input-group">
            <a href="index.php?page=UsuarioLogin" class="btn btn-outline-primary w-100 mt-2">Ya estoy registrad@</a>
        </div>
        
        <?php
            $registro = Controlador::regClienteControlador();
            if (isset($_GET["step0"])) {
                if ($_GET["step0"] == "true") {
                    ?>
                    <script type="text/javascript" src="js/step0T.js"></script>
                    <?php
                }elseif ($_GET["step0"] == "false") {
                    ?>
                    <script type="text/javascript" src="js/step0F.js"></script>
                    <?php
                }
            }
        ?>
    </form>
</div>