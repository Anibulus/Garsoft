<?php
class Conectar{
    public static function conexion(){
        $conexion=new mysqli("localhost", "root", "", "3308");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}//Fin de la clase
?>
    