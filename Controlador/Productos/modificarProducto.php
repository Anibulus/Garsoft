<?php
session_start();
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    header('Content-Type: application/json;');
    if(count($_POST)>0)
    {
        $conn=Conectar::conexion();

        //Modificacion de cantidad
        $instruccion="update producto p set cantidad=".$_POST["cantidad"]."
        where p.idProducto=".$_POST["idProducto"];

        $result=$conn->query($instruccion);

        //Modificacion de precio
        $instruccion="update precios p set precio=".$_POST["precio"]."
        where p.idProducto=".$_POST["idProducto"]." and idPrecio=".$_POST["idPrecio"];

        $result=$conn->query($instruccion);


        $conn->close();
        unset($conn);        
        if($result)
        {
            echo json_encode(1);
        }
        else
        {//Si no hay result
            echo json_encode(2);
        }
        unset($result);
        unset($instruccion);
    }//Fin de post
    else
    {
        echo json_encode(0);
    }
}//Fin de sesion iniciada
else
{
    echo json_encode(0);
}
exit;
?>