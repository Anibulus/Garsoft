<?php
require("../../Modelo/Conexion/conexion.php");
require("../../Modelo/Marca.php");
header('Content-Type: application/json;');

session_start();
if(isset($_SESSION["nombre"])){
    $conn=Conectar::conexion();
    $result=$conn->query("select * from marcaProducto;");
    $conn->close();
    unset($conn);
    if($result){
        $listado=array();
        for($i=0;$i<$result->num_rows;$i++){
            $row=$result->fetch_assoc();
            $obj=new Marca();
            $obj->idMarca=$row["idMarca"];
            $obj->nombre=$row["nombre"];
            array_push($listado,$obj);
        }
        echo json_encode($listado);
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