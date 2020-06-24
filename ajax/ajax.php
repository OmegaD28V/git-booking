<?php
    require_once "../modelo/crud.php";
    require_once "../controlador/controlador.php";

    #Clase de Ajax.
    class Ajax{
        public $validEmail;
        public $area;
        public $usuario;
        public $book;

        #Validación Email.
        public function validEmailAjax(){
            $email = $this -> validEmail;
            $respuesta = Controlador::validEmailUserControlador($email);
            echo json_encode($respuesta);
        }
        
        #Selección de área en el restaurante.
        public function selMesasAjax(){
            $area = $this -> area;
            $mesas = Controlador::selMesasControlador($area);
            $html = '';
                if ($mesas == null) {
            $html = '<option id="option" value="">Elija un área</option>';
                }else{
                    foreach ($mesas as $key => $value) {
            $html = $html.'<option value="'.$value["idres_area_mesa"].'">Capacidad: '.$value["capacidad"].' personas</option>';
                }
            }
            echo $html;
        }
        
        #Selección de fechas de las reservaciones.
        public function selDateBooksAjax(){
            $usuario = $this -> usuario;
            $respuesta = Controlador::selDateBooksControlador($usuario);
            echo json_encode($respuesta);
        }
        
        #Expirar reservaciones.
        public function expirarBookAjax(){
            $book = $this -> book;
            $respuesta = Controlador::expirarBookControlador($book);
            echo $respuesta;
        }
    }

    #Objeto de Ajax que recibe la variable post.
    if (isset($_POST["validEmail"])) {
        $objValidEmail = new Ajax();
        $objValidEmail -> validEmail = $_POST["validEmail"];
        $objValidEmail -> validEmailAjax();
    }
    
    #Objeto de Ajax que recibe la variable post.
    if (isset($_POST["area"])) {
        $objArea = new Ajax();
        $objArea -> area = $_POST["area"];
        $objArea -> selMesasAjax();
    }
    
    #Objeto de Ajax que recibe la variable post.
    if (isset($_POST["usuario"])) {
        $objUsuario = new Ajax();
        $objUsuario -> usuario = $_POST["usuario"];
        $objUsuario -> selDateBooksAjax();
    }
    
    #Objeto de Ajax que recibe la variable post.
    if (isset($_POST["book"])) {
        $objBook = new Ajax();
        $objBook -> book = $_POST["book"];
        $objBook -> expirarBookAjax();
    }
?>