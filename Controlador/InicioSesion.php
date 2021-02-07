<?php
require("../Modelo/Conexion/conexion.php");

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
        //var_dump($row[0]);
        //var_dump($row);
        
        
        session_start();
        //$_SESSION["usuario"] = $row[""];
        $_SESSION["idPersona"] = $row["idPersona"];
        $_SESSION["idPerfil"] = $row["idPerfil"];
        $_SESSION['nombre']=$row['nombre']." ".$row['apellido1'];
        echo 1;
        
    }
    else//Validacion de numero de filas
    {
        echo 0;
    }
}
else{
    echo 0;
}
?>