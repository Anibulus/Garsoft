<?php
require("../../Modelo/Conexion/conexion.php");
header('Content-Type: application/json');

$usuario=$_POST["usuario"];
$contrasena=$_POST["contrasena"];

$conn=Conectar::conexion();
$result=$conn->query("call iniciosesion('".$usuario."','".$contrasena."');");
$conn->close();

unset($usuario);
unset($contrasena);
unset($conn);

if($result){
//var_dump($result->num_rows);
    if($result->num_rows>0){
        $row=$result->fetch_assoc(); //Fetch row es oatra manera
        
        session_start();
        //$_SESSION["usuario"] = $row[""];
        $_SESSION["idPersona"] = $row["idPersona"];
        $_SESSION["idPerfil"] = $row["idPerfil"];
        $_SESSION['nombre']=$row['nombre']." ".$row['apellido1'];        
        echo json_encode(1);
        
    }
    else//Validacion de numero de filas
    {
        echo json_encode(0);
    }
}
else{
    echo json_encode(0);
}
?>