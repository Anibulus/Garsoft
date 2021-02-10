<?php
require("../../Modelo/Conexion/conexion.php");
header('Content-Type: application/json;');

session_start();
if(isset($_SESSION["nombre"])){
    $conn=Conectar::conexion();
    $result=$conn->query("select * from categoriaProducto;");
    if($result){
        $arreglo='[';
        for($i=0;$i<$result->num_rows;$i++){
            $arreglo.=json_encode($result->fetch_assoc(),\JSON_UNESCAPED_UNICODE);
            $arreglo.=$i==($result->num_rows-1)?"":",";
        }
        echo $arreglo."]";
    }else{
        echo array();
    }
}
else{
    echo array();
}
?>