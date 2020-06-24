<?php
class Controlador{
    #Llamada a la plantilla
    public function pagina(){
        include "vista/plantilla.php";
    }

    #Enlaces
    public function enlacesControlador(){
        if (isset($_GET['page'])) {
            $enlaces = $_GET['page'];
        }else{
            $enlaces = "index";
        }

        $respuesta = Paginas::enlacesModelo($enlaces);
        include $respuesta;
    }

    #Registrar petición de cliente.
    static public function regClienteControlador(){
        if (isset($_POST["name"])) {
            $tabla = "cliente";
            $datos = array(
                "nombre" => $_POST["name"], 
                "apellido" => $_POST["lastname"], 
                "correo" => $_POST["email"], 
                "tel" => $_POST["phone"], 
                "passwd" => $_POST["password"], 
                "repasswd" => $_POST["repassword"]
            );
            if ($datos["passwd"] != $datos["repasswd"]) {
                echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location = "index.php?page=UsuarioRegistro&step0=false";
                </script>'; 
            }else {
                $respuesta = Modelo::regClienteModelo($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "index.php?page=UsuarioLogin&step0=true";
                        </script>';
                }else {
                    echo '<script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "index.php?page=UsuarioRegistro&step0=false";
                        </script>';
                }   
            }
        }
    }

    #Seleccionar cliente.
    static public function selClienteControlador($cli){
        $tabla = "cliente";
        $respuesta = Modelo::selClienteModelo($tabla, $cli);
        return $respuesta;
    }

    #Seleccionar área del restaurante.
    static public function selAreasControlador($res){
        $tabla = "res_area";
        $respuesta = Modelo::selAreasModelo($tabla, $res);
        return $respuesta;
    }
    
    #Seleccionar área del restaurante.
    static public function selMesasControlador($area){
        $tabla = "res_area_mesa";
        $respuesta = Modelo::selMesasModelo($tabla, $area);
        return $respuesta;
    }
    
    #Seleccionar Restaurantes.
    static public function selRessControlador(){
        $tabla = "res";
        $respuesta = Modelo::selRessModelo($tabla);
        return $respuesta;
    }

    #Seleccionar Restaurante.
    static public function selResControlador($res){
        $tabla = "res";
        $respuesta = Modelo::selResModelo($tabla, $res);
        return $respuesta;
    }

    #Registrar preajuste.
    static public function regPreajusteControlador(){
        if (isset($_POST["idres"])) {
            $datosPreajuste = array(
                "idres" => $_POST["idres"], 
                "personas" => $_POST["people"], 
                "fecha_hora" => $_POST["datetime"]
            );
            echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location = "index.php?page=BookDatos";
                </script>';
            return $datosPreajuste;
        }
    }

    #Agendar reservación.
    static public function reservarControlador(){
        if (isset($_POST["idres"]) && isset($_POST["idcliente"])) {
            $tabla = "book";
            $fechaActual = date("Y-m-d H:i:s");
            $datosBook = array(
                "res" => $_POST["idres"], 
                "cli" => $_POST["idcliente"], 
                "area" => $_POST["area"], 
                "mesa" => $_POST["mesa"], 
                "fechahora" => $_POST["datetime"]
            );
            $reservacion = Modelo::reservarModelo($tabla, $datosBook);
            if ($reservacion == "booked") {
                echo '<script>
                        if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        window.location = "index.php?page=Inicio&book=true";
                    </script>';
            }else{
                echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location = "index.php?page=BookDatos&res='.$_POST["idres"].'&step2=false";
                </script>';
            }
        }
    }
    
    #Actualizar reservación.
    static public function actualizarBookControlador(){
        if (isset($_POST["idres"]) && isset($_POST["idcliente"])) {
            $tabla = "book";
            $fechaActual = date("Y-m-d H:i:s");
            $datosBook = array(
                "book" => $_POST["book"], 
                "res" => $_POST["idres"], 
                "cli" => $_POST["idcliente"], 
                "area" => $_POST["area"], 
                "mesa" => $_POST["mesa"], 
                "fechahora" => $_POST["datetime"]
            );
            $reservacion = Modelo::actualizarBookModelo($tabla, $datosBook);
            if ($reservacion == "booked") {
                echo '<script>
                        if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        window.location = "index.php?page=Books&update=true";
                    </script>';
            }else{
                echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location = "index.php?page=BookDatos&res='.$_POST["idres"].'&step2=false";
                </script>';
            }
        }
    }

    #Ver reservaciones.
    static public function selBooksControlador($cli){
        $tabla = "book";
        $respuesta = Modelo::selBooksModelo($tabla, $cli);
        return $respuesta;
    }
    
