<?php
require_once "conexion.php";

class Modelo extends Conexion{

    #Registrar peticion de cliente.
    static public function regClienteModelo($tabla, $datos){
        $stmt = Conexion::conectar() -> prepare("
            insert into $tabla (nombre, apellido, correo, telefono, passwd) 
            values(:nombre, :apellido, :correo, :telefono, :passwd);
        ");
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt -> bindParam(":telefono", $datos["tel"], PDO::PARAM_STR);
        $stmt -> bindParam(":passwd", $datos["passwd"], PDO::PARAM_STR);
        if ($stmt -> execute()) {
            return "ok";
        }else {
            return "error";
        }
        $stmt -> close();
        $stmt = null;
    }

    #Seleccionar cliente.
    static public function selClienteModelo($tabla, $cli){
        $stmt = Conexion::conectar() -> prepare("
            select idcliente, nombre, apellido, correo, telefono from $tabla where idcliente = :idcliente and status = 1;
        ");
        $stmt -> bindParam(":idcliente", $cli, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
        $stmt = null;
    }
    
    #Seleccionar áreas del restaurante.
    static public function selAreasModelo($tabla, $res){
        $stmt = Conexion::conectar() -> prepare("
            select idres_area, area from $tabla  
            where idres = :idres and status = 1;
        ");
        $stmt -> bindParam(":idres", $res, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }
    
    #Seleccionar áreas del restaurante.
    static public function selMesasModelo($tabla, $area){
        $stmt = Conexion::conectar() -> prepare("
            select idres_area_mesa, mesa, capacidad from $tabla  
            where idres_area = :idres_area and status = 1;
        ");
        $stmt -> bindParam(":idres_area", $area, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }

    #Seleccionar Restaurantes.
    static public function selRessModelo($tabla){
        $stmt = Conexion::conectar() -> prepare("
        select r.idres, r.nombre, r.abierto, r.cerrado, r.dias, r.imagen, 
        r_d.estado, r_d.localidad, r_d.colonia, r_d.calle, r_d.numero, r_d.referencia from $tabla r 
        inner join res_domicilio r_d on r_d.idres = r.idres;
        ");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }

    #Seleccionar Restaurante.
    static public function selResModelo($tabla, $valor){
        $stmt = Conexion::conectar() -> prepare("
            select idres, nombre, abierto, cerrado, dias from $tabla where idres = :idres;
        ");
        $stmt -> bindParam(":idres", $valor, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
        $stmt = null;
    }

    #Agendar reservación.
    static public function reservarModelo($tabla, $datosBook){
        $stmt = Conexion::conectar() -> prepare("
            insert into $tabla(idres, idcliente, idres_area, idres_area_mesa, fecha_hora, registro) 
            values(:idres, :idcliente, :idres_area, :idres_area_mesa, :fecha_hora, now());
        ");
        $stmt -> bindParam(":idres", $datosBook["res"], PDO::PARAM_INT);
        $stmt -> bindParam(":idcliente", $datosBook["cli"], PDO::PARAM_INT);
        $stmt -> bindParam(":idres_area", $datosBook["area"], PDO::PARAM_INT);
        $stmt -> bindParam(":idres_area_mesa", $datosBook["mesa"], PDO::PARAM_INT);
        $stmt -> bindParam(":fecha_hora", $datosBook["fechahora"], PDO::PARAM_STR);
        if ($stmt -> execute()) {
            return "booked";
        }else{
            return "error";
        }
        $stmt -> close();
        $stmt = null;
    }
    
    #Actualizar reservación.
    static public function actualizarBookModelo($tabla, $datosBook){
        $stmt = Conexion::conectar() -> prepare("
            update $tabla set 
            idres = :idres, idcliente = :idcliente, idres_area = :idres_area, 
            idres_area_mesa = :idres_area_mesa, fecha_hora = :fecha_hora, registro = now() 
            where idbook = :idbook;
        ");
        $stmt -> bindParam(":idres", $datosBook["res"], PDO::PARAM_INT);
        $stmt -> bindParam(":idcliente", $datosBook["cli"], PDO::PARAM_INT);
        $stmt -> bindParam(":idres_area", $datosBook["area"], PDO::PARAM_INT);
        $stmt -> bindParam(":idres_area_mesa", $datosBook["mesa"], PDO::PARAM_INT);
        $stmt -> bindParam(":fecha_hora", $datosBook["fechahora"], PDO::PARAM_STR);
        $stmt -> bindParam(":idbook", $datosBook["book"], PDO::PARAM_INT);
        if ($stmt -> execute()) {
            return "booked";
        }else{
            return "error";
        }
        $stmt -> close();
        $stmt = null;
    }

    #Ver reservaciones.
    static public function selBooksModelo($tabla, $cli){
        $stmt = Conexion::conectar() -> prepare("
            select distinct 
            b.idbook, r.nombre as res, c.nombre as cli, c.apellido, c.correo, 
            c.telefono, b.idres_area, b.idres_area_mesa, b.status, 
            DATE_FORMAT(b.fecha_hora, '%d/%M/%Y - %H:%i:%S') fecha_hora, 
            DATE_FORMAT(b.registro, '%d/%M/%Y - %H:%i:%S') registro 
            from $tabla b 
            inner join res r on b.idres = r.idres 
            inner join cliente c on b.idcliente = c.idcliente 
            inner join res_area r_a on r.idres = r_a.idres 
            inner join res_area_mesa r_a_m on r_a_m.idres_area = r_a.idres_area 
            where b.idcliente = :idcliente and b.status >= 1;
        ");
        $stmt -> bindParam(":idcliente", $cli, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }
    
    #Seleccionar reservación.
    static public function selBookModelo($tabla, $book){
        $stmt = Conexion::conectar() -> prepare("
            select 
            b.idbook, b.idres, r.nombre as res, b.idcliente, c.nombre as cli, c.apellido, c.correo, 
            c.telefono, b.idres_area, b.idres_area_mesa, b.status, 
            DATE_FORMAT(b.fecha_hora, '%d/%M/%Y %H:%i:%S') fecha_hora, 
            DATE_FORMAT(b.registro, '%d/%M/%Y %H:%i:%S') registro 
            from $tabla b 
            inner join res r on b.idres = r.idres 
            inner join cliente c on b.idcliente = c.idcliente 
            inner join res_area r_a on r.idres = r_a.idres 
            inner join res_area_mesa r_a_m on r_a_m.idres_area = r_a.idres_area 
            where b.idbook = :idbook and b.status = 1;
        ");
        $stmt -> bindParam(":idbook", $book, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
        $stmt = null;
    }
    
    #Ver fechas de reservaciones.
    static public function selDateBooksModelo($tabla, $cli){
        $stmt = Conexion::conectar() -> prepare("
            select distinct 
            b.idbook, r.nombre as res, c.nombre as cli, b.status, 
            DATE_FORMAT(b.fecha_hora, '%d/%M/%Y %H:%i:%S') fecha_hora, 
            DATE_FORMAT(b.registro, '%d/%M/%Y %H:%i:%S') registro 
            from $tabla b 
            inner join res r on b.idres = r.idres 
            inner join cliente c on b.idcliente = c.idcliente 
            where b.idcliente = :idcliente and b.status >= 1;
        ");
        $stmt -> bindParam(":idcliente", $cli, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }
    
    #Ver Área reservación.
    static public function selAreaBookModelo($tabla, $book){
        $stmt = Conexion::conectar() -> prepare("
            select area from $tabla where idres_area = :idres_area;
        ");
        $stmt -> bindParam(":idres_area", $book, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
        $stmt = null;
    }
    
    #Ver Mesa reservación.
    static public function selMesaBookModelo($tabla, $book){
        $stmt = Conexion::conectar() -> prepare("
            select capacidad from $tabla where idres_area_mesa = :idres_area_mesa;
        ");
        $stmt -> bindParam(":idres_area_mesa", $book, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
        $stmt = null;
    }
    
    #Expirar reservaciones.
    static public function expirarBookModelo($tabla, $book){
        $stmt = Conexion::conectar() -> prepare("
            update $tabla set status = 2 where idbook = :idbook;
        ");
        $stmt -> bindParam(":idbook", $book, PDO::PARAM_INT);
        if($stmt -> execute()){
            return "ok";
        }else {
            return "error";
        }
        $stmt -> close();
        $stmt = null;
    }

    #Cancelar reservación.
    public function cancelarBookModelo($tabla, $book){
        $stmt = Conexion::conectar() -> prepare("
            update $tabla set status = 0 
            where idbook = :idbook;
        ");
        $stmt -> bindParam(":idbook", $book, PDO::PARAM_INT);
        if ($stmt -> execute()) {
            return "ok";
        }else{
            return "error";
        }
        $stmt -> close();
        $stmt = null;
    }

    #Validar correo del cliente.
    static public function validEmailUserModelo($tabla, $email){
        $stmt = Conexion::conectar() -> prepare("
            select correo from $tabla where correo = :correo and status = 1;
        ");
        $stmt -> bindParam(":correo", $email, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
        $stmt = null;
    }

    #Inicio de sesión del cliente.
    static public function entrarClienteModelo($tabla, $email){
        $stmt = Conexion::conectar() -> prepare("
            select idcliente, nombre, correo, passwd from $tabla where correo = :correo and status = 1;
        ");
        $stmt -> bindParam(":correo", $email, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
        $stmt = null;
    }

    #Subir Imagen Restaurante.
    static public function subirImgResModelo($tabla, $archivo, $res){
        $stmt = Conexion::conectar() -> prepare("
            update $tabla set imagen = :imagen where idres = :idres;
        ");
        $stmt -> bindParam(":idres", $res, PDO::PARAM_INT);
        $stmt -> bindParam(":imagen", $archivo, PDO::PARAM_STR);
        if ($stmt -> execute()) {
            return "ok";
        }else{
            return "error";
        }
        $stmt -> close();
        $stmt = null;
    }
}