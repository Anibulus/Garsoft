<?php
session_start();
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    header('Content-Type: application/json;');
    if(count($_POST)>0)
    {
        $conn=Conectar::conexion();

        $sql= "insert into venta (anio, fecha, idModelo, idEmpleado, idCliente, idFormaPago) values"

       }