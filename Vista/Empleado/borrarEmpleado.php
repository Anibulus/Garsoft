<?php 
require("../../Modelo/Conexion/conexion.php");
$conn=Conectar::conexion();

$id = $_POST['idPersona'];

$result=$conn->query("update usuario set activo = 0 where idPersona =".$id.";");
    
    if($result){
        echo json_encode(0);
    } else {
        echo json_encode(1);
    }
    unset($conn);
    //header("location:index.php");   
?>