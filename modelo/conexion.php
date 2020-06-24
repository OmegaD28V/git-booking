<?php
class Conexion{
    public function conectar(){
        $PDO = new PDO('mysql:host=localhost:3306;dbname=reservaciones', 'cliente_reservaciones', '1234');
        return $PDO;
    }
}