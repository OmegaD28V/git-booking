<?php
class Paginas{
    public function enlacesModelo($enlaces){
        if (
            $enlaces == "Inicio" || $enlaces == "BookDatos" || $enlaces == "UsuarioRegistro" || 
            $enlaces == "UsuarioLogin" || $enlaces == "Book" || 
            $enlaces == "Salir" || $enlaces == "Books"|| $enlaces == "BookEditar") {
            $modulo = "vista/modulos/".$enlaces.".php";
        }elseif ($enlaces == "index") {
            $modulo = "vista/modulos/Inicio.php";
        }else{
            $modulo = "vista/modulos/error404.php";
        }
        return $modulo;
    }
}