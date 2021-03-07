<?php
require("../../Modelo/Conexion/conexion.php");
header('Content-Type: application/json;');

session_start();
if(isset($_SESSION["nombre"])){
    $conn=Conectar::conexion();
    $result=$conn->query("select * FROM tipo t WHERE t.idTipo NOT IN (SELECT imt.idTipo FROM intermediamodeloauto_tipo imt where imt.idModelo=".$_POST["idModelo"].");");
    $conn->close();
    unset($conn);
    if($result){
        $arreglo='[';
        for($i=0;$i<$result->num_rows;$i++){
            $arreglo.=json_encode($result->fetch_assoc(),\JSON_UNESCAPED_UNICODE);
            $arreglo.=$i==($result->num_rows-1)?"":",";
        }
        echo $arreglo."]";
    }
    else
    {
        echo json_encode(array());
    }
    unset($result);
}
else{
    echo json_encode(array());
}
?>