    #Seleccionar reservación.
    static public function selBookControlador($book){
        $tabla = "book";
        $respuesta = Modelo::selBookModelo($tabla, $book);
        return $respuesta;
    }
    
    #Ver fechas de reservaciones.
    static public function selDateBooksControlador($cli){
        $tabla = "book";
        $respuesta = Modelo::selDateBooksModelo($tabla, $cli);
        return $respuesta;
    }

    #Ver Área reservación.
    static public function selAreaBookControlador($book){
        $tabla = "res_area";
        $respuesta = Modelo::selAreaBookModelo($tabla, $book);
        return $respuesta;
    }
    
    #Ver Mesa reservación.
    static public function selMesaBookControlador($book){
        $tabla = "res_area_mesa";
        $respuesta = Modelo::selMesaBookModelo($tabla, $book);
        return $respuesta;
    }
    
    #Expirar reservaciones.
    static public function expirarBookControlador($book){
        $tabla = "book";
        $respuesta = Modelo::expirarBookModelo($tabla, $book);
        return $respuesta;
    }
    
    #Cancelar reservaciones.
    public function cancelarBookControlador(){
        if (isset($_POST["book"])) {
            $tabla = "book";
            $book = $_POST["book"];
            $respuesta = Modelo::cancelarBookModelo($tabla, $book);
            if ($respuesta == "ok") {
                echo '<script>
                        if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        window.location = "index.php?page=Books&drop=true";
                    </script>';
            }else {
                echo '<script>
                        if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        window.location = "index.php?page=Books&drop=false";
                    </script>';
            }
        }
    }

    #Validar correo del cliente.
    static public function validEmailUserControlador($email){
        $tabla = "cliente";
        $respuesta = Modelo::validEmailUserModelo($tabla, $email);
        return $respuesta;
    }

    #Inicio de sesión del cliente.
    static public function entrarClienteControlador(){
        if(isset($_POST["email"]) && isset($_POST["password"])){
            $tabla = "cliente";
            $email = $_POST["email"];
            $respuesta = Modelo::entrarClienteModelo($tabla, $email);
            if ($respuesta["correo"] == $email && $respuesta["passwd"] == $_POST["password"]) {
                $_SESSION["login"] = "verificado";
                $_SESSION["user"] = $respuesta["nombre"];
                $_SESSION["cli"] = $respuesta["idcliente"];
                echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location = "index.php?UsuarioLogin&step1=true";
                </script>';
            }else{
                echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location = "index.php?page=UsuarioLogin&step1=false";
                </script>';
            }
        }else{
            // echo '<script>
            //         if(window.history.replaceState){
            //             window.history.replaceState(null, null, window.location.href);
            //         }
            //         window.location = "index.php?page=UsuarioLogin&step1=false";
            //     </script>';
        }
    }

    #Subir Imagen de Restaurante.
    static public function subirImgResControlador(){
        if (isset($_POST["res"])) {
            $res = $_POST["res"];
            if (isset($_FILES["imageRes"]["tmp_name"]) && !empty($_FILES["imageRes"]["tmp_name"])) {
                list($ancho, $alto) = getimagesize($_FILES["imageRes"]["tmp_name"]);
                $rutaSave = "vista/img/res/";

                #Funciones para imagenes.
                if ($_FILES["imageRes"]["type"] == "image/jpeg") {
                    $random = mt_rand(100, 9999);
                    $rutaFile = $rutaSave.$random.".jpg";
                    $origen = imagecreatefromjpeg($_FILES["imageRes"]["tmp_name"]);
                    $destino = imagecreatetruecolor($ancho, $alto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
                    imagejpeg($destino, $rutaFile);
                }elseif ($_FILES["imageRes"]["type"] == "image/png") {
                    $random = mt_rand(100, 9999);
                    $rutaFile = $rutaSave.$random.".png";
                    $origen = imagecreatefrompng($_FILES["imageRes"]["tmp_name"]);
                    $destino = imagecreatetruecolor($ancho, $alto);
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
                    imagepng($destino, $rutaFile);
                }else{
                    return "invalid";
                }
                $tabla = "res";
                $archivo = $rutaFile;
                $respuesta = Modelo::subirImgResModelo($tabla, $archivo, $res);
                if ($respuesta == "ok") {
                    echo '<script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "index.php?page=ResImagen&res='.$res.'&upI=true";
                        </script>';
                }else {
                    echo '<script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "index.php?page=ResImagen&res='.$res.'&upI=false";
                        </script>';
                }
            }else {
            }
        }
    }
